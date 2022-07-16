@extends('layouts.main')

@section('container')
  <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h3>Daftar Komplain Barang</h3>
        <a href="{{ route('komplain.create') }}" type="button" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body">
        <table class="table" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Nama Barang</th>
                    <th>Pesan Komplain</th>
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
                    data: 'nama_barang',
                    name: 'nama_barang',
                },
                {
                    data: 'pesan',
                    name: 'pesan',
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
