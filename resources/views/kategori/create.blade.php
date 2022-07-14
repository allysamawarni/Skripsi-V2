@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h3>Buat Kategori Baru</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="Nama Kategori" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}">
              @error('nama_kategori')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          <div class="form-btn mt-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </form>
    </div>
  </div>
@endsection
