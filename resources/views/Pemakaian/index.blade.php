@extends('layouts.main')

@section('container')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Daftar Pemakaian Barang</h3>

        @if(Auth::user()->getRoleNames()[0] == 'Admin')
        <a href="{{ route('pemakaian.create') }}" type="button" class="btn btn-primary">Tambah</a>
        @endif
    </div>
    <div class="card-body table-responsive">
        <table class="table" id="crudTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Kegiatan</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Surat Peminjaman</th>
                    <th>Jumlah Item</th>
                    <th>Jumlah Dikembalikan</th>
                    <th>Jumlah Diterima</th>
                    <th>Keterangan</th>
                    <th>Aksi Persetujuan</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
<script>
    let datatable = $('#crudTable').DataTable({
        ordering: true,
        searchable: true,

        ajax: {
            url: '{!! url()->current() !!}',
        },

        columns: [{
                data: 'DT_RowIndex',
                width: '5%',
                className: 'dt-body-center',
                searchable: false,
                sortable: false,

            },
            {
                data: 'id_user',
                name: 'id_user',
            },
            {
                data: 'nama_peminjam',
                name: 'nama_peminjam',
            },
            {
                data: 'nama_kegiatan',
                name: 'nama_kegiatan',
            },
            {
                data: 'nama_barang',
                name: 'nama_barang',
            },
            {
                data: 'id_ukuran',
                name: 'id_ukuran',
            },
            {
                data: 'tgl_pinjam',
                name: 'tgl_pinjam',
            },
            {
                data: 'tgl_pengembalian',
                name: 'tgl_pengembalian',
            },
            {
                data: 'pdf_pemakaian',
                name: 'pdf_pemakaian',
            },
            {
                data: 'jml_item',
                name: 'jml_item',
            },
            {
                data: 'jumlah_dikembalikan',
                name: 'jumlah_dikembalikan',
            },
            {
                data: 'jumlah_diterima',
                name: 'jumlah_diterima',
            },
            {
                data: 'keterangan',
                name: 'keterangan',
            },
            {
                data: 'aksi',
                name: 'aksi',
                width: '5%',

                orderable: false,
                searchable: false,
                sortable: false
            }
        ]
    });
</script>
@endpush
