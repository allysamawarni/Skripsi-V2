@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Tambah Pembelian Baru</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group py-2">
                  <select name="id_event" id="id_event" class="form-control" required>
                      <option value="">Pilih Event</option>
                      @foreach ($event as $key => $item)
                          <option value="{{ $key }}">{{ $item }}</option>
                      @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
              </div>

              <div class="form-group py-2">
                  <input type="text" class="form-control @error('nama_pembelian') is-invalid @enderror" placeholder="Nama pembelian"
                      id="nama_pembelian" name="nama_pembelian" value="{{ old('nama_pembelian') }}"required>
                  @error('nama_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group py-2">
                  <input type="number" class="form-control @error('jumlah_pembelian') is-invalid @enderror" placeholder="Jumlah pembelian"
                      id="jumlah_pembelian" name="jumlah_pembelian" value="{{ old('jumlah_pembelian') }}"required>
                  @error('jumlah_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="form-group py-2">
                  <input type="number" class="form-control @error('harga_pembelian') is-invalid @enderror"
                      placeholder="Harga barang" id="harga_pembelian" name="harga_pembelian" value="{{ old('harga_pembelian') }}" required>
                  @error('harga_pembelian')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              <div class="form-group my-2 row">
                  <label class="col-md-2" for="">
                    <strong>Tanggal Pembelian</strong>
                  </label>
                  <div class="col-md-12">
                    <input type="date" class="form-control @error('tgl_pembelian') is-invalid @enderror" placeholder="Tanggal Pembelian" id="tgl_pembelian" name="tgl_pembelian" required value="{{ old('tgl_pembelian') }}">
                    @error('tgl_pembelian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
              </div>
              <div class="form-group input-group py-2">
                <input type="file" class="form-control @error('image_pembelian') is-invalid @enderror" name="image_pembelian" id="image_pembelian" accept="image/png, image/gif, image/jpeg">
                <label class="input-group-text" for="image_pembelian">Upload Foto Barang</label>
                @error('image_pembelian')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-group input-group py-2">
                <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" name="pdf_file" id="pdf_file" accept="application/pdf">
                <label class="input-group-text" for="pdf_file">Upload PDF Pembelian</label>
                @error('pdf_file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              {{-- <div class="form-group py-2">
=======

              <div class="form-group py-2">
>>>>>>> 85a0c3e14469d88a71d16b2b49bc181243d97bc4
                  <input required type="file" class="form-control @error('image_pembelian') is-invalid @enderror"
                      placeholder="Foto pembelian" id="image_pembelian" name="image_pembelian" value="{{ old('image_pembelian') }}" accept="image/png, image/gif, image/jpeg">
              </div> --}}
              {{-- <div class="form-group py-2">
                  <input required type="file" class="form-control @error('file_pdf') is-invalid @enderror"
                      placeholder="Foto pembelian" id="file_pdf" name="file_pdf" value="{{ old('file_pdf') }}" accept="application/pdf">
                  @error('file_pdf')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
              </div> --}}
              <div class="form-btn mt-2">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
