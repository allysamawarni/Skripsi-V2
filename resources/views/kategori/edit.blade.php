@extends('layouts.main')

@section('container')
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
        <div class="form-btn">
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
    </form>
@endsection
