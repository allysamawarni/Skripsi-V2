@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Tambah Perawatan Baru</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('perawatan.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group py-2">
                  <select name="id_barang" id="id_barang" class="form-control" required>
                      <option value="">Pilih Barang</option>
                      @foreach ($barang as $key => $item)
                        <option value="{{ $item->id_stok }}" data-stok="{{$item->jumlah_stok}}">{{ $item->nama_barang }} ({{$item->nama_ukuran}} - Stok {{$item->stok}})</option>
                      @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
              </div>

              <div class="form-group my-2">
                  <select name="id_status" id="id_status" class="form-control" required>
                    <option value="">Pilih Status</option>
                    @foreach ($status as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group my-2">
                <input type="number" class="form-control @error('jml_item') is-invalid @enderror" placeholder="Jumlah Item" id="jml_item" name="jml_item" value="{{ old('jml_item') }}" min="0">
                @error('jml_item')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
              <div class="form-group my-2 row">
                  <label class="col-md-2" for="">
                    <strong>Tanggal Perawatan</strong>
                  </label>
                  <div class="col-md-12">
                    <input type="date" min="{{date('Y-m-d')}}" class="form-control @error('tgl_perawatan') is-invalid @enderror" placeholder="Tanggal Perawatans" id="tgl_perawatan" name="tgl_perawatan" required value="{{ old('tgl_perawatan') }}">
                    @error('tgl_perawatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
              </div>
              <div class="form-group py-2">
                  <input required type="file" class="form-control @error('foto_perawatan') is-invalid @enderror"
                      placeholder="Foto Perawatan" id="foto_perawatan" name="foto_perawatan" value="{{ old('foto_perawatan') }}">
                  @error('foto_perawatan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-btn mt-2">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
