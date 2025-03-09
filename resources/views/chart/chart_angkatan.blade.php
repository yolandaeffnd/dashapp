@extends('components.app-admin')

@section('content')
<div class="container mt-4">
    <div class="card p-4">
        <h2 class="text-center text-xl font-bold mb-4">Data Angkatan Mahasiswa</h2>

        @if(isset($data['error']))
            <div class="alert alert-danger">{{ $data['error'] }}</div>
        @else
            <div class="row">
                <div class="col-md-3">
                    <label>Pilih Fakultas:</label>
                    <select id="fakultas" class="form-control">
                        <option value="">Semua Fakultas</option>
                        @foreach($data['data'] as $angkatan)
                            @foreach($angkatan as $info)
                                @if(!empty($info['fakultas']) && !in_array($info['fakultas'], $fakultas ?? []))
                                    @php $fakultas[] = $info['fakultas']; @endphp
                                    <option value="{{ $info['fakultas'] }}">{{ $info['fakultas'] }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>

                    <label>Pilih Prodi:</label>
                    <select id="program_studi" class="form-control">
                        <option value="">Semua Prodi</option>
                    </select>

                    <label>Pilih Angkatan:</label>
                    <select id="angkatan" class="form-control">
                        <option value="">Semua Angkatan</option>
                        @foreach($data['data'] as $angkatan)
                            @foreach($angkatan as $info)
                                @if(!empty($info['angkatan']) && !in_array($info['angkatan'], $angkatanList ?? []))
                                    @php $angkatanList[] = $info['angkatan']; @endphp
                                    <option value="{{ $info['angkatan'] }}">{{ $info['angkatan'] }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="col-md-9">
                    <canvas id="mahasiswaChart"></canvas>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let rawData = @json($data['data']);

    let fakultasDropdown = document.getElementById("fakultas");
    let prodiDropdown = document.getElementById("program_studi");
    let angkatanDropdown = document.getElementById("angkatan");

    let ctx = document.getElementById('mahasiswaChart').getContext('2d');
    let chartInstance;

    function semesterLabel(semester) {
        let tahun = Math.floor(semester / 10);
        let term = semester % 10 === 1 ? "Ganjil" : "Genap";
        return `${tahun} ${term}`;
    }

    function setDropdownToAngkatan2018() {
        let defaultYear = 2018;
        angkatanDropdown.value = defaultYear;
    }

    function getDefaultData() {
        let defaultYear = 2018;
        let mergedData = [];

        rawData.forEach(angkatan => {
            Object.values(angkatan).forEach(info => {
                if (info.angkatan == defaultYear) {
                    mergedData.push(info);
                }
            });
        });

        return mergedData;
    }

    function filterData() {
        let selectedFakultas = fakultasDropdown.value;
        let selectedProdi = prodiDropdown.value;
        let selectedAngkatan = angkatanDropdown.value;

        let filteredData = [];

        rawData.forEach(angkatan => {
            Object.values(angkatan).forEach(info => {
                if (
                    (!selectedFakultas || info.fakultas === selectedFakultas) &&
                    (!selectedProdi || info.program_studi === selectedProdi) &&
                    (!selectedAngkatan || info.angkatan == selectedAngkatan)
                ) {
                    filteredData.push(info);
                }
            });
        });

        updateChart(filteredData);
    }

    function updateChart(filteredData) {
        if (filteredData.length === 0) {
            console.log("No data available for chart");
            return;
        }

        let semesterSet = new Set();
        let activeData = {};
        let cutiData = {};
        let keluarData = {};

        filteredData.forEach(info => {
            Object.values(info.data_per_semester).forEach(sem => {
                let semLabel = semesterLabel(sem.semester);
                semesterSet.add(semLabel);

                if (!activeData[semLabel]) activeData[semLabel] = 0;
                if (!cutiData[semLabel]) cutiData[semLabel] = 0;
                if (!keluarData[semLabel]) keluarData[semLabel] = 0;

                activeData[semLabel] += sem.jumlah_mahasiswa_sisa;
                cutiData[semLabel] += sem.jumlah_cuti;
                keluarData[semLabel] += sem.jumlah_keluar;
            });
        });

        let sortedSemesters = Array.from(semesterSet).sort();

        let activeValues = sortedSemesters.map(sem => activeData[sem] || 0);
        let cutiValues = sortedSemesters.map(sem => cutiData[sem] || 0);
        let keluarValues = sortedSemesters.map(sem => keluarData[sem] || 0);

        if (chartInstance) {
            chartInstance.destroy();
        }

        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: sortedSemesters,
                datasets: [
                    {
                        label: 'Aktif',
                        data: activeValues,
                        backgroundColor: '#00bcd4',
                    },
                    {
                        label: 'Cuti',
                        data: cutiValues,
                        backgroundColor: '#555555',
                    },
                    {
                        label: 'Keluar',
                        data: keluarValues,
                        backgroundColor: '#ff5252',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 14 },
                            padding: 20,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: (value) => value > 0 ? value : '',
                        font: { size: 12, weight: 'bold' },
                        color: '#000'
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        title: { display: true, text: 'Semester' }
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Mahasiswa' }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    fakultasDropdown.addEventListener("change", function () {
        filterData();
    });

    prodiDropdown.addEventListener("change", filterData);
    angkatanDropdown.addEventListener("change", filterData);

    setDropdownToAngkatan2018();
    let defaultData = getDefaultData();
    updateChart(defaultData);
});
</script>
@endsection
