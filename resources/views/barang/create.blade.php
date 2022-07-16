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
                  <input type="number" class="form-control @error('stok_barang') is-invalid @enderror" placeholder="Stok barang"
                      id="stok_barang" name="stok_barang" value="{{ old('stok_barang') }}">
                  @error('stok_barang')
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
                  <input type="text" class="form-control @error('harga_barang') is-invalid @enderror"
                      placeholder="Harga barang" id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}">
                  @error('harga_barang')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group py-2">
                  <select name="id_status" id="id_status" class="form-control" required>
                      <option value="">Pilih Status Barang</option>
                      @foreach ($status as $key => $item)
                          <option value="{{ $key }}">{{ $item }}</option>
                      @endforeach
                  </select>
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
              <div class="form-btn mt-2">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
