@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3>Daftar Barang</h3>
            <a href="{{ route('barang.create') }}" type="button" class="btn btn-primary">Tambah</a>
          </div>
          <div class="card-body">
            <table class="table scroll-horizontal-vertical" id="crudTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Tahun</th>
                        <th>Umur Ekonomis</th>
                        <th>Harga Beli</th>
                        <th>Biaya Penyusutan</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
          </div>
      </div>
    </div>
  </div>

@endsection
@push('script')
    <script>
        let datatable = $('#crudTable').DataTable({
            ordering: true,
            searchable: true,
            dom: 'Bfrtip',
            // autoFill: true,
            buttons: [
                'colvis',
                'csv',
                'excel'
            ],
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
                    data: 'umur_barang',
                    name: 'umur_barang',
                },
                {
                    data: 'harga_barang',
                    name: 'harga_barang',
                },
                {
                  data: 'penyusutan',
                  name: 'penyusutan'
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
