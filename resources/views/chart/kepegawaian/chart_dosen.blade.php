@extends('components.app-admin')

@section('content')
<style>
    .dataTables_paginate .paginate_button {
        padding: 0.25rem 0.6rem;
        margin-left: 3px;
    }
    div.dt-container .dt-paging .dt-paging-button {

    font-size: 10px;
}
</style>
<div class="container mt-4">
    <div class="card px-3">
        <div class="card-body">
            <h2 class="text-center text-xl font-bold mb-4">Jumlah Dosen Per-Fakultas dan Departemen</h2>

            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
                    <label class="font-semibold">Pilih Fakultas:</label>
                    <select id="filterFakultas" class="form-select">
                        <option value="">Semua Fakultas</option>
                    </select>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
                    <label class="font-semibold">Pilih Departemen:</label>
                    <select id="filterDepartemen" class="form-select">
                        <option value="">Semua Departemen</option>
                    </select>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
                    <label class="font-semibold">Jenis Kelamin</label>
                    <select id="filterJK" class="form-select">
                        <option value="">Semua</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
                    <label class="font-semibold">Status:</label>
                    <select id="filterStatus" class="form-select">
                        <option value="">Semua Status</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-xl-10 col-md-12 col-sm-12">
                    <canvas id="chartDosen"></canvas>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table id="tabelDetail" class="table ">
                        <thead>
                            <tr class="table-primary">
                                <th>Nama</th>
                                <th>NIP Lama</th>
                                <th>NIP Baru</th>
                                <th>Fakultas</th>
                                <th>Departemen</th>
                                <th>Pendidikan Terakhir</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div></div>
            </div>
        </div>
    </div>
</div>

<!-- Load Library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    const dataApi = @json($data);

    let currentPangkat = '';

function initFilter(){
    const fakultas = [...new Set(dataApi.map(item => item.fakultas))];
    const departemen = [...new Set(dataApi.filter(d => d.departemen).map(item => item.departemen))];
    const statusAktif = [...new Set(dataApi.map(item => item.status_kepegawaian))];

    fakultas.forEach(f => $('#filterFakultas').append(`<option>${f}</option>`));
    departemen.forEach(d => $('#filterDepartemen').append(`<option>${d}</option>`));
    statusAktif.forEach(s => $('#filterStatus').append(`<option>${s}</option>`));
}

    // Inisialisasi Chart
    Chart.register(ChartDataLabels);

const ctx = document.getElementById('chartDosen').getContext('2d');
let chartDosen = new Chart(ctx, {
    type: 'bar',
    data: {labels: [], datasets: [{label: 'Jumlah Dosen', data: [], backgroundColor: '#4a90e2'}]},
    options: {
        responsive: true,
        plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: { size: 14, weight: 'bold' }
                    }
                },
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    color: '#000',
                    font: { weight: 'bold' }
                }
            },
            scales: {
                y: {beginAtZero: true, grace: '5%'},
                x: {ticks: {autoSkip: false, maxRotation: 45, minRotation: 30}}
            },
        onClick: (e, elements) => {
            if (elements.length > 0) {
                const clickedElementIndex = elements[0].index;
                currentPangkat = chartDosen.data.labels[clickedElementIndex];
                updateTable();
            }
        }
    }
});

let table;

function updateChart(){
    const fakultas = $('#filterFakultas').val();
    const departemen = $('#filterDepartemen').val();
    const jk = $('#filterJK').val();
    const status = $('#filterStatus').val();

    const filtered = dataApi.filter(item => {
        return (!fakultas || item.fakultas === fakultas) &&
               (!departemen || item.departemen === departemen) &&
               (!jk || item.jenis_kelamin === jk) &&
               (!status || item.status_kepegawaian === status);
    });

    const grouped = {};

    filtered.forEach(d => {
        const pangkat = d.pangkat || 'Tanpa Pangkat';
        grouped[pangkat] = (grouped[pangkat] || 0) + 1;
    });

    chartDosen.data.labels = Object.keys(grouped);
    chartDosen.data.datasets[0].data = Object.values(grouped);
    chartDosen.update();

    updateTable();
}

function updateTable(){
    const fakultas = $('#filterFakultas').val();
    const departemen = $('#filterDepartemen').val();
    const jk = $('#filterJK').val();
    const status = $('#filterStatus').val();

    const filtered = dataApi.filter(item => {
        return (!fakultas || item.fakultas === fakultas) &&
               (!departemen || item.departemen === departemen) &&
               (!jk || item.jenis_kelamin === jk) &&
               (!status || item.status_kepegawaian === status) &&
               (!currentPangkat || (item.pangkat || 'Tanpa Pangkat') === currentPangkat);
    });

    if ($.fn.DataTable.isDataTable('#tabelDetail')) {
        table.clear().rows.add(filtered).draw();
    } else {
        table = $('#tabelDetail').DataTable({
            data: filtered,
            columns: [
                { data: 'nama' },
                { data: 'nip_lama', defaultContent: '-' },
                { data: 'nip_baru', defaultContent: '-' },
                { data: 'fakultas' },
                { data: 'departemen' },
                { data: 'pendidikan_terakhir' }

            ],
            pageLength: 10,

        });
    }
}

$(document).ready(() => {
    initFilter();
    updateChart();
    $('#filterFakultas, #filterDepartemen, #filterJK, #filterStatus').change(() => {currentPangkat = ''; updateChart();});
});
</script>
@endsection
