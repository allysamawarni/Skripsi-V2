@extends('layouts.main')

@section('container')
    <a href="{{ route('kategori.create') }}" type="button" class="btn btn-primary">Tambah</a>

    <div class="box-body table-responsive mt-5">
        <table class="table scroll-horizontal-vertical" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection
@push('script')
    <script>
        let datatable = $('#crudTable').DataTable({
            ordering: true,
            searchable: true,

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
                    data: 'email',
                    name: 'email',
                },

                {
                    data: 'roles',
                    name: 'roles',
                },

                {
                    data: 'aksi',
                    name: 'aksi',
                    width: '5%',

                    orderable: false,
                    searchable: false,
                    sortable: false
                },
            ]
        });
    </script>
@endpush
