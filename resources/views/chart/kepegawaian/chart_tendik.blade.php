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
            <h2 class="text-center text-xl font-bold mb-4">Jumlah Status Kepegawaian Per-Unit Kerja</h2>

            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-4 col-sm-12 mb-3">
                    <label class="font-semibold">Pilih Unit:</label>
                    <select id="filterUnitKerja" class="form-select">
                        <option value="">Semua Unit</option>
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
                    <label class="font-semibold">Klasifikasi Jabatan:</label>
                    <select id="filterKlasifikasiJabatan" class="form-select">
                        <option value="">Semua Klasifikasi</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-xl-10 col-md-12 col-sm-12">
                    <canvas id="chartTendik"></canvas>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="tabelDetail" class="table">
                            <thead>
                                <tr class="table-primary">
                                    <th>Nama</th>
                                    <th>NIP/NIKU</th>
                                    <th>Unit Kerja</th>
                                    <th>Nama Jabatan</th>
                                    <th>Status Kepegawaian</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
    const dataApi = @json($data);

    function initFilter() {
        const unitKerja = [...new Set(dataApi.map(item => item.unit_kerja))];
        const klasifikasiJabatan = [...new Set(dataApi.map(item => item.klasifikasi_jabatan).filter(Boolean))];

        unitKerja.forEach(u => $('#filterUnitKerja').append(`<option value="${u}">${u}</option>`));
        klasifikasiJabatan.forEach(k => $('#filterKlasifikasiJabatan').append(`<option value="${k}">${k}</option>`));
    }

    Chart.register(ChartDataLabels);
    const ctx = document.getElementById('chartTendik').getContext('2d');
    let chartTendik = new Chart(ctx, {
        type: 'bar',
        data: { labels: [], datasets: [] },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' },
                datalabels: { anchor: 'end', align: 'top', color: '#000', font: { weight: 'bold' } }
            },
            scales: {
                y: { beginAtZero: true, grace: '8%' },
                x: { ticks: { autoSkip: false, maxRotation: 45, minRotation: 30 } }
            },
            onClick: function(evt, elements) {
                if (elements.length > 0) {
                    const index = elements[0].index;
                    const selectedUnit = chartTendik.data.labels[index];
                    $('#filterUnitKerja').val(selectedUnit).trigger('change');
                }
            }
        }
    });

    let table;
    function updateChart() {
        const unit_kerja = $('#filterUnitKerja').val();
        const jk = $('#filterJK').val();
        const klasifikasi_jabatan = $('#filterKlasifikasiJabatan').val();

        const filtered = dataApi.filter(item =>
            (!unit_kerja || item.unit_kerja === unit_kerja) &&
            (!jk || item.jenis_kelamin === jk) &&
            (!klasifikasi_jabatan || item.klasifikasi_jabatan === klasifikasi_jabatan)
        );

        const grouped = {};
        filtered.forEach(d => {
            const unit = d.unit_kerja || 'Tanpa Unit';
            const status = d.status_kepegawaian || 'Tanpa Status';

            if (!grouped[unit]) grouped[unit] = {};
            grouped[unit][status] = (grouped[unit][status] || 0) + 1;
        });

        const units = Object.keys(grouped);
        const statuses = [...new Set(filtered.map(d => d.status_kepegawaian))];

        const datasets = statuses.map(status => ({
            label: status,
            data: units.map(unit => grouped[unit][status] || 0),
            backgroundColor: getRandomColor()
        }));

        chartTendik.data.labels = units;
        chartTendik.data.datasets = datasets;
        chartTendik.update();

        updateTable();
    }

    function updateTable() {
        const unit_kerja = $('#filterUnitKerja').val();
        const jk = $('#filterJK').val();
        const klasifikasi_jabatan = $('#filterKlasifikasiJabatan').val();

        const filtered = dataApi.filter(item =>
            (!unit_kerja || item.unit_kerja === unit_kerja) &&
            (!jk || item.jenis_kelamin === jk) &&
            (!klasifikasi_jabatan || item.klasifikasi_jabatan === klasifikasi_jabatan)
        );

        if ($.fn.DataTable.isDataTable('#tabelDetail')) {
            table.clear().rows.add(filtered).draw();
        } else {
            table = $('#tabelDetail').DataTable({
                data: filtered,
                columns: [
                    { data: 'nama' },
                    { data: 'nip_niku', defaultContent: '-' },
                    { data: 'unit_kerja', defaultContent: '-' },
                    { data: 'nama_jabatan', defaultContent: '-' },
                    { data: 'status_kepegawaian', defaultContent: '-' }
                ],
                pageLength: 10
            });
        }
    }

    function getRandomColor() {
        return `hsl(${Math.random() * 360}, 70%, 50%)`;
    }

    $(document).ready(() => {
        initFilter();
        updateChart();
        $('#filterUnitKerja, #filterJK, #filterKlasifikasiJabatan').change(updateChart);
    });
</script>
@endsection
