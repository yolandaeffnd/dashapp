@extends('components.app-admin')

@section('content')
    <div class="container mt-4">
        <div class="card p-3">
            <div class="card-body">
                <h2 class="text-center text-xl font-bold mb-4">Rata-Rata IPK Mahasiswa</h2>

                <div class="row justify-content-md-center">
                    <div class="col-xl-4 col-md-6 col-12 mb-2">
                        <label for="fakultas" class="font-semibold">Pilih Fakultas:</label>
                        <select id="fakultas" class="border rounded px-2 py-1 w-100">
                            <option value="">-- Semua Fakultas --</option>
                            @foreach ($fakultas as $fak)
                                <option value="{{ $fak }}">{{ $fak }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12 mb-2">
                        <label for="prodi" class="font-semibold">Pilih Prodi:</label>
                        <select id="prodi" class="border rounded px-2 py-1 w-100" disabled>
                            <option value="">-- Pilih Fakultas Dulu --</option>
                        </select>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12 mb-2">
                        <label for="jenjang" class="font-semibold">Pilih Jenjang:</label>
                        <select id="jenjang" class="border rounded px-2 py-1 w-100">
                            <option value="">-- Semua Jenjang --</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>

                {{-- <div class="row justify-content-md-center mt-4">
                    <div class="col-12">
                        <canvas id="ipkChart" class="w-100"></canvas>
                    </div>
                </div> --}}
                <div class="chart-container" style="height: 60vh; width: 100%;">
                    <canvas id="ipkChart"></canvas>
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

        function updateProdiOptions() {
            let selectedFakultas = fakultasDropdown.value;
            let filteredProdi = [...new Set(allData.filter(item => item.fakultas_nama === selectedFakultas).map(item => item
                .Program_Studi))];

            prodiDropdown.innerHTML = '<option value="">-- Pilih Prodi --</option>';
            filteredProdi.forEach(prodi => {
                let option = document.createElement("option");
                option.value = prodi;
                option.textContent = prodi;
                prodiDropdown.appendChild(option);
            });

            prodiDropdown.disabled = filteredProdi.length === 0;
        }

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
            let validTahun = tahunSet.filter(tahun =>
                filteredData.some(item => item.Tahun === tahun && item.Rata_Rata_IPK > 0)
            );

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
                    labels: validTahun,
                    datasets: [{
                            label: 'Semester 1 (Ganjil)',
                            data: ganjilData,
                            backgroundColor: 'teal',
                            borderWidth: 1
                        },
                        {
                            label: 'Semester 2 (Genap)',
                            data: genapData,
                            backgroundColor: 'gray',
                            borderWidth: 1
                        }
                    ]
                },
                // options: {
                //     responsive: true,
                //     plugins: {
                //         legend: {
                //             position: 'top'
                //         }
                //     },
                //     scales: {
                //         y: {
                //             beginAtZero: true,
                //             suggestedMax: 4
                //         }
                //     }
                // }
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Membuat tinggi chart lebih fleksibel
                    aspectRatio: 2, // Sesuaikan rasio tinggi (bisa dicoba 1.5 atau 2)
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 4
                        }
                    }
                }

            });
        }

        fakultasDropdown.addEventListener("change", () => {
            updateProdiOptions();
            updateChart();
        });
        prodiDropdown.addEventListener("change", updateChart);
        jenjangDropdown.addEventListener("change", updateChart);
        updateChart();
    </script>
@endsection
