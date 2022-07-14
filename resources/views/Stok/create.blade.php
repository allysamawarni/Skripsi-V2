@extends('layouts.main')

@section('container')
    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
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

        <div class="form-group">
            <input type="text" class="form-control @error('jumlah_stok') is-invalid @enderror" placeholder="jumlah stok"
                id="jumlah_stok" name="jumlah_stok" value="{{ $item->jumlah_stok }}">
            @error('jumlah_stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror
        <div class="form-btn mt-5">
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
    </form>
@endsection
