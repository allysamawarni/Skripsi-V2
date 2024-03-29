@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Buat Data Peminjaman</h3>
            </div>
            <div class="card-body">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="{{ route('pemakaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @php($users = Auth::user()->getRoleNames()[0])
                    @if($users == 'Ukm')
                    <div class="form-group my-2">
                        <select name="id_user" id="id_user" class="form-control" required disabled>
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
                                <option value="{{ $item->id_stok }}" data-stok="{{$item->jumlah_stok}}">{{ $item->nama_barang }} ({{$item->nama_ukuran}} - Stok {{$item->stok}})</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group my-2">
                        <input type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" placeholder="Nama Peminjam" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}">
                        @error('nama_peminjam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group my-2">
                        <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="Nama Kegiatan" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}">
                        @error('nama_kegiatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group my-2 row">
                        <label class="col-md-2" for="">
                            <strong>Tanggal Peminjaman</strong>
                        </label>
                        <div class="col-md-12 mt-1">
                            <input type="date" min="{{date('Y-m-d')}}" class="form-control @error('tgl_pinjam') is-invalid @enderror" placeholder="tgl pinjam" id="tgl_pinjam" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}">
                            @error('tgl_pinjam')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group my-2 row">
                        <label class="col-md-2" for="">
                            <strong>Tanggal Pengembalian</strong>
                        </label>
                        <div class="col-md-12 mt-1">
                            <input type="date" min="{{date('Y-m-d')}}" class="form-control @error('tgl_pengembalian') is-invalid @enderror" placeholder="tgl pengembalian" id="tgl_pengembalian" name="tgl_pengembalian" value="{{ old('tgl_pengembalian') }}">
                            @error('tgl_pengembalian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group my-2">
                        <input type="number" class="form-control @error('jml_item') is-invalid @enderror" placeholder="Jumlah Item" id="jml" name="jml_item" min="0">
                        @error('jml_item')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group input-group py-2">
                        <input type="file" class="form-control @error('pdf_pemakaian') is-invalid @enderror" name="pdf_pemakaian" id="pdf_pemakaian" accept="application/pdf">
                        <label class="input-group-text" for="pdf_pemakaian">Upload PDF Peminjaman</label>
                        @error('pdf_pemakaian')
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
@push('script')
<script type="text/javascript">
    $('select#id_barang').on('change', function() {
        jQuery('#jml_item').attr('max', this.options[this.selectedIndex].getAttribute('data-stok'));
        $('#jml_item').val(0);
    });
    $(':input#jml_item').on('change', function() {
        var max = $("#jml_item").attr("max");
        var value = $(this).val()
        if (value > max) {
            $(this).val(max);
        }
    });
</script>
@endpush
