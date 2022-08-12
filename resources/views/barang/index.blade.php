@extends('layouts.main')

@section('container')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <h3>Daftar Barang</h3>
        @if(Auth::user()->getRoleNames()[0] == 'Admin')
        <a href="{{ route('barang.create') }}" type="button" class="btn btn-primary">Tambah</a>
        @endif
      </div>
      <div class="card-body">
        <table class="table scroll-horizontal-vertical" id="crudTable">
          <thead>
            <tr>
              <th class="border-top">No</th>
              <th class="border-top">Kategori</th>
              <th class="border-top">Nama</th>
              <th class="border-top">Tahun</th>
              <th class="border-top">Umur Ekonomis</th>
              <th class="border-top">Harga Beli</th>
              <th class="border-top">Nilai Residu</th>
              <th class="border-top">Stok</th>
              <th class="border-top">Biaya Penyusutan</th>
              <th class="border-top">Per Tahun</th>
              <th class="border-top">Gambar</th>
              <th class="border-top text-center">Aksi</th>
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
    // 'copy', 'csv', 'excel', 'pdf',
    buttons: [{
 
      },
      {
        extend: 'print',
        exportOptions: {
                    columns:[ 0, 1, 2, 3, 4, 5, 6, 7 ]
        },
        customize: function(win) {
          $(win.document.body)
            .css('font-size', '10pt')
            .css('padding-top', '150px')
            .css('margin', '20px')
            // .css('background-image', 'http://localhost:8000/storage/assets/pancasila.png')
            .prepend(
              '<img src="http://localhost:8000/storage/assets/pancasila.png" style="position:absolute; top:0; left:50px;  z-index: -99" />'
            );
            

          $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');
          
          var penanggungjawab = "<?= $penanggungjawab->name ?>";
  
          $(win.document.body)
            .append('<h5 style = "margin-top:20px; margin-left:600px">Tanda Tangan </h5></br></br></br><h5 style = "margin-top:20px; margin-left:600px">'+penanggungjawab+'</h5>');
        }
      },
      'colvis'
    ],
    columnDefs: [{
      targets: 1 - 10,
      visible: true
    }],

    ajax: {
      url: '{!! url()->current() !!}',
    },

    columns: [{
        data: 'DT_RowIndex',
        width: '10%',
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
        data: 'nilai_residu',
        name: 'nilai_residu',
      },
      {
        data: 'stok_barang',
        name: 'stok_barang',
      },
      {
        data: 'penyusutan',
        name: 'penyusutan'
      },
      {
        data: 'per_tahun',
        name: 'per_tahun'
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
