@extends('layouts.main')

@section('container')
    <a href="{{ route('pemakaian.create') }}" type="button" class="btn btn-primary">Tambah</a>

    <div class="box-body table-responsive mt-5">
        <table class="table scroll-horizontal-vertical" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Jumlah Item</th>
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
                    data: 'id_user',
                    name: 'id_user',
                },
                {
                    data: 'nama_kegiatan',
                    name: 'nama_kegiatan',
                },
                {
                    data: 'tgl_pinjam',
                    name: 'tgl_pinjam',
                },
                {
                    data: 'tgl_pengembalian',
                    name: 'tgl_pengembalian',
                },
                {
                    data: 'jml_item',
                    name: 'jml_item',
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
