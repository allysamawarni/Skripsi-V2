@extends('layouts.main')

@section('container')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Penanggungjawab</h3>

        @if(Auth::user()->getRoleNames()[0] == 'Admin')
        <a href="{{ url('create_pj')}}" type="button" class="btn btn-primary">Tambah</a>
        @endif
    </div>
    <div class="card-body">
        <table class="table" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
    <script>
        let datatable = $('#crudTable').DataTable({
            ordering: true,
            searchable: true,
            bAutoWidth: false,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    width: '5%',
                    className: 'dt-body-center',
                    searchable: false,
                    sortable: false,

                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'tahun',
                    name: 'tahun',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    width: '10%',

                    orderable: false,
                    searchable: false,
                    sortable: false
                },
            ]
        });
    </script>
@endpush