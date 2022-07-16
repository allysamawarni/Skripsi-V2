@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h3>Buat Statu Baru</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('status.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control @error('nama_status') is-invalid @enderror" placeholder="nama status"
                id="nama_status" name="nama_status" value="{{ old('nama_status') }}">
            @error('nama_status')
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
