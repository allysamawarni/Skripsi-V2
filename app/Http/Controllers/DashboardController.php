<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Komplain;
use App\Models\Pemakaian;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
class DashboardController extends Controller
{
    public function index() {

          if(request()->ajax()) {
              $query = Pemakaian::join('users', 'users.id', 'pemakaian.id_user')
                        ->join('barang', 'barang.id_barang', 'pemakaian.id_barang')
                        ->where('pemakaian.id_user', Auth::user()->id)
                        ->select('pemakaian.*', 'barang.nama_barang', 'users.name')
                        ->orderBy('pemakaian.id_pemakaian', 'desc')->get();
              return DataTables::of($query)
                  ->addIndexColumn()
                  ->addColumn('id_user', function($item){
                    return $item->name;
                  })
                  ->addColumn('nama_barang', function($item){
                    return $item->nama_barang;
                  })
                  ->addColumn('nama_peminjam', function($item){
                    return $item->nama_peminjam;
                  })
                  ->editColumn('acc_ketua', function($item){
                    $user = User::find($item->acc_ketua);
                    return $user ? $user->name : null;
                  })
                  ->editColumn('aksi', function ($item) {
                    if($item->jumlah_diterima == null && $item->status == 'Disetujui'){
                        return '
                            <div class="aksi d-flex align-items-center">
                                <div class="aksi-edit px-1">
                                    <button onclick="insertJumlah('.$item->id_pemakaian.')" class="btn-sm btn btn-primary edit" >
                                        BARANG DITERIMA
                                    </button>
                                </div>
                            </div>
                        ';
                    }elseif (($item->jumlah_diterima != null
                          && $item->jumlah_dikembalikan == null)
                        || $item->jumlah_diterima != $item->jumlah_dikembalikan) {
                        return '
                            <div class="aksi d-flex align-items-center">
                                <div class="aksi-edit px-1">
                                    <button onclick="kembalikanJumlah('.$item->id_pemakaian.')" class=" btn-sm btn btn-warning edit" >
                                        KEMBALIKAN
                                    </button>
                                </div>
                            </div>
                        ';
                    }else{
                      return null;
                    }
                  })
              ->rawColumns(['id_user', 'name', 'nama_peminjam', 'aksi'])
              ->make();
          }
        $barang = Barang::count();
        $kategori = Kategori::count();
        $komplain = Komplain::where('parent_id', NULL)->count();

        return view('dashboard.index', compact('barang', 'kategori', 'komplain'));
    }
}
