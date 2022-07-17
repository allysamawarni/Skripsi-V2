@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h3>Stok Barang</h3>
      <a href="{{ route('stok.create') }}" type="button" class="btn btn-primary">Tambah</a>
    </div>
    <div class="card-body">
      <table class="table scroll-horizontal-vertical" id="crudTable">
          <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah Stok</th>
                <th>Keterangan</th>
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
                    data: 'nama_barang',
                    name: 'nama_barang',
                },
                {
                    data: 'jumlah_stok',
                    name: 'jumlah_stok',
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
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
