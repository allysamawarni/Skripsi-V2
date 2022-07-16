@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Buat Data Komplain</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('komplain.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group my-2">
                <input type="text" class="form-control @error('id_user') is-invalid @enderror" placeholder="nama peminjam"
                    id="id_user" name="id_user" value="{{Auth::user()->name}}" required readOnly>
                    @error('id_user')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
              </div>
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
                  <textarea class="form-control @error('pesan') is-invalid @enderror" placeholder="Pesan Komplain" id="pesan" name="pesan" value="{{ old('pesan') ? old('pesan') : '' }}" required></textarea>
                  @error('pesan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-btn mt-2">
                  <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
