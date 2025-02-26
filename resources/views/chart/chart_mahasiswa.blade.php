@extends('components.app-admin')
@section('content')
<div class="container mt-4">
    <h2 class="text-center">Data Mahasiswa</h2>

    <!-- Tabel Mahasiswa -->
    {{-- <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Prodi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs['mhsNama'] }}</td>
                <td>{{ $mhs['prodiNamaResmi'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}

    <!-- Chart -->
    <div class="mb-3">
        <label for="filterProdi" class="form-label">Filter Program Studi:</label>
        <select id="filterProdi" class="form-select">
            <option value="">Semua Program Studi</option>
            @foreach ($listProdi as $prodi)
                <option value="{{ $prodi }}" {{ $selectedProdi == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
            @endforeach
        </select>
    </div>
        <div class="mt-5">
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <script>
        var chartLabels = {!! $chartLabels !!};
        var chartData = {!! $chartData !!};

        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Mahasiswa per Angkatan',
                    data: chartData,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Event listener untuk filter dropdown
        document.getElementById('filterProdi').addEventListener('change', function () {
            var selectedProdi = this.value;
            var url = new URL(window.location.href);

            if (selectedProdi) {
                url.searchParams.set('prodi', selectedProdi);
            } else {
                url.searchParams.delete('prodi');
            }

            window.location.href = url.href; // Reload halaman dengan filter baru
        });
    </script>
@endsection
