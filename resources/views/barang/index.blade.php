@extends('layouts.main')

@section('container')
    <a href="{{ route('barang.create') }}" type="button" class="btn btn-primary">Tambah</a>

    <div class="box-body table-responsive mt-5">
        <table class="table scroll-horizontal-vertical" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Gambar</th>
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
                    data: 'id_kategori',
                    name: 'id_kategori',
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang',
                },
                {
                    data: 'stok_barang',
                    name: 'stok_barang',
                },
                {
                    data: 'tahun_barang',
                    name: 'tahun_barang',
                },
                {
                    data: 'harga_barang',
                    name: 'harga_barang',
                },
                {
                    data: 'status_barang',
                    name: 'status_barang',
                },
                {
                    data: 'foto_barang',
                    name: 'foto_barang',
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
