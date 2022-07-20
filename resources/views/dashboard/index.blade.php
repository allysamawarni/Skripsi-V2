@extends('layouts.main')

@section('container')
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
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
      @if(Auth::user()->getRoleNames()[0] != 'Ukm')
        <div class="col-md-4">
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
        <div class="col-md-4">
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
        <div class="col-md-4">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                <div class="text-center">
                    <h3>{{$komplain}}</h3>
                    <p>Komplain</p>
                    <a href="{{route('komplain.index')}}" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                      lihat semua
                    </a>
                </div>
            </div>
        </div>
      @else
        <div class="col-lg-12 mx-auto">
            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
              <h1 class="fw-light">Sistem Informasi Inventaris Paduan Suara Universitas Pancasila</h1>
            </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              History Pemakaian Saya
            </div>
            <div class="card-body">
              <table class="table" id="crudTable">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>User</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Kegiatan</th>
                          <th>Nama Barang</th>
                          <th>Tanggal Pinjam</th>
                          <th>Di terima oleh</th>
                          <th>Tanggal Pengembalian</th>
                          <th>Jumlah Item</th>
                          <th>Jumlah Diterima</th>
                          <th>Jumlah Pengembalian</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
        @php($komplains = App\Models\Komplain::where('id_user', Auth::user()->id)->orderBy('id_komplain', 'desc')->limit(5)->get())
        @if(count($komplains)>0)
          @foreach ($komplains as $key => $komplain)
          @php($balasan = App\Models\Komplain::where('parent_id', $komplain->id_komplain)->first())
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                Komplain Saya
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    Nama Barang
                  </div>
                  <div class="col-md-10">
                    <strong>
                      {{$komplain->barang ? $komplain->barang->nama_barang : 'DELETED'}}
                    </strong>
                  </div>
                  <div class="col-md-2">
                    Pesan
                  </div>
                  <div class="col-md-10">
                    <strong>
                      {{$komplain->pesan}}
                    </strong>
                  </div>
                  <div class="col-md-2">
                    Balasan
                  </div>
                  <div class="col-md-10">
                    <strong>
                      {{$balasan && $balasan->pesan}}
                    </strong>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @endforeach
        @endif
      @endif
    </div>
@endsection
@push('script')

<script>
function insertJumlah(id) {
  let person = prompt("Masukkan jumlah barang yang diterima.");
  if (person != null) {
    var saveData = $.ajax({
          type: 'POST',
          url: '{!! url()->current().'/terima-barang' !!}',
          data: {id_pemakaian: id, jumlah_diterima: person, "_token": $('#token').val()},
          dataType: "text",
          success: function(resultData) {
            location.reload();
          }
    });
    saveData.error(function() { alert("Something went wrong"); });
  }
}
function kembalikanJumlah(id) {
  let person = prompt("Masukkan jumlah barang yang akan dikembalikan.");
  if (person != null) {
    var saveData = $.ajax({
          type: 'POST',
          url: '{!! url()->current().'/kembali-barang' !!}',
          data: {id_pemakaian: id, jumlah_dikembalikan: person, "_token": $('#token').val()},
          dataType: "text",
          success: function(resultData) {
            location.reload();
          }
    });
    saveData.error(function() { alert("Something went wrong"); });
  }
}
</script>
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
                    data: 'id_user',
                    name: 'id_user',
                },
                {
                  data:'nama_peminjam',
                  name: 'nama_peminjam',
                },
                {
                    data: 'nama_kegiatan',
                    name: 'nama_kegiatan',
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang',
                },
                {
                    data: 'tgl_pinjam',
                    name: 'tgl_pinjam',
                },
                {
                    data: 'acc_ketua',
                    name: 'acc_ketua',
                },
                {
                    data: 'tgl_pengembalian',
                    name: 'tgl_pengembalian',
                },
                {
                    data: 'jml_item',
                    name: 'jml_item',
                },
                {
                    data: 'jumlah_diterima',
                    name: 'jumlah_diterima',
                },
                {
                    data: 'jumlah_dikembalikan',
                    name: 'jumlah_dikembalikan',
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
