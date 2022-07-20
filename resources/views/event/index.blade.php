@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3>Daftar Event</h3>

            @if(Auth::user()->getRoleNames()[0] == 'Admin')
            <a href="{{ route('event.create') }}" type="button" class="btn btn-primary">Tambah</a>
          @endif
          </div>
          <div class="card-body">
            <table class="table scroll-horizontal-vertical" id="crudTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Kebutuhan</th>
                        <th>Jumlah</th>
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
                // {
                //     data: 'id',
                //     name: 'id',
                // },
                {
                    data: 'nama_event',
                    name: 'nama_event',
                },
                {
                    data: 'kebutuhan',
                    name: 'kebutuhan',
                },
                {
                    data: 'jumlah',
                    name: 'jumlah',
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
