@extends('layouts.main')

@section('container')
  
  <div class="row mt-5">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3>Detail Data Ukuran Barang</h3>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Nama Kategori</th>
                    <th>Ukuran</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; $total = 0;?>
                @foreach ($stok as $item)
                    <?php $total+=$item->stok ?>
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->nama_kategori}}</td>
                        <td>{{$item->nama_ukuran}}</td>
                        <td>{{$item->stok}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center">Total Stok</td>
                    <td>{{$total}}</td>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
