@extends('components.app-admin')
@section('content')
<button class="btn btn-primary mb-3" onClick="modalAdd()">Add Chart</button>
<div class="modal" id="modalAdd">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal"></h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('crudAppchart') }}">
                @csrf
                <input id='id_' type="hidden" name="id" required>

                <div class="mb-3">
                    <select id="idKategori_" class="form-select" aria-label="Default select example" name="idKategori">
                        <option value="" selected disabled hidden>--- Choose Kategori ---</option>
                        @foreach ($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <input id='namaChart_' class='form-control' type="text" name="namaChart" placeholder="Nama Chart" required>
                </div>

                <div class="mb-3">
                    <input id='urlChart_' class='form-control' type="text" name="urlChart" placeholder="Url Chart" required>
                </div>

                <div class="mb-3">
                    <select id="idFakultas_" class="form-select" aria-label="Default select example" name="idFakultas">
                        <option value="" selected disabled hidden>--- Pilih Fakultas ---</option>
                        @foreach ($fakultas as $data)
                            <option value="{{ $data->id }}">{{ $data->fakNama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <select id='posisiChart_' class="form-select" aria-label="Default select example" name='posisiChart'>
                        <option value="" selected disabled hidden>--- Pilih Posisi ---</option>
                        <option value="0">Di Luar</option>
                        <option value="1">Di Dalam</option>

                    </select>
                </div>

                <button id="submit_" type="submit" name="action" class="btn btn-primary w-100"></button>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modalDel">
    <div class="modal-content">
        <span class="close" style="cursor: pointer;">&times;</span>
        <div class="text-center mb-2">
            <h4 id="titleModal">Delete Chart</h4>
        </div>
        <div class="modal-body text-center">
            <p>Are you sure you want to delete this item? This action cannot be undone.</p>
            <form method="POST" action="{{ route('crudAppchart') }}">
                @csrf
                <input type="hidden" id="idDel" name="id">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary w-100" id="cancelButton">Cancel</button>
                    <button id="submit_" type="submit" name="action" value="DELETE" class="btn btn-danger w-100">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card card-margin">
    <div class="card-body">
        <table id="menus-table" class="display table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Nama Chart</th>
                    <th>Url Chart</th>
                    <th>Fakultas</th>
                    <th>Posisi Chart</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="charts-tbody">
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
    fetch('{{ route("getAppchart") }}')
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('charts-tbody');
        tbody.innerHTML = '';
        let autoIncrementId = 1;
        data.forEach(chart => {
            const row = document.createElement('tr');
            const noCell = document.createElement('td');
            noCell.textContent += autoIncrementId;
            row.appendChild(noCell);
            autoIncrementId++;

            const kategoriCell = document.createElement('td');
            kategoriCell.textContent = chart.kategori ? chart.kategori.name : 'Tidak ada kategori';
            row.appendChild(kategoriCell);

            const namachartCell = document.createElement('td');
            namachartCell.textContent = chart.namaChart;
            row.appendChild(namachartCell);

            const urlchartCell = document.createElement('td');
            urlchartCell.textContent = chart.urlChart;
            row.appendChild(urlchartCell);

            const fakultasCell = document.createElement('td');
            fakultasCell.textContent = chart.fakultas ? chart.fakultas.fakNama : 'Tidak ada kategori';
            row.appendChild(fakultasCell);

            const posisichartCell = document.createElement('td');
            posisichartCell.textContent = chart.posisiChart == 0 ? 'Di Luar' : 'Di Dalam';
            row.appendChild(posisichartCell);

            const actionCell = document.createElement('td');
            actionCell.innerHTML = `
                <button onClick='modalEdit(${chart.id},"${chart.idKategori}","${chart.namaChart}","${chart.urlChart}","${chart.idFakultas}","${chart.posisiChart}")' class="btn btn-xs btn-success">Edit</button>
                <button onClick='modalDelete(${chart.id})' class="btn btn-xs btn-danger">Delete</button>
            `;
            row.appendChild(actionCell);
            tbody.appendChild(row);
        });
        $('#menus-table').DataTable();
    });
});
</script>
<script type="text/javascript">
    function modalAdd(){
        document.getElementById('id_').value='';
        document.getElementById('idKategori_').value='';
        document.getElementById('namaChart_').value='';
        document.getElementById('urlChart_').value='';
        document.getElementById('idFakultas_').value='';
        document.getElementById('posisiChart_').value='';

        const btnSubmit = document.getElementById("submit_");
        btnSubmit.textContent = "Save"
        btnSubmit.value = "SAVE"

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('modalAdd');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }

        const titleModal = document.getElementById("titleModal");
        titleModal.textContent = "Add Kategori"

        window.onclick = function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        }
        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalEdit(id,name,jenis){
        document.getElementById('id_').value=id;
        document.getElementById('idKategori_').value='';
        document.getElementById('namaChart_').value='';
        document.getElementById('urlChart_').value='';
        document.getElementById('idFakultas_').value='';
        document.getElementById('posisiChart_').value='';

        const btnSubmit = document.getElementById("submit_");
        btnSubmit.textContent = "Update"
        btnSubmit.value = "UPDATE"

        const span = document.getElementsByClassName("close")[0];
        const modal = document.getElementById('modalAdd');
        modal.style.display = "block";
        span.onclick = function(){
            modal.style.display = "none";
        }

        const titleModal = document.getElementById("titleModal");
        titleModal.textContent = "Edit Jenis"

        window.onclick = function(event){
            if(event.target === modal){
                modal.style.display = "none";
            }
        }
        btnSubmit.onclick = function(){
            modal.style.display = "none";
        }
    }

    function modalDelete(id) {
        document.getElementById('idDel').value = id;
        const modal = document.getElementById('modalDel');
        modal.style.display = "block";

        const span = document.getElementsByClassName("close")[1];
        span.onclick = function() {
            modal.style.display = "none";
        }

        const cancelButton = document.getElementById('cancelButton');
        cancelButton.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    }
</script>
@endsection
