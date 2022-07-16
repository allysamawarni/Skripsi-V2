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
              <select name="id_barang" id="id_barang" class="form-control" required>
                  <option value="">Pilih Barang</option>
                  @foreach ($barang as $key => $kat)
                      <option value="{{ $key }}">{{ $kat }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
          </div>
          <div class="form-group mt-2">
              <input type="text" class="form-control @error('jumlah_stok') is-invalid @enderror" placeholder="Jumlah stok"
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
    </div>
  </div>

@endsection
