@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h3>Update Data Status</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('status.update', $item->id_status) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <input type="text" class="form-control @error('nama_status') is-invalid @enderror" placeholder="nama status"
              id="nama_status" name="nama_status" value="{{ $item->nama_status }}">
          @error('nama_status')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
          <div class="form-btn mt-2">
              <button type="submit" class="btn btn-primary">simpan</button>
          </div>
      </form>
    </div>
  </div>
@endsection
