@extends('components.app-admin')
@section('content')
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
        <li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
        <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
        <li><span class="text-main-600 fw-normal text-15">Semester</span></li>
        </ul>
        </div>


        <div class="card mt-24 overflow-hidden">
            <div class="card-header">
                <div class="mb-0 flex-between flex-wrap gap-8">
                    <h4 class="mb-0">{{$title}}</h4>
                    <div class="search-input">
                        <button type="submit" class="btn btn-main rounded-pill py-9 w-100">Tambah Data+</button>
                    </div>

                </div>


            </div>

            <div class="plan-item rounded-16 border border-gray-100 transition-2 position-relative">
            <div class="card-body p-0 overflow-x-auto scroll-sm scroll-sm-horizontal">
                <table class="table table-bordered" id="refsemester-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Semester Aktif</th>
                            <th>Semester Nama</th>
                            <th>Semester Tahun</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                </table>
            </div>
            </div>
         </div>


         <script type="text/javascript">
            $(function () {
                $('#refsemester-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('semester.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'semIsAktif', name: 'semIsAktif'},
                        {data: 'semNama', name: 'semNama'},
                        {data: 'semTahun', name: 'semTahun'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
        </script>
@endsection
