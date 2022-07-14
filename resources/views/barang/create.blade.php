@extends('layouts.main')

@section('container')
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">

            <select name="id_kategori" id="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
            <span class="help-block with-errors"></span>
        </div>

        <div class="form-group">
            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="nama barang"
                id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
            @error('nama_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="number" class="form-control @error('stok_barang') is-invalid @enderror" placeholder="stok barang"
                id="stok_barang" name="stok_barang" value="{{ old('stok_barang') }}">
            @error('stok_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="taxt" class="form-control @error('tahun_barang') is-invalid @enderror"
                placeholder="tahun barang" id="tahun_barang" name="tahun_barang" value="{{ old('tahun_barang') }}">
            @error('tahun_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="text" class="form-control @error('harga_barang') is-invalid @enderror"
                placeholder="harga barang" id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}">
            @error('harga_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="text" class="form-control @error('status_barang') is-invalid @enderror"
                placeholder="status barang" id="status_barang" name="status_barang" value="{{ old('status_barang') }}">
            @error('status_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input required type="file" class="form-control @error('foto_barang') is-invalid @enderror"
                placeholder="foto barang" id="foto_barang" name="foto_barang" value="{{ old('foto_barang') }}">
            @error('foto_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>



        <div class="form-btn mt-5">
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
    </form>
@endsection
