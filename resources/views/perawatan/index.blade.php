@extends('layouts.main')

@section('container')
  <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h3>Daftar Perawatan Barang</h3>
        <a href="{{ route('perawatan.create') }}" type="button" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body">
        <table class="table" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Status</th>
                    <th>Tanggal Perawatan</th>
                    <th>Foto</th>
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
                  data:'nama_status',
                  name: 'nama_status',
                },
                {
                    data: 'tgl_perawatan',
                    name: 'tgl_perawatan',
                },
                {
                    data: 'foto_perawatan',
                    name: 'foto_perawatan',
                },
            ]
        });
    </script>
@endpush
