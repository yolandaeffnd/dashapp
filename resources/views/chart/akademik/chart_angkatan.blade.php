@extends('components.app-admin')

@section('content')
    <div class="container mt-4">
        <div class="card p-3">
            <div class="card-body">
                <h2 class="text-center text-xl font-bold mb-4">Jumlah Data Mahasiswa Per-Angkatan Per-Semester</h2>

                @if (isset($data['error']))
                    <div class="alert alert-danger">{{ $data['error'] }}</div>
                @else
                    <div class="row justify-content-md-center">
                        <div class="col-xl-4 col-md-6 col-12 mb-2">
                            <label for="fakultas" class="font-semibold">Pilih Fakultas:</label>
                            <select id="fakultas" class="border rounded px-2 py-1 w-100">
                                <option value="">-- Semua Fakultas --</option>
                                @foreach ($data['data'] as $angkatan)
                                    @foreach ($angkatan as $info)
                                        @if (!empty($info['fakultas']) && !in_array($info['fakultas'], $fakultas ?? []))
                                            @php $fakultas[] = $info['fakultas']; @endphp
                                            <option value="{{ $info['fakultas'] }}">{{ $info['fakultas'] }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-4 col-md-6 col-12 mb-2">
                            <label for="prodi" class="font-semibold">Pilih Prodi:</label>
                            <select id="program_studi" class="border rounded px-2 py-1 w-100">
                                <option value="">-- Semua Prodi --</option>
                            </select>
                        </div>

                        <div class="col-xl-4 col-md-6 col-12 mb-2">
                            <label class="font-semibold">Pilih Angkatan:</label>
                            <select id="angkatan" class="border rounded px-2 py-1 w-100">
                                <option value="">-- Semua Angkatan --</option>
                                @foreach ($data['data'] as $angkatan)
                                    @foreach ($angkatan as $info)
                                        @if (!empty($info['angkatan']) && !in_array($info['angkatan'], $angkatanList ?? []))
                                            @php $angkatanList[] = $info['angkatan']; @endphp
                                            <option value="{{ $info['angkatan'] }}">{{ $info['angkatan'] }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- <div class="chart-container" style="position: relative; height: 400px;"> --}}
                    <div class="chart-container" style="height: 60vh; width: 100%;">
                        <canvas id="mahasiswaChart"></canvas>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

            function updateProdiDropdown() {
                let selectedFakultas = fakultasDropdown.value;
                prodiDropdown.innerHTML = '<option value="">Semua Prodi</option>';

                let uniqueProdi = new Set();

                rawData.forEach(angkatan => {
                    Object.values(angkatan).forEach(info => {
                        if (info.fakultas === selectedFakultas) {
                            uniqueProdi.add(info.program_studi);
                        }
                    });
                });

                uniqueProdi.forEach(prodi => {
                    let option = document.createElement("option");
                    option.value = prodi;
                    option.textContent = prodi;
                    prodiDropdown.appendChild(option);
                });
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
                if (!filteredData || filteredData.length === 0) {
                    console.log("Tidak ada data untuk chart.");
                    return;
                }

                let semesterSet = new Set();
                let activeData = {};
                let cutiData = {};
                let keluarData = {};

                filteredData.forEach(info => {
                    if (info.data_per_semester) {
                        Object.values(info.data_per_semester).forEach(sem => {
                            let semLabel = semesterLabel(sem.semester);
                            semesterSet.add(semLabel);

                            if (!activeData[semLabel]) activeData[semLabel] = 0;
                            if (!cutiData[semLabel]) cutiData[semLabel] = 0;
                            if (!keluarData[semLabel]) keluarData[semLabel] = 0;

                            activeData[semLabel] += sem.jumlah_mahasiswa_sisa || 0;
                            cutiData[semLabel] += sem.jumlah_cuti || 0;
                            keluarData[semLabel] += sem.jumlah_keluar || 0;
                        });
                    }
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
                        datasets: [{
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
                        maintainAspectRatio: false
                    }
                });
            }

            fakultasDropdown.addEventListener("change", function() {
                updateProdiDropdown();
                filterData();
            });

            prodiDropdown.addEventListener("change", filterData);
            angkatanDropdown.addEventListener("change", filterData);

            updateProdiDropdown();
            setDropdownToAngkatan2018();
            updateChart(getDefaultData());
        });
    </script>
@endsection
