@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Update Kategori</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('kategori.update', $item->id_kategori) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" placeholder="nama kategori"
                id="nama_kategori" name="nama_kategori" value="{{ $item->nama_kategori }}">
            @error('nama_kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-btn pt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
