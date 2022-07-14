@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <span>{{date('d M Y', strtotime(now()))}}</span>
        </div>
      </div>
    </div>
  </div>
    <div class="row g-3 my-2">
        <div class="col-md-6">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-center">
                    <h3>{{$barang}}</h3>
                    <p>Barang</p>
                    <a href="{{route('barang.index')}}" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                      lihat semua
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-center">
                    <h3>{{$kategori}}</h3>
                    <p>Kategori</p>
                    <a href="{{route('kategori.index')}}" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                      lihat semua
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('script')
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
@endpush --}}
