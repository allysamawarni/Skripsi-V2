@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      Update data pemakaian
    </div>
    <div class="card-body">
      <form action="{{ route('pemakaian.update', $item->id_pemakaian) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf

          <div class="form-group mt-2">

          <select name="id_user" id="id_user" class="form-control" required>
                  <option value="">Pilih User</option>
                  @foreach ($user as $key => $itemss)
                      <option value="{{ $key }}" {{$item->id_user === $key ? 'selected' : null}}>{{ $itemss }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
          </div>

          <div class="form-group my-2">
            <select name="id_barang" id="id_barang" class="form-control" required>
                  <option value="">Pilih Barang</option>
                  @foreach ($barang as $key => $items)
                      <option value="{{ $key }}" {{$item->id_barang === $key ? 'selected' : null}}>{{ $items }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
          </div>
          <div class="form-group mt-2">
              <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" placeholder="Nama peminjam"
                  id="nama_peminjam" name="nama_peminjam" value="{{ $item->nama_peminjam }}">
              @error('nama_peminjam')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="form-group mt-2">
              <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="Nama kegiatan"
                  id="nama_kegiatan" name="nama_kegiatan" value="{{ $item->nama_kegiatan }}">
              @error('nama_kegiatan')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="form-group mt-2">
              <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror"
                  placeholder="tgl pinjam" id="tgl_pinjam" name="tgl_pinjam" value="{{ $item->tgl_pinjam }}">
              @error('tgl_pinjam')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="form-group mt-2">
              <input type="date" class="form-control @error('tgl_pengembalian') is-invalid @enderror"
                  placeholder="tgl pengembalian" id="tgl_pengembalian" name="tgl_pengembalian" value="{{ $item->tgl_pengembalian }}">
              @error('tgl_pengembalian')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="form-group mt-2">
              <input type="number" class="form-control @error('jml_item') is-invalid @enderror"
                  placeholder="jml item" id="jml_item" name="jml_item" value="{{ $item->jml_item }}">
              @error('jml_item')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>



          <div class="form-btn mt-2">
              <button type="submit" class="btn btn-primary">simpan</button>
          </div>
      </form>
    </div>
  </div>

@endsection
