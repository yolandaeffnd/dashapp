@extends('components.app-admin')

@section('content')

<div class="container mt-4">
    <div class="card px-3">
        <div class="card-body">
            <h2 class="text-center text-xl font-bold mb-4">Grafik Tracer Study</h2>

            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-6 col-sm-12 mb-3">
                    <label class="font-semibold">Pilih Keterangan:</label>
                    <select id="filterKeterangan" class="form-select">
                        <option value="">Semua Keterangan</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-6 col-sm-12 mb-3">
                    <label class="font-semibold">Pilih Tahun Lulus:</label>
                    <select id="filterTahun" class="form-select">
                        <option value="">Semua Tahun</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-xl-10 col-md-12 col-sm-12">
                    <canvas id="chartKondisi"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

{{-- <script>
    const dataApi = @json($data);

    Chart.register(ChartDataLabels);

    const ctx = document.getElementById('chartKondisi').getContext('2d');
    let kondisiChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Jumlah Jawaban',
                data: [],
                backgroundColor: '#4caf50'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
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
                y: { beginAtZero: true, grace: '5%' },
                x: { ticks: { autoSkip: false, maxRotation: 30, minRotation: 0 } }
            }
        }
    });

    function initKeteranganFilter() {
        const uniqueKeterangan = [...new Set(dataApi.map(item => item.keterangan.trim()))];
        uniqueKeterangan.forEach(ket => {
            $('#filterKeterangan').append(`<option value="${ket}">${ket}</option>`);
        });
    }

    function updateChart() {
        const keteranganFilter = $('#filterKeterangan').val();

        const filtered = dataApi.filter(item =>
            !keteranganFilter || item.keterangan.trim() === keteranganFilter
        );

        // Kelompokkan berdasarkan nilaiJawaban
        const grouped = {};
        filtered.forEach(item => {
            grouped[item.nilaiJawaban] = (grouped[item.nilaiJawaban] || 0) + item.jawaban;
        });

        const labels = Object.keys(grouped);
        const data = Object.values(grouped);

        kondisiChart.data.labels = labels;
        kondisiChart.data.datasets[0].data = data;
        kondisiChart.update();
    }

    $(document).ready(function() {
        initKeteranganFilter();
        updateChart();

        $('#filterKeterangan').change(() => updateChart());
    });
</script> --}}

<script>
    const dataApi = @json($data);

    Chart.register(ChartDataLabels);

    const ctx = document.getElementById('chartKondisi').getContext('2d');
    let kondisiChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Jumlah Jawaban',
                data: [],
                backgroundColor: '#4caf50'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
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
                y: { beginAtZero: true, grace: '5%' },
                x: { ticks: { autoSkip: false, maxRotation: 30, minRotation: 0 } }
            }
        }
    });

    function initKeteranganFilter() {
        const uniqueKeterangan = [...new Set(dataApi.map(item => item.keterangan.trim()))];
        uniqueKeterangan.forEach(ket => {
            $('#filterKeterangan').append(`<option value="${ket}">${ket}</option>`);
        });
    }

    function initTahunFilter() {
        const uniqueTahun = [...new Set(dataApi.map(item => item.tahun_lulus))];
        uniqueTahun.sort().forEach(thn => {
            $('#filterTahun').append(`<option value="${thn}">${thn}</option>`);
        });
    }

    function updateChart() {
        const keteranganFilter = $('#filterKeterangan').val();
        const tahunFilter = $('#filterTahun').val();

        const filtered = dataApi.filter(item =>
            (!keteranganFilter || item.keterangan.trim() === keteranganFilter) &&
            (!tahunFilter || item.tahun_lulus == tahunFilter)
        );

        // Kelompokkan berdasarkan nilaiJawaban
        const grouped = {};
        filtered.forEach(item => {
            const label = item.nilaiJawaban.trim();
            grouped[label] = (grouped[label] || 0) + item.jawaban;
        });

        const labels = Object.keys(grouped);
        const data = Object.values(grouped);

        kondisiChart.data.labels = labels;
        kondisiChart.data.datasets[0].data = data;
        kondisiChart.update();
    }

    $(document).ready(function() {
    initKeteranganFilter();
    initTahunFilter();

    // Pilih default value pertama setelah "Semua"
    const firstKeterangan = $('#filterKeterangan option:eq(1)').val();
    const firstTahun = $('#filterTahun option:eq(1)').val();

    $('#filterKeterangan').val(firstKeterangan);
    $('#filterTahun').val(firstTahun);

    updateChart();

    $('#filterKeterangan, #filterTahun').change(() => updateChart());
    });

</script>




@endsection
