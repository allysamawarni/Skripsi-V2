@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Tambah Barang Baru</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group py-2">
                  <select name="id_kategori" id="id_kategori" class="form-control" required>
                      <option value="">Pilih Kategori</option>
                      @foreach ($kategori as $key => $item)
                          <option value="{{ $key }}">{{ $item }}</option>
                      @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
              </div>
              <div class="form-group py-2">
                  <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Nama barang"
                      id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                  @error('nama_barang')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group py-2">
                  <input type="taxt" class="form-control @error('tahun_barang') is-invalid @enderror"
                      placeholder="Tahun barang" id="tahun_barang" name="tahun_barang" value="{{ old('tahun_barang') }}">
                  @error('tahun_barang')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group py-2">
                  <input type="number" class="form-control @error('harga_barang') is-invalid @enderror"
                      placeholder="Harga barang" id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}">
                  @error('harga_barang')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group py-2">
                  <input type="number" class="form-control @error('nilai_residu') is-invalid @enderror"
                      placeholder="Nilai Residu" id="nilai_residu" name="nilai_residu" value="{{ old('nilai_residu') }}" required>
                  @error('nilai_residu')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group py-2">
                  <input type="number" class="form-control @error('umur_barang') is-invalid @enderror"
                      placeholder="Umur Ekonomis" id="umur_barang" name="umur_barang" value="{{ old('umur_barang') }}" required>
                  @error('umur_barang')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group py-2">
                  <input required type="file" class="form-control @error('foto_barang') is-invalid @enderror"
                      placeholder="Foto barang" id="foto_barang" name="foto_barang" value="{{ old('foto_barang') }}">
                  @error('foto_barang')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div id="form">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group py-2">
                      <select name="more[0][id_ukuran]" id="id_ukuran" class="form-control" required>
                        <option value="">Pilih Ukuran Barang</option>
                        @foreach ($ukuran as $key => $value)
                          <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group py-2">
                      <input type="number" class="form-control" placeholder="Stok barang" id="stok_barang" name="more[0][stok_barang]" value="0"required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group py-2">
                      <select name="more[0][id_status]" id="id_status" class="form-control" required>
                        <option value="">Pilih Status Barang</option>
                        @foreach ($status as $key => $value)
                          <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                    <div class="col-md-3">
                      <div class="form-group py-2">
                        <button type="button" class="btn btn-primary btn-block" id="add_size">Tambah Ukuran</button>
                      </div>
                    </div>
                </div>
                <div  id="form-tambah">

                </div>
              </div>
              <div class="form-btn mt-2">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){
  var i = 0;
  $('#add_size').click(function(){
       ++i;
       $('#form-tambah').append('<div id="'+i+'" class="row"> <div class="col-md-3"> <div class="form-group py-2"> <select name="more['+i+'][id_ukuran]" id="id_ukuran" class="form-control" required> <option value="">Pilih Ukuran Barang</option>@foreach ($ukuran as $key => $value) <option value="{{$key}}">{{$value}}</option> @endforeach </select>  </div> </div> <div class="col-md-3"> <div class="form-group py-2">  <input type="number" class="form-control" placeholder="Stok barang" id="stok_barang" name="more['+i+'][stok_barang]" value="0"required> </div> </div> <div class="col-md-3"> <div class="form-group py-2"> <select name="more['+i+'][id_status]" id="id_status" class="form-control" required> <option value="">Pilih Status Barang</option>@foreach ($status as $key => $value) <option value="{{$key}}">{{$value}}</option> @endforeach </select> </div> </div> <div class="col-md-3"> <div class="form-group py-2"> <button type="button" class="btn btn-danger btn-block" data-id="'+i+'" id="remove_size">Hapus Ukuran</button> </div> </div></div>');
  });
  $(document).on('click', '#remove_size', function () {
      var id = $(this).attr('data-id')
       $('#'+id).remove();
  });
});
</script>

@endpush
