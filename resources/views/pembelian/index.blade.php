@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3>Daftar Pembelian</h3>

            @if(Auth::user()->getRoleNames()[0] == 'Admin')
            <a href="{{ route('pembelian.create') }}" type="button" class="btn btn-primary">Tambah</a>
          @endif
          </div>
          <div class="card-body">
            <table class="table scroll-horizontal-vertical" id="crudTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pembelian</th>
                        <th>Harga Pembelian</th>
                        <th>Jumlah</th>
                        <th>Diajukan Oleh</th>
                        <th>Disetujui Oleh</th>
                        <th>Gambar Pembelian</th>
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
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'nama_pembelian',
                    name: 'nama_pembelian',
                },
                {
                    data: 'harga_pembelian',
                    name: 'harga_pembelian',
                },
                {
                    data: 'jumlah_pembelian',
                    name: 'jumlah_pembelian',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'assign_by',
                    name: 'assign_by',
                },
                {
                    data: 'image_pembelian',
                    name: 'image_pembelian',
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
