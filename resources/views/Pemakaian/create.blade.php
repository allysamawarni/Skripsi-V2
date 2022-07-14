@extends('layouts.main')

@section('container')
    <form action="{{ route('pemakaian.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
        <select name="id_user" id="id_user" class="form-control" required>
                <option value="">Pilih User</option>
                @foreach ($user as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
            <span class="help-block with-errors"></span>
        </div>

        <div class="form-group">
            <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" placeholder="nama peminjam"
                id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}">
            @error('nama_peminjam')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="nama kegiatan"
                id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
            @error('nama_kegiatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror"
                placeholder="tgl pinjam" id="tgl_pinjam" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}">
            @error('tgl_pinjam')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="date" class="form-control @error('tgl_pengembalian') is-invalid @enderror"
                placeholder="tgl pengembalian" id="tgl_pengembalian" name="tgl_pengembalian" value="{{ old('tgl_pengembalian') }}">
            @error('tgl_pengembalian')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <input type="number" class="form-control @error('jml_item') is-invalid @enderror"
                placeholder="jml item" id="jml_item" name="jml_item" value="{{ old('jml_item') }}">
            @error('jml_item')
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
