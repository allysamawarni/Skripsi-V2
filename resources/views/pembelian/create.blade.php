@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Tambah Pembelian Baru</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group py-2">
                  <select name="id_event" id="id_event" class="form-control" required>
                      <option value="">Pilih Event</option>
                      @foreach ($event as $key => $item)
                          <option value="{{ $key }}">{{ $item }}</option>
                      @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
              </div>

              <div class="form-group py-2">
                  <input type="text" class="form-control @error('nama_pembelian') is-invalid @enderror" placeholder="Nama pembelian"
                      id="nama_pembelian" name="nama_pembelian" value="{{ old('nama_pembelian') }}"required>
                  @error('nama_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group py-2">
                  <input type="number" class="form-control @error('jumlah_pembelian') is-invalid @enderror" placeholder="Jumlah pembelian"
                      id="jumlah_pembelian" name="jumlah_pembelian" value="{{ old('jumlah_pembelian') }}"required>
                  @error('jumlah_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group py-2">
                  <input type="number" class="form-control @error('harga_pembelian') is-invalid @enderror"
                      placeholder="Harga barang" id="harga_pembelian" name="harga_pembelian" value="{{ old('harga_pembelian') }}" required>
                  @error('harga_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group my-2">
                  <input type="date" class="form-control @error('tgl_pembelian') is-invalid @enderror" placeholder="Tanggal Pembelian" id="tgl_pembelian" name="tgl_pembelian" required value="{{ old('tgl_pembelian') }}">
                  @error('tgl_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group py-2">
                  <input required type="file" class="form-control @error('image_pembelian') is-invalid @enderror"
                      placeholder="Foto pembelian" id="image_pembelian" name="image_pembelian" value="{{ old('image_pembelian') }}">
                  @error('image_pembelian')
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
