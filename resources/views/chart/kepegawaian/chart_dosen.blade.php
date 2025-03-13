@extends('components.app-admin')

@section('content')

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
        </div>
    </div>
</div>

<!-- Load Library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    const dataApi = @json($data);

    // Inisialisasi Filter
    function initFilters() {
        const fakultas = [...new Set(dataApi.map(item => item.fakultas))];
        const departemen = [...new Set(dataApi.filter(d => d.departemen).map(item => item.departemen))];
        const statusAktif = [...new Set(dataApi.map(item => item.status_aktif))];

        fakultas.forEach(f => $("#filterFakultas").append(`<option value="${f}">${f}</option>`));
        departemen.forEach(d => $("#filterDepartemen").append(`<option value="${d}">${d}</option>`));
        statusAktif.forEach(s => $("#filterStatus").append(`<option value="${s}">${s}</option>`));
    }

    // Inisialisasi Chart
    Chart.register(ChartDataLabels);

    const ctx = document.getElementById('chartDosen').getContext('2d');
    let dosenChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Jumlah Dosen',
                data: [],
                backgroundColor: '#1e90ff'
            }]
        },
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
                x: {ticks: {autoSkip: false, maxRotation: 100, minRotation: 30}}
            },
        }
    });

    // Fungsi Update Chart
    function updateChart() {
        const fakultasFilter = $("#filterFakultas").val();
        const departemenFilter = $("#filterDepartemen").val();
        const statusFilter = $("#filterStatus").val();

        const filtered = dataApi.filter(item => {
            return (!fakultasFilter || item.fakultas === fakultasFilter) &&
                   (!departemenFilter || item.departemen === departemenFilter) &&
                   (!statusFilter || item.status_aktif === statusFilter);
        });

        const labels = filtered.map(item => item.departemen ?? 'Tanpa Departemen');
        const jumlahDosen = filtered.map(item => item.jumlah_dosen);

        dosenChart.data.labels = labels;
        dosenChart.data.datasets[0].data = jumlahDosen;
        dosenChart.update();
    }

    $(document).ready(function() {
        initFilters();
        updateChart();

        // Event Listener Filter
        $('#filterFakultas, #filterDepartemen, #filterStatus').change(() => updateChart());
    });
</script>

@endsection
