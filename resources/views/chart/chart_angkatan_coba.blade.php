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
                    <table id="mahasiswaTable" class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Angkatan</th>
                                <th>Prodi</th>
                                <th>Fakultas</th>
                                <th>Semester</th>
                                <th>Aktif</th>
                                <th>Cuti</th>
                                <th>Keluar</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        @endif
    </div>
</div>
<script>
// document.addEventListener("DOMContentLoaded", function() {
//     let rawData = @json($data['data']);

//     let fakultasDropdown = document.getElementById("fakultas");
//     let prodiDropdown = document.getElementById("program_studi");
//     let angkatanDropdown = document.getElementById("angkatan");

//     let ctx = document.getElementById('mahasiswaChart').getContext('2d');
//     let chartInstance;

//     function semesterLabel(semester) {
//         let tahun = Math.floor(semester / 10);
//         let term = semester % 10 === 1 ? "Ganjil" : "Genap";
//         return `${tahun} ${term}`;
//     }

//     function filterData() {
//         let selectedFakultas = fakultasDropdown.value;
//         let selectedProdi = prodiDropdown.value;
//         let selectedAngkatan = angkatanDropdown.value;

//         let filteredData = [];

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 if (
//                     (!selectedFakultas || info.fakultas === selectedFakultas) &&
//                     (!selectedProdi || info.program_studi === selectedProdi) &&
//                     (!selectedAngkatan || info.angkatan == selectedAngkatan)
//                 ) {
//                     filteredData.push(info);
//                 }
//             });
//         });

//         updateChart(filteredData);
//         updateTable(filteredData);
//     }

//     function updateChart(filteredData) {
//         let semesterSet = new Set();
//         let activeData = {};
//         let cutiData = {};
//         let keluarData = {};

//         filteredData.forEach(info => {
//             Object.values(info.data_per_semester).forEach(sem => {
//                 let semLabel = semesterLabel(sem.semester);
//                 semesterSet.add(semLabel);

//                 if (!activeData[semLabel]) activeData[semLabel] = 0;
//                 if (!cutiData[semLabel]) cutiData[semLabel] = 0;
//                 if (!keluarData[semLabel]) keluarData[semLabel] = 0;

//                 activeData[semLabel] = sem.jumlah_mahasiswa_sisa;
//                 cutiData[semLabel] = sem.jumlah_cuti;
//                 keluarData[semLabel] = sem.jumlah_keluar;
//             });
//         });

//         let sortedSemesters = Array.from(semesterSet).sort();

//         let activeValues = sortedSemesters.map(sem => activeData[sem] || 0);
//         let cutiValues = sortedSemesters.map(sem => cutiData[sem] || 0);
//         let keluarValues = sortedSemesters.map(sem => keluarData[sem] || 0);

//         if (chartInstance) {
//             chartInstance.destroy();
//         }

//         chartInstance = new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: sortedSemesters,
//                 datasets: [
//                     {
//                         label: 'Aktif',
//                         data: activeValues,
//                         backgroundColor: '#00bcd4'  // Biru
//                     },
//                     {
//                         label: 'Cuti',
//                         data: cutiValues,
//                         backgroundColor: '#555555'  // Abu-abu
//                     },
//                     {
//                         label: 'Keluar',
//                         data: keluarValues,
//                         backgroundColor: '#ff5252'  // Merah
//                     }
//                 ]
//             },
//             options: {
//                 responsive: true,
//                 plugins: {
//                     legend: {
//                         display: true,
//                         position: 'top',  // Bisa juga 'right', 'bottom', 'left'
//                         labels: {
//                             font: { size: 14 },
//                             padding: 20,
//                             usePointStyle: true
//                         }
//                     },
//                     tooltip: {
//                         callbacks: {
//                             label: function(tooltipItem) {
//                                 return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
//                             }
//                         }
//                     }
//                 },
//                 scales: {
//                     x: {
//                         stacked: false,
//                         title: { display: true, text: 'Semester' }
//                     },
//                     y: {
//                         stacked: false,
//                         beginAtZero: true,
//                         title: { display: true, text: 'Jumlah Mahasiswa' }
//                     }
//                 }
//             }
//         });
//     }

//     function updateTable(filteredData) {
//         let tableBody = document.querySelector("#mahasiswaTable tbody");
//         tableBody.innerHTML = "";

//         filteredData.forEach(info => {
//             Object.keys(info.data_per_semester).forEach(sem => {
//                 let semData = info.data_per_semester[sem];
//                 let row = `<tr>
//                     <td>${info.angkatan}</td>
//                     <td>${info.program_studi}</td>
//                     <td>${info.fakultas}</td>
//                     <td>${semesterLabel(semData.semester)}</td>
//                     <td>${semData.jumlah_mahasiswa_sisa}</td>
//                     <td>${semData.jumlah_cuti}</td>
//                     <td>${semData.jumlah_keluar}</td>
//                 </tr>`;
//                 tableBody.innerHTML += row;
//             });
//         });
//     }

//     function updateProdiOptions() {
//         let selectedFakultas = fakultasDropdown.value;
//         let prodiOptions = new Set();

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 if (info.fakultas === selectedFakultas) {
//                     prodiOptions.add(info.program_studi);
//                 }
//             });
//         });

//         prodiDropdown.innerHTML = '<option value="">Semua Prodi</option>';
//         prodiOptions.forEach(prodi => {
//             let option = document.createElement("option");
//             option.value = prodi;
//             option.textContent = prodi;
//             prodiDropdown.appendChild(option);
//         });

//         prodiDropdown.disabled = prodiOptions.size === 0;
//     }

//     fakultasDropdown.addEventListener("change", function() {
//         updateProdiOptions();
//         filterData();
//     });

//     prodiDropdown.addEventListener("change", filterData);
//     angkatanDropdown.addEventListener("change", filterData);

//     updateChart(rawData);
//     updateTable(rawData);
// });

// document.addEventListener("DOMContentLoaded", function() {
//     let rawData = @json($data['data']);

//     let fakultasDropdown = document.getElementById("fakultas");
//     let prodiDropdown = document.getElementById("program_studi");
//     let angkatanDropdown = document.getElementById("angkatan");

//     let ctx = document.getElementById('mahasiswaChart').getContext('2d');
//     let chartInstance;

//     // ✅ Registrasikan ChartDataLabels
//     Chart.register(ChartDataLabels);

//     function semesterLabel(semester) {
//         let tahun = Math.floor(semester / 10);
//         let term = semester % 10 === 1 ? "Ganjil" : "Genap";
//         return `${tahun} ${term}`;
//     }

//     function filterData() {
//         let selectedFakultas = fakultasDropdown.value;
//         let selectedProdi = prodiDropdown.value;
//         let selectedAngkatan = angkatanDropdown.value;

//         let filteredData = [];

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 if (
//                     (!selectedFakultas || info.fakultas === selectedFakultas) &&
//                     (!selectedProdi || info.program_studi === selectedProdi) &&
//                     (!selectedAngkatan || info.angkatan == selectedAngkatan)
//                 ) {
//                     filteredData.push(info);
//                 }
//             });
//         });

//         updateChart(filteredData);
//         updateTable(filteredData);
//     }

//     function updateChart(filteredData) {
//         let semesterSet = new Set();
//         let activeData = {};
//         let cutiData = {};
//         let keluarData = {};

//         filteredData.forEach(info => {
//             Object.values(info.data_per_semester).forEach(sem => {
//                 let semLabel = semesterLabel(sem.semester);
//                 semesterSet.add(semLabel);

//                 if (!activeData[semLabel]) activeData[semLabel] = 0;
//                 if (!cutiData[semLabel]) cutiData[semLabel] = 0;
//                 if (!keluarData[semLabel]) keluarData[semLabel] = 0;

//                 activeData[semLabel] = sem.jumlah_mahasiswa_sisa;
//                 cutiData[semLabel] = sem.jumlah_cuti;
//                 keluarData[semLabel] = sem.jumlah_keluar;
//             });
//         });

//         let sortedSemesters = Array.from(semesterSet).sort();

//         let activeValues = sortedSemesters.map(sem => activeData[sem] || 0);
//         let cutiValues = sortedSemesters.map(sem => cutiData[sem] || 0);
//         let keluarValues = sortedSemesters.map(sem => keluarData[sem] || 0);

//         if (chartInstance) {
//             chartInstance.destroy();
//         }

//         chartInstance = new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: sortedSemesters,
//                 datasets: [
//                     {
//                         label: 'Aktif',
//                         data: activeValues,
//                         backgroundColor: '#00bcd4',  // Biru
//                         datalabels: { color: '#000' }
//                     },
//                     {
//                         label: 'Cuti',
//                         data: cutiValues,
//                         backgroundColor: '#555555',  // Abu-abu
//                         datalabels: { color: '#000' }
//                     },
//                     {
//                         label: 'Keluar',
//                         data: keluarValues,
//                         backgroundColor: '#ff5252',  // Merah
//                         datalabels: { color: '#000' }
//                     }
//                 ]
//             },
//             options: {
//                 responsive: true,
//                 plugins: {
//                     legend: {
//                         display: true,
//                         position: 'top',
//                         labels: {
//                             font: { size: 14 },
//                             padding: 20,
//                             usePointStyle: true
//                         }
//                     },
//                     tooltip: {
//                         callbacks: {
//                             label: function(tooltipItem) {
//                                 return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
//                             }
//                         }
//                     },
//                     datalabels: {  // ✅ Menampilkan angka di atas setiap bar
//                         anchor: 'end',
//                         align: 'top',
//                         color: '#000',
//                         font: { weight: 'bold', size: 14 },
//                         formatter: (value) => value > 0 ? value : ''
//                     }
//                 },
//                 scales: {
//                     x: {
//                         stacked: false,
//                         title: { display: true, text: 'Semester' }
//                     },
//                     y: {
//                         stacked: false,
//                         beginAtZero: true,
//                         title: { display: true, text: 'Jumlah Mahasiswa' }
//                     }
//                 }
//             }
//         });
//     }

//     function updateTable(filteredData) {
//         let tableBody = document.querySelector("#mahasiswaTable tbody");
//         tableBody.innerHTML = "";

//         filteredData.forEach(info => {
//             Object.keys(info.data_per_semester).forEach(sem => {
//                 let semData = info.data_per_semester[sem];
//                 let row = `<tr>
//                     <td>${info.angkatan}</td>
//                     <td>${info.program_studi}</td>
//                     <td>${info.fakultas}</td>
//                     <td>${semesterLabel(semData.semester)}</td>
//                     <td>${semData.jumlah_mahasiswa_sisa}</td>
//                     <td>${semData.jumlah_cuti}</td>
//                     <td>${semData.jumlah_keluar}</td>
//                 </tr>`;
//                 tableBody.innerHTML += row;
//             });
//         });
//     }

//     function updateProdiOptions() {
//         let selectedFakultas = fakultasDropdown.value;
//         let prodiOptions = new Set();

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 if (info.fakultas === selectedFakultas) {
//                     prodiOptions.add(info.program_studi);
//                 }
//             });
//         });

//         prodiDropdown.innerHTML = '<option value="">Semua Prodi</option>';
//         prodiOptions.forEach(prodi => {
//             let option = document.createElement("option");
//             option.value = prodi;
//             option.textContent = prodi;
//             prodiDropdown.appendChild(option);
//         });

//         prodiDropdown.disabled = prodiOptions.size === 0;
//     }

//     fakultasDropdown.addEventListener("change", function() {
//         updateProdiOptions();
//         filterData();
//     });

//     prodiDropdown.addEventListener("change", filterData);
//     angkatanDropdown.addEventListener("change", filterData);

//     updateChart(rawData);
//     updateTable(rawData);
// });

// document.addEventListener("DOMContentLoaded", function () {
//     let rawData = @json($data['data']);

//     let fakultasDropdown = document.getElementById("fakultas");
//     let prodiDropdown = document.getElementById("program_studi");
//     let angkatanDropdown = document.getElementById("angkatan");

//     let ctx = document.getElementById('mahasiswaChart').getContext('2d');
//     let chartInstance;

//     function semesterLabel(semester) {
//         let tahun = Math.floor(semester / 10);
//         let term = semester % 10 === 1 ? "Ganjil" : "Genap";
//         return `${tahun} ${term}`;
//     }

//     function getDefaultData() {
//         let mergedData = [];

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 mergedData.push(info);
//             });
//         });

//         return mergedData;
//     }

//     function filterData() {
//         let selectedFakultas = fakultasDropdown.value;
//         let selectedProdi = prodiDropdown.value;
//         let selectedAngkatan = angkatanDropdown.value;

//         let filteredData = [];

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 if (
//                     (!selectedFakultas || info.fakultas === selectedFakultas) &&
//                     (!selectedProdi || info.program_studi === selectedProdi) &&
//                     (!selectedAngkatan || info.angkatan == selectedAngkatan)
//                 ) {
//                     filteredData.push(info);
//                 }
//             });
//         });

//         console.log("Filtered Data:", filteredData); // Debugging

//         updateChart(filteredData);
//         updateTable(filteredData);
//     }

//     function updateChart(filteredData) {
//         if (filteredData.length === 0) {
//             console.log("No data available for chart");
//             return;
//         }

//         let semesterSet = new Set();
//         let activeData = {};
//         let cutiData = {};
//         let keluarData = {};

//         filteredData.forEach(info => {
//             Object.values(info.data_per_semester).forEach(sem => {
//                 let semLabel = semesterLabel(sem.semester);
//                 semesterSet.add(semLabel);

//                 if (!activeData[semLabel]) activeData[semLabel] = 0;
//                 if (!cutiData[semLabel]) cutiData[semLabel] = 0;
//                 if (!keluarData[semLabel]) keluarData[semLabel] = 0;

//                 activeData[semLabel] += sem.jumlah_mahasiswa_sisa;
//                 cutiData[semLabel] += sem.jumlah_cuti;
//                 keluarData[semLabel] += sem.jumlah_keluar;
//             });
//         });

//         let sortedSemesters = Array.from(semesterSet).sort();

//         let activeValues = sortedSemesters.map(sem => activeData[sem] || 0);
//         let cutiValues = sortedSemesters.map(sem => cutiData[sem] || 0);
//         let keluarValues = sortedSemesters.map(sem => keluarData[sem] || 0);

//         if (chartInstance) {
//             chartInstance.destroy();
//         }

//         chartInstance = new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: sortedSemesters,
//                 datasets: [
//                     {
//                         label: 'Aktif',
//                         data: activeValues,
//                         backgroundColor: '#00bcd4',  // Biru
//                     },
//                     {
//                         label: 'Cuti',
//                         data: cutiValues,
//                         backgroundColor: '#555555',  // Abu-abu
//                     },
//                     {
//                         label: 'Keluar',
//                         data: keluarValues,
//                         backgroundColor: '#ff5252',  // Merah
//                     }
//                 ]
//             },
//             options: {
//                 responsive: true,
//                 plugins: {
//                     legend: {
//                         display: true,
//                         position: 'top',
//                         labels: {
//                             font: { size: 14 },
//                             padding: 20,
//                             usePointStyle: true
//                         }
//                     },
//                     tooltip: {
//                         callbacks: {
//                             label: function(tooltipItem) {
//                                 return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
//                             }
//                         }
//                     },
//                     datalabels: {  // Menampilkan angka di atas batang grafik
//                         anchor: 'end',
//                         align: 'top',
//                         formatter: (value) => value > 0 ? value : '', // Hanya tampilkan angka jika > 0
//                         font: { size: 12, weight: 'bold' },
//                         color: '#000'  // Warna hitam agar terlihat jelas
//                     }
//                 },
//                 scales: {
//                     x: {
//                         stacked: false,
//                         title: { display: true, text: 'Semester' }
//                     },
//                     y: {
//                         stacked: false,
//                         beginAtZero: true,
//                         title: { display: true, text: 'Jumlah Mahasiswa' }
//                     }
//                 }
//             },
//             plugins: [ChartDataLabels] // Aktifkan plugin agar angka muncul di atas batang
//         });
//     }

//     function updateTable(filteredData) {
//         let tableBody = document.querySelector("#mahasiswaTable tbody");
//         tableBody.innerHTML = "";

//         if (filteredData.length === 0) {
//             console.log("No data available for table");
//             return;
//         }

//         filteredData.forEach(info => {
//             Object.keys(info.data_per_semester).forEach(sem => {
//                 let semData = info.data_per_semester[sem];
//                 let row = `<tr>
//                     <td>${info.angkatan}</td>
//                     <td>${info.program_studi}</td>
//                     <td>${info.fakultas}</td>
//                     <td>${semesterLabel(semData.semester)}</td>
//                     <td>${semData.jumlah_mahasiswa_sisa}</td>
//                     <td>${semData.jumlah_cuti}</td>
//                     <td>${semData.jumlah_keluar}</td>
//                 </tr>`;
//                 tableBody.innerHTML += row;
//             });
//         });
//     }

//     function updateProdiOptions() {
//         let selectedFakultas = fakultasDropdown.value;
//         let prodiOptions = new Set();

//         rawData.forEach(angkatan => {
//             Object.values(angkatan).forEach(info => {
//                 if (info.fakultas === selectedFakultas) {
//                     prodiOptions.add(info.program_studi);
//                 }
//             });
//         });

//         prodiDropdown.innerHTML = '<option value="">Semua Prodi</option>';
//         prodiOptions.forEach(prodi => {
//             let option = document.createElement("option");
//             option.value = prodi;
//             option.textContent = prodi;
//             prodiDropdown.appendChild(option);
//         });

//         prodiDropdown.disabled = prodiOptions.size === 0;
//     }

//     fakultasDropdown.addEventListener("change", function () {
//         updateProdiOptions();
//         filterData();
//     });

//     prodiDropdown.addEventListener("change", filterData);
//     angkatanDropdown.addEventListener("change", filterData);

//     let defaultData = getDefaultData();
//     updateChart(defaultData);
//     updateTable(defaultData);
// });

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

        console.log("Filtered Data:", filteredData);

        updateChart(filteredData);
        updateTable(filteredData);
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
                        backgroundColor: '#00bcd4',  // Biru
                    },
                    {
                        label: 'Cuti',
                        data: cutiValues,
                        backgroundColor: '#555555',  // Abu-abu
                    },
                    {
                        label: 'Keluar',
                        data: keluarValues,
                        backgroundColor: '#ff5252',  // Merah
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

    function updateTable(filteredData) {
        let tableBody = document.querySelector("#mahasiswaTable tbody");
        tableBody.innerHTML = "";

        if (filteredData.length === 0) {
            console.log("No data available for table");
            return;
        }

        filteredData.forEach(info => {
            Object.keys(info.data_per_semester).forEach(sem => {
                let semData = info.data_per_semester[sem];
                let row = `<tr>
                    <td>${info.angkatan}</td>
                    <td>${info.program_studi}</td>
                    <td>${info.fakultas}</td>
                    <td>${semesterLabel(semData.semester)}</td>
                    <td>${semData.jumlah_mahasiswa_sisa}</td>
                    <td>${semData.jumlah_cuti}</td>
                    <td>${semData.jumlah_keluar}</td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        });
    }

    function updateProdiOptions() {
        let selectedFakultas = fakultasDropdown.value;
        let prodiOptions = new Set();

        rawData.forEach(angkatan => {
            Object.values(angkatan).forEach(info => {
                if (info.fakultas === selectedFakultas) {
                    prodiOptions.add(info.program_studi);
                }
            });
        });

        prodiDropdown.innerHTML = '<option value="">Semua Prodi</option>';
        prodiOptions.forEach(prodi => {
            let option = document.createElement("option");
            option.value = prodi;
            option.textContent = prodi;
            prodiDropdown.appendChild(option);
        });

        prodiDropdown.disabled = prodiOptions.size === 0;
    }

    fakultasDropdown.addEventListener("change", function () {
        updateProdiOptions();
        filterData();
    });

    prodiDropdown.addEventListener("change", filterData);
    angkatanDropdown.addEventListener("change", filterData);

    setDropdownToAngkatan2018(); // Set filter ke angkatan 2018 saat halaman dimuat
    let defaultData = getDefaultData();
    updateChart(defaultData);
    updateTable(defaultData);
});





    </script>


@endsection
