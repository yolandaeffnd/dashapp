@extends('components.app-admin')

@section('content')
    <div class="container mt-4">
        <div class="card p-3">
            <div class="card-body">
                <h2 class="text-center text-xl font-bold mb-4">Jumlah Mahasiswa per Program Studi</h2>

                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label for="fakultas" class="font-semibold">Pilih Fakultas:</label>
                        <select id="fakultas" class="form-control form-control-sm">
                            <option value="">-- Semua Fakultas --</option>
                            @foreach ($fakultas as $fak)
                                <option value="{{ $fak }}">{{ $fak }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label for="prodi" class="font-semibold">Pilih Prodi:</label>
                        <select id="prodi" class="form-control form-control-sm" disabled>
                            <option value="">-- Pilih Fakultas Dulu --</option>
                        </select>
                    </div>

                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <canvas id="mahasiswaChart" style="max-height:500px; width:100%;"></canvas>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3 class="text-lg font-semibold mb-2">Detail Data Mahasiswa</h3>
                        <div class="table-responsive">
                            <table id="mahasiswaTable" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr class="table-primary text-center">
                                        <th>Prodi</th>
                                        <th>S1 - Laki-Laki</th>
                                        <th>S1 - Perempuan</th>
                                        <th>S2 - Laki-Laki</th>
                                        <th>S2 - Perempuan</th>
                                        <th>S3 - Laki-Laki</th>
                                        <th>S3 - Perempuan</th>
                                        <th>D3 - Laki-Laki</th>
                                        <th>D3 - Perempuan</th>
                                        <th>Profesi - Laki-Laki</th>
                                        <th>Profesi - Perempuan</th>
                                        <th>SP1 - Laki-Laki</th>
                                        <th>SP1 - Perempuan</th>
                                        <th>SP2 - Laki-Laki</th>
                                        <th>SP2 - Perempuan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let allData = @json($data);
        let fakultasDropdown = document.getElementById("fakultas");
        let prodiDropdown = document.getElementById("prodi");
        let chartInstance;

        function updateProdiOptions() {
            let selectedFakultas = fakultasDropdown.value;
            let filteredProdi = [...new Set(allData
                .filter(item => item.fakultas_nama === selectedFakultas)
                .map(item => item.prodi_nama))];

            prodiDropdown.innerHTML = '<option value="">-- Pilih Prodi --</option>';
            filteredProdi.forEach(prodi => {
                let option = document.createElement("option");
                option.value = prodi;
                option.textContent = prodi;
                prodiDropdown.appendChild(option);
            });

            prodiDropdown.disabled = filteredProdi.length === 0;
        }

        function updateChart() {
            let selectedFakultas = fakultasDropdown.value;
            let selectedProdi = prodiDropdown.value;

            let filteredData = allData.filter(item =>
                (!selectedFakultas || item.fakultas_nama === selectedFakultas) &&
                (!selectedProdi || item.prodi_nama === selectedProdi)
            );

            let labels = filteredData.map(item => item.prodi_nama);
            let datasets = [{
                    label: 'S1 - Laki-Laki',
                    key: 's1_mhs_lakilaki',
                    color: 'blue'
                },
                {
                    label: 'S1 - Perempuan',
                    key: 's1_mhs_perempuan',
                    color: 'lightblue'
                },
                {
                    label: 'S2 - Laki-Laki',
                    key: 's2_mhs_lakilaki',
                    color: 'green'
                },
                {
                    label: 'S2 - Perempuan',
                    key: 's2_mhs_perempuan',
                    color: 'lightgreen'
                },
                {
                    label: 'S3 - Laki-Laki',
                    key: 's3_mhs_lakilaki',
                    color: 'red'
                },
                {
                    label: 'S3 - Perempuan',
                    key: 's3_mhs_perempuan',
                    color: 'pink'
                }
            ].map(ds => ({
                label: ds.label,
                data: filteredData.map(item => item[ds.key]),
                backgroundColor: ds.color
            }));

            let ctx = document.getElementById('mahasiswaChart').getContext('2d');
            if (chartInstance) chartInstance.destroy();

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            updateTable(filteredData);
        }

        function updateTable(filteredData) {
            let tableBody = document.querySelector("#mahasiswaTable tbody");
            tableBody.innerHTML = "";
            filteredData.forEach(item => {
                let row = `<tr>
            <td>${item.prodi_nama}</td>
            <td>${item.s1_mhs_lakilaki}</td>
            <td>${item.s1_mhs_perempuan}</td>
            <td>${item.s2_mhs_lakilaki}</td>
            <td>${item.s2_mhs_perempuan}</td>
            <td>${item.s3_mhs_lakilaki}</td>
            <td>${item.s3_mhs_perempuan}</td>
            <td>${item.d3_mhs_lakilaki}</td>
            <td>${item.d3_mhs_perempuan}</td>
            <td>${item.profesi_mhs_lakilaki}</td>
            <td>${item.profesi_mhs_perempuan}</td>
            <td>${item.sp1_mhs_lakilaki}</td>
            <td>${item.sp1_mhs_perempuan}</td>
            <td>${item.sp2_mhs_lakilaki}</td>
            <td>${item.sp2_mhs_perempuan}</td>
        </tr>`;
                tableBody.innerHTML += row;
            });
        }

        fakultasDropdown.addEventListener("change", () => {
            updateProdiOptions();
            updateChart();
        });

        prodiDropdown.addEventListener("change", updateChart);

        updateChart();
    </script>
@endsection
