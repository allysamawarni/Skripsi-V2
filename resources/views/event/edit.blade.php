@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3>Edit Event</h3>
          </div>
          <div class="card-body">
            <form action="{{ route('event.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group py-2">
                    <input type="text" class="form-control @error('nama_event') is-invalid @enderror" placeholder="Nama Event"
                        id="nama_event" name="nama_event" value="{{ $item->nama_event }}">
                    @error('nama_event')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group py-2">
                    <input type="text" class="form-control @error('kebutuhan') is-invalid @enderror" placeholder="Kebutuhan"
                        id="kebutuhan" name="kebutuhan" value="{{ $item->kebutuhan }}" />
                    @error('kebutuhan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group py-2">
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                        placeholder="Jumlah" id="jumlah" name="jumlah" value="{{$item->jumlah}}" />
                    @error('jumlah')
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
@push('script')

@endpush
