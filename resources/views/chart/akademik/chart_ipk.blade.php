@extends('components.app-admin')

@section('content')

<div class="container mt-4">
    <div class="card px-30">
        <div class="card body">
            <h2 class="text-center text-xl font-bold mb-4">Rata-Rata IPK Mahasiswa</h2>

            <div class="row justify-content-md-center">
                <div class="col-xl-4 col-md-4 col-sm-4">
                    <label for="fakultas" class="font-semibold">Pilih Fakultas:</label>
                    <select id="fakultas" class="border rounded px-2 py-1">
                        <option value="">-- Semua Fakultas --</option>
                        @foreach($fakultas as $fak)
                            <option value="{{ $fak }}">{{ $fak }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-4">
                    <label for="prodi" class="font-semibold">Pilih Prodi:</label>
                    <select id="prodi" class="border rounded px-2 py-1" disabled>
                        <option value="">-- Pilih Fakultas Dulu --</option>
                    </select>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-4">
                    <label for="jenjang" class="font-semibold">Pilih Jenjang:</label>
                    <select id="jenjang" class="border rounded px-2 py-1">
                        <option value="">-- Semua Jenjang --</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-md-center mt-4">
                <div class="col-xl-9 col-md-9 col-sm-12">
                    <canvas id="ipkChart" class="w-full max-w-3xl"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let allData = @json($data);
let fakultasDropdown = document.getElementById("fakultas");
let prodiDropdown = document.getElementById("prodi");
let jenjangDropdown = document.getElementById("jenjang");
let chartInstance;

// Fungsi untuk memperbarui pilihan prodi berdasarkan fakultas yang dipilih
function updateProdiOptions() {
    let selectedFakultas = fakultasDropdown.value;
    let filteredProdi = [...new Set(allData
        .filter(item => item.fakultas_nama === selectedFakultas)
        .map(item => item.Program_Studi))];

    prodiDropdown.innerHTML = '<option value="">-- Pilih Prodi --</option>';
    filteredProdi.forEach(prodi => {
        let option = document.createElement("option");
        option.value = prodi;
        option.textContent = prodi;
        prodiDropdown.appendChild(option);
    });

    prodiDropdown.disabled = filteredProdi.length === 0;
}

// Fungsi untuk memperbarui chart berdasarkan filter yang dipilih
function updateChart() {
    let selectedFakultas = fakultasDropdown.value;
    let selectedProdi = prodiDropdown.value;
    let selectedJenjang = jenjangDropdown.value;

    let filteredData = allData.filter(item =>
        (!selectedFakultas || item.fakultas_nama === selectedFakultas) &&
        (!selectedProdi || item.Program_Studi === selectedProdi) &&
        (!selectedJenjang || item.Jenjang === selectedJenjang)
    );

    let tahunSet = [...new Set(filteredData.map(item => item.Tahun))].sort();

    // Filter tahun yang memiliki nilai valid
    let validTahun = tahunSet.filter(tahun => {
        let ganjil = filteredData.find(item => item.Tahun === tahun && item.Semester === "Semester 1");
        let genap = filteredData.find(item => item.Tahun === tahun && item.Semester === "Semester 2");
        return (ganjil && ganjil.Rata_Rata_IPK > 0) || (genap && genap.Rata_Rata_IPK > 0);
    });

    let ganjilData = validTahun.map(tahun => {
        let entry = filteredData.find(item => item.Tahun === tahun && item.Semester === "Semester 1");
        return entry ? entry.Rata_Rata_IPK || 0 : 0;
    });

    let genapData = validTahun.map(tahun => {
        let entry = filteredData.find(item => item.Tahun === tahun && item.Semester === "Semester 2");
        return entry ? entry.Rata_Rata_IPK || 0 : 0;
    });

    let ctx = document.getElementById('ipkChart').getContext('2d');
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: validTahun, // Hanya tahun yang memiliki data valid
            datasets: [
                {
                    label: 'Semester 1 (Ganjil)',
                    data: ganjilData,
                    backgroundColor: 'teal',
                    borderColor: 'black',
                    borderWidth: 1
                },
                {
                    label: 'Semester 2 (Genap)',
                    data: genapData,
                    backgroundColor: 'gray',
                    borderColor: 'black',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    formatter: (value) => value > 0 ? value.toFixed(2) : '',
                    font: { weight: 'bold', size: 12 },
                    color: 'black'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 4
                }
            }
        },
        plugins: [ChartDataLabels]
    });
}


// Event Listener untuk update pilihan dan chart
fakultasDropdown.addEventListener("change", () => {
    updateProdiOptions();
    updateChart();
});
prodiDropdown.addEventListener("change", updateChart);
jenjangDropdown.addEventListener("change", updateChart);

// Inisialisasi chart saat halaman dimuat
updateChart();
</script>

@endsection
