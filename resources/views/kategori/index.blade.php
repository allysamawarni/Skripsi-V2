@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h3>Daftar Kategori</h3>

          @if(Auth::user()->getRoleNames()[0] == 'Admin')
          <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah</a>
        @endif
        </div>
        <div class="card-body">
          <table class="table" id="crudTable">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Kategori</th>
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
            bAutoWidth: false,
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
                    data: 'nama_kategori',
                    name: 'nama_kategori',
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
