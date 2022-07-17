<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Komplain;
use App\Models\Pemakaian;
use Auth;
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
                        ->orderBy('id_pemakaian', 'desc')->get();
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
                  ->editColumn('aksi', function ($item) {
                      return '
                          <div class="aksi d-flex align-items-center">
                              <div class="aksi-edit px-1">
                                  <a class="btn btn-success edit" href="'. route('pemakaian.edit', $item->id_pemakaian) .'">
                                      edit
                                  </a>
                              </div>
                              <div class="aksi-hapus">
                                  <form class="inline-block" action="'. route('pemakaian.destroy', $item->id_pemakaian) .'" method="POST">
                                      <button class="btn btn-danger">
                                          hapus
                                      </button>
                                          '. method_field('delete') . csrf_field() .'
                                  </form>
                              </div>
                          </div>
                      ';

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
