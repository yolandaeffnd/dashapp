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

        #tabelDetail,
        #tabelDetail th,
        #tabelDetail td {
            border: 1px solid #dee2e6 !important;
            border-collapse: collapse;
        }
    </style>

    <div class="container mt-4">
        <div class="card p-3">
            <div class="card-body">
                <h2 class="text-center text-xl font-bold mb-4">Jumlah Tendik Per-Jabatan</h2>

                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label class="font-semibold">Pilih Unit:</label>
                        <select id="filterUnitKerja" class="form-control form-control-sm">
                            <option value="">-- Semua Unit --</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label class="font-semibold">Jenis Kelamin</label>
                        <select id="filterJK" class="form-control form-control-sm">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label class="font-semibold">Status:</label>
                        <select id="filterStatusKepegawaian" class="form-control form-control-sm">
                            <option value="">-- Semua Status --</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-12">
                        <canvas id="chartTendik" style="max-height:500px; width:100%;"></canvas>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3 class="text-lg font-semibold mb-2">Detail Data Pegawai</h3>
                        <div class="table-responsive">
                            <table id="tabelDetail" class="table table-bordered">
                                <thead>
                                    <tr class="table-primary text-center">
                                        <th style="width: 300px;">Nama</th>
                                        <th>NIP/NIKU</th>
                                        <th>Unit Kerja</th>
                                        <th>Nama Jabatan</th>
                                        <th>Status Kepegawian</th>
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
        let currentKlasifikasiJabatan = '';

        function initFilter() {
            const unitKerja = [...new Set(dataApi.map(item => item.unit_kerja))];
            const statusKepegawaian = [...new Set(dataApi.map(item => item.status_kepegawaian))];

            unitKerja.forEach(u => $('#filterUnitKerja').append(`<option value="${u}">${u}</option>`));
            statusKepegawaian.forEach(s => $('#filterStatusKepegawaian').append(`<option value="${s}">${s}</option>`));
        }

        Chart.register(ChartDataLabels);
        const ctx = document.getElementById('chartTendik').getContext('2d');
        let chartTendik = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Jumlah Tendik',
                    data: [],
                    backgroundColor: [
                        '#4a90e2', '#e94e77', '#2ecc71', '#f1c40f', '#9b59b6',
                        '#3498db', '#e67e22', '#1abc9c', '#ffcc00', '#ff5733'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'top'
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#000',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grace: '8%'
                    },
                    x: {
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 30
                        }
                    }
                },
                onClick: (e, elements) => {
                    if (elements.length > 0) {
                        const clickedElementIndex = elements[0].index;
                        currentKlasifikasiJabatan = chartTendik.data.labels[clickedElementIndex];
                        updateTable();
                    }
                }
            }
        });

        let table;

        function updateChart() {
            const unit_kerja = $('#filterUnitKerja').val();
            const jk = $('#filterJK').val();
            const status_kepegawaian = $('#filterStatusKepegawaian').val();

            const filtered = dataApi.filter(item =>
                (!unit_kerja || item.unit_kerja === unit_kerja) &&
                (!jk || item.jenis_kelamin === jk) &&
                (!status_kepegawaian || item.status_kepegawaian === status_kepegawaian)
            );

            const grouped = {};
            filtered.forEach(d => {
                const klasifikasi_jabatan = d.klasifikasi_jabatan || 'Tanpa Klasifikasi';
                grouped[klasifikasi_jabatan] = (grouped[klasifikasi_jabatan] || 0) + 1;
            });

            chartTendik.data.labels = Object.keys(grouped);
            chartTendik.data.datasets[0].data = Object.values(grouped);
            chartTendik.update();

            updateTable();
        }

        function updateTable() {
            const unit_kerja = $('#filterUnitKerja').val();
            const jk = $('#filterJK').val();
            const status_kepegawaian = $('#filterStatusKepegawaian').val();

            const filtered = dataApi.filter(item =>
                (!unit_kerja || item.unit_kerja === unit_kerja) &&
                (!jk || item.jenis_kelamin === jk) &&
                (!status_kepegawaian || item.status_kepegawaian === status_kepegawaian) &&
                (!currentKlasifikasiJabatan || (item.klasifikasi_jabatan || 'Tanpa Klasifikasi') ===
                    currentKlasifikasiJabatan)
            );

            if ($.fn.DataTable.isDataTable('#tabelDetail')) {
                table.clear().rows.add(filtered).draw();
            } else {
                table = $('#tabelDetail').DataTable({
                    data: filtered,
                    columns: [{
                            data: 'nama'
                        },
                        {
                            data: 'nip_niku',
                            defaultContent: '-'
                        },
                        {
                            data: 'unit_kerja',
                            defaultContent: '-'
                        },
                        {
                            data: 'nama_jabatan',
                            defaultContent: '-'
                        },
                        {
                            data: 'status_kepegawaian',
                            defaultContent: '-'
                        }
                    ],
                    pageLength: 10
                });
            }
        }

        $(document).ready(() => {
            initFilter();
            updateChart();
            $('#filterUnitKerja, #filterJK, #filterStatusKepegawaian').change(() => {
                currentKlasifikasiJabatan = '';
                updateChart();
            });
        });
    </script>
@endsection
