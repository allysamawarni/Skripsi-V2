@extends('layouts.main')

@section('container')
  <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h3>Daftar Perawatan Barang</h3>

        @if(Auth::user()->getRoleNames()[0] == 'Admin')
        <a href="{{ route('perawatan.create') }}" type="button" class="btn btn-primary">Tambah</a>
      @endif
      </div>
      <div class="card-body">
        <table class="table" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Nama Ukuran</th>
                    <th>Jumlah Dirawat</th>
                    <th>Status</th>
                    <th>Tanggal Perawatan</th>
                    <th>Status Perawatan</th>
                    <th>Foto</th>
                    <th>Action</th>
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
                    data: 'nama_ukuran',
                    name: 'nama_ukuran',
                },
                {
                    data: 'jml_item',
                    name: 'jml_item',
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
                    data: 'status_perawatan',
                    name: 'status_perawatan',
                },
                {
                    data: 'foto_perawatan',
                    name: 'foto_perawatan',
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
