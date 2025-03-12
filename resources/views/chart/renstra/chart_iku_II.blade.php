@extends('components.app-admin')

@section('content')
    <div class="container mt-4">
        <div class="card px-30">
            <div class="card-body">
                <h2>Chart IKU II</h2>

                <!-- Filter -->
                <label for="tahun">Pilih Tahun:</label>
                <select id="tahun">
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ $tahunDipilih == $year ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endforeach
                </select>

                <label for="sub_kategori">Pilih Sub Kategori:</label>
                <select id="sub_kategori">
                    <option value="all" {{ $subKategoriDipilih == 'all' ? 'selected' : '' }}>Semua Sub Kategori</option>

                    @foreach ($subCategories as $subKategori)
                        <option value="{{ $subKategori }}" {{ $subKategoriDipilih == $subKategori ? 'selected' : '' }}>
                            {{ $subKategori }}
                        </option>
                    @endforeach
                </select>

                <canvas id="ikuChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function updateChart() {
            var tahun = document.getElementById('tahun').value;
            var subKategori = document.getElementById('sub_kategori').value;

            window.location.href = '?tahun=' + tahun + '&sub_kategori=' + subKategori;
        }

        // Event listener untuk perubahan tahun dan sub kategori
        document.getElementById('tahun').addEventListener('change', updateChart);
        document.getElementById('sub_kategori').addEventListener('change', updateChart);

        // Data chart dari controller
        var labels = @json($labels); // Fakultas
        var dataset = @json($dataset); // Data untuk subkategori

        // Buat chart dengan Chart.js
        var ctx = document.getElementById('ikuChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Jenis chart
            data: {
                labels: labels, // Fakultas
                datasets: Object.keys(dataset).map(function(subkategori, index) {
                    return {
                        label: subkategori, // Nama subkategori
                        data: dataset[subkategori], // Nilai untuk setiap fakultas dan subkategori
                        backgroundColor: 'rgba(' + (index * 50) + ', 162, 235, 0.5)', // Warna bar
                        borderColor: 'rgba(' + (index * 50) + ', 162, 235, 1)',
                        borderWidth: 1
                    };
                })
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            },
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
                        anchor: 'start', // Mengubah anchor untuk menyesuaikan posisi lebih baik
                        align: 'top', // Label akan diletakkan di tengah atas bar
                        offset: 20, // Memberi sedikit ruang agar label tidak terlalu dekat dengan bar
                        formatter: (value) => value > 0 ? value : '', // Menampilkan nilai jika lebih dari 0
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        color: '#000'

                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Semester'
                        }
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Mahasiswa'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endsection
