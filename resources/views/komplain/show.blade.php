@extends('layouts.main')

@section('container')
  <div class="card">
      <div class="card-header">
        <h3>Komplain Barang</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            Dari
          </div>
          <div class="col-md-10">
            <strong>
              {{$komplain->name}}
            </strong>
          </div>
          <div class="col-md-2">
            Nama Barang
          </div>
          <div class="col-md-10">
            <strong>
              {{$komplain->barang->nama_barang}}
            </strong>
          </div>
          <div class="col-md-2">
            Pesan
          </div>
          <div class="col-md-10">
            <strong>
              {{$komplain->pesan}}
            </strong>
          </div>
          <div class="col-md-12 mt-5">

          </div>
          <form method="post" action="{{route('komplain.reply', $komplain->id)}}">
            @csrf
            <div class="col-md-12">
              <textarea class="form-control @error('pesan') is-invalid @enderror" placeholder="Balas Pesan Komplain" id="pesan" name="pesan" value="{{ old('pesan') ? old('pesan') : '' }}" required></textarea>
              @error('pesan')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
              <div class="form-btn mt-2">
                  <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </div>
          </form>
        </div>
      </div>
  </div>
@endsection
@push('script')
@endpush
