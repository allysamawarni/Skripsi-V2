@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h3>Buat Penanggungjawab</h3>
    </div>
    <div class="card-body">
      <form action="{{ url('insert_pj') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group py-2">
            <select name="id_users" id="id_users" class="form-control" required>
                <option value="">Pilih Users</option>
                @foreach ($user as $key => $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="help-block with-errors"></span>
        </div>
          <input type="text" class="form-control @error('tahun') is-invalid @enderror" placeholder="Tahun" id="tahun" name="tahun" value="{{ old('tahun') }}">
              @error('tahun')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          <div class="form-btn mt-2">
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </form>
    </div>
  </div>
@endsection
