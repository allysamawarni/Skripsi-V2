@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h3>Update Data Stok</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('stok.update', $item->id_barang) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
              <select name="id_barang" id="id_barang" class="form-control" required readOnly>
                  <option value="">Pilih Barang</option>
                  @foreach ($barang as $key => $kat)
                      <option value="{{ $key }}" {{$item->id_barang === $key ? 'selected' : null}}>{{ $kat }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
          </div>
          <div class="form-group mt-2">
              <input type="text" class="form-control @error('stok_barang') is-invalid @enderror" placeholder="Jumlah stok"
                  id="stok_barang" name="stok_barang" value="{{ $item->stok_barang }}">
              @error('stok_barang')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          <div class="form-btn mt-5">
              <button type="submit" class="btn btn-primary">simpan</button>
          </div>
      </form>
    </div>
  </div>

@endsection
