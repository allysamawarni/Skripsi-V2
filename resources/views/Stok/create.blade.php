@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h3>Tambah Stok</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('stok.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
          <select name="id_barang" id="id_barang" class="form-control" required>
                  <option value="">Pilih Barang</option>
                  @foreach ($barang as $key => $item)
                      <option value="{{ $key }}">{{ $item }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
          </div>
          <div class="form-group mt-2">
              <input type="text" class="form-control @error('jumlah_stok') is-invalid @enderror" placeholder="Jumlah Stok"
                  id="jumlah_stok" name="jumlah_stok" value="{{ old('jumlah_stok') }}" required>
              @error('jumlah_stok')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="form-group mt-2">
              <input type="text" class="form-control @error('keterangan') is-invalid @enderror" placeholder="Keterangan"
                  id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
              @error('keterangan')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div id="form">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group py-2">
                  <select name="id_ukuran" id="id_ukuran" class="form-control" required>
                    <option value="">Pilih Ukuran Barang</option>
                    @foreach ($ukuran as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group py-2">
                  <input type="number" class="form-control" placeholder="Stok barang" id="jumlah_stok" name="jumlah_stok" value="0"required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group py-2">
                  <select name="id_status" id="id_status" class="form-control" required>
                    <option value="">Pilih Status Barang</option>
                    @foreach ($status as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-btn mt-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </form>
    </div>
  </div>

@endsection
