@extends('layouts.main')

@section('container')
  <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h3>Daftar Pemakaian Barang</h3>
        <a href="{{ route('pemakaian.create') }}" type="button" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body">
        <table class="table" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Kegiatan</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Jumlah Item</th>
                    {{-- <th>Aksi</th> --}}
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
                  data:'nama_peminjam',
                  name: 'nama_peminjam',
                },
                {
                    data: 'nama_kegiatan',
                    name: 'nama_kegiatan',
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang',
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
                // {
                //     data: 'aksi',
                //     name: 'aksi',
                //     width: '5%',
                //
                //     orderable: false,
                //     searchable: false,
                //     sortable: false
                // },
            ]
        });
    </script>
@endpush
