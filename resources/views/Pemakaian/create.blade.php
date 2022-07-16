@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Buat Data Peminjaman</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('pemakaian.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @php($users = Auth::user()->getRoleNames()[0])
              @if($users == 'Ukm')
              <div class="form-group my-2">
                <select name="id_user" id="id_user" class="form-control" required readOnly>
                      <option value="">Pilih User</option>
                      @foreach ($user as $key => $item)
                          <option value="{{ $key }}" {{Auth::user()->id === $key ? 'selected' : null}}>{{ $item }}</option>
                      @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
              </div>
              @else
                <div class="form-group my-2">
                  <select name="id_user" id="id_user" class="form-control" required>
                        <option value="">Pilih User</option>
                        @foreach ($user as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
              @endif
              <div class="form-group my-2">
                <select name="id_barang" id="id_barang" class="form-control" required>
                      <option value="">Pilih Barang</option>
                      @foreach ($barang as $key => $item)
                          <option value="{{ $key }}">{{ $item }}</option>
                      @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
              </div>
              <div class="form-group my-2">
                  <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" placeholder="Nama Peminjam"
                      id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}">
                  @error('nama_peminjam')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group my-2">
                  <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="Nama Kegiatan"
                      id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                  @error('nama_kegiatan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group my-2">
                  <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror"
                      placeholder="tgl pinjam" id="tgl_pinjam" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}">
                  @error('tgl_pinjam')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group my-2">
                  <input type="date" class="form-control @error('tgl_pengembalian') is-invalid @enderror"
                      placeholder="tgl pengembalian" id="tgl_pengembalian" name="tgl_pengembalian" value="{{ old('tgl_pengembalian') }}">
                  @error('tgl_pengembalian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group my-2">
                  <input type="number" class="form-control @error('jml_item') is-invalid @enderror"
                      placeholder="Jumlah Item" id="jml_item" name="jml_item" value="{{ old('jml_item') }}">
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
        </div>
      </div>
    </div>
  </div>

@endsection
