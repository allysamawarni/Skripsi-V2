@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h3>Daftar Pengguna Baru</h3>

      @if(Auth::user()->getRoleNames()[0] == 'Admin')
        <a href="{{ route('user.create') }}" type="button" class="btn btn-primary">Tambah Pengguna Baru</a>
      @endif
    </div>
    <div class="card-body">
      <table class="table scroll-horizontal-vertical" id="crudTable">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Roles</th>
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
                    data: 'email',
                    name: 'email',
                },

                {
                    data: 'roles',
                    name: 'roles',
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
