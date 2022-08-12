<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use App\Models\Penanggungjawab;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Status;
use App\Models\Ukuran;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use App\Models\Stok;
use Auth;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // return base64_encode(asset('storage/assets/pancasila.png'));
         if(request()->ajax()) {
            $query = Barang::orderBy('id_barang', 'desc')->get();
            foreach ($query as $value) {
              $value->harga_beli = $value->harga_barang;
              $value->harga_barang = number_format($value->harga_barang);
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('id_kategori', function ($item) {
                return $item->kategori->nama_kategori ?? ' ';
                })
                ->editColumn('foto_barang', function($item){
                    return $item->foto_barang ? '<img src="'. Storage::url($item->foto_barang).'" style="max-height: 50px;" />' : '';
                })
                ->editColumn('stok_barang', function($item){
                  return Stok::where('id_barang', $item->id_barang)->sum('jumlah_stok');
                })
                ->editColumn('penyusutan', function($item){
                  if($item->nilai_residu != null || $item->umur_barang != null){
                    $penyusutan = ((Int) $item->harga_beli - (Int) $item->nilai_residu) / (Int)$item->umur_barang;
                  }
                  return $item->nilai_residu || $item->umur_barang ? number_format($penyusutan) : 0;
                })
                ->editColumn('per_tahun', function($item){
                  $tahun = intval($item->tahun_barang);
                  $umur_tahun = intval($item->umur_barang);

                  $jml_tahun = $tahun + $umur_tahun;
                  if( date('Y') > $jml_tahun ){
                    $per_tahun = 0;
                  }else{
                    $penyusutan = ((Int) $item->harga_beli - (Int) $item->nilai_residu) / (Int)$item->umur_barang;
                    $p_pertahun = $penyusutan / $umur_tahun;

                    $tahun_ini = date('Y');
                    $ht_tahun = intval($tahun_ini) - $tahun;

                    $per_tahun = number_format(intval($ht_tahun * $p_pertahun));

                  }
                  return $per_tahun;
                })
                ->addColumn('aksi', function($item) {
                  if(Auth::user()->getRoleNames()[0] == 'Admin'){
                      return '
                          <div class="aksi d-inline-flex align-items-center">
                                  <a class="btn btn-warning detail" href="'. route('barang.show', $item->id_barang) .'">
                                      detail
                                  </a>
                                  <a class="btn btn-success edit" style = "margin-left: 5px;" href="'. route('barang.edit', $item->id_barang) .'">
                                      edit
                                  </a>
                                  <form class="inline-block p-2" action="'. route('barang.destroy', $item->id_barang) .'" method="POST">
                                      <button class="btn btn-danger">
                                          hapus
                                      </button>
                                          '. method_field('delete') . csrf_field() .'
                                  </form>
                              </div>
                          </div>
                      ';
                  }else {
                    return null;
                  }

                })
                ->rawColumns(['id_kategori','foto_barang','aksi'])
                ->make();
        }

        $data['penanggungjawab'] = Penanggungjawab::join('users', 'users.id', 'penanggungjawab.id_users')
        ->select('penanggungjawab.*', 'users.name')
        ->where('status', 'aktiv')
        ->orderBy('penanggungjawab.id_pj', 'desc')->first();
        return view('barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
         $status = Status::all()->pluck('nama_status', 'id_status');
         $ukuran = Ukuran::all()->pluck('nama_ukuran', 'id_ukuran');
        return view('barang.create', [
            'kategori' => $kategori,
            'status' => $status,
            'ukuran' => $ukuran,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $data = $request->all();
          $foto_barang = $request->file('foto_barang')->store('assets/barang','public');
          $barang = new Barang;
          $barang->id_kategori = $request->id_kategori;
          $barang->nama_barang = $request->nama_barang;
          $barang->tahun_barang = $request->tahun_barang;
          $barang->harga_barang = $request->harga_barang;
          $barang->foto_barang = $foto_barang;
          $barang->nilai_residu = $request->nilai_residu;
          $barang->umur_barang = $request->umur_barang;
          $barang->save();
          if($barang) {
            foreach ($request->more as $key => $mor) {
              $stok = new Stok;
              $stok->id_barang = $barang->id_barang;
              $stok->jumlah_stok = $mor['stok_barang'];
              $stok->id_status = $mor['id_status'];
              $stok->id_ukuran = $mor['id_ukuran'];
              $stok->save();
            }
          }
          return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
      $barang = Barang::join('kategori', 'kategori.id_kategori', 'barang.id_kategori')->where('id_barang', $id)->first();
      $stok = Stok::join('barang', 'barang.id_barang', 'stok.id_barang')
                  ->join('ukurans', 'ukurans.id_ukuran', 'stok.id_ukuran')
                  ->join('kategori', 'kategori.id_kategori', 'barang.id_kategori')
                  ->selectRaw('barang.nama_barang, kategori.nama_kategori, ukurans.nama_ukuran, SUM(jumlah_stok) as stok')
                  ->where('barang.id_barang', $id)
                  ->groupBy('barang.id_barang', 'ukurans.id_ukuran')->get();
      $data = [
        'barang' => $barang,
        'stok' => $stok,
      ];

      return view('barang.detail', $data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $item = Barang::findOrFail($barang->id_barang);
         $kategori = Kategori::all()->pluck('nama_kategori', 'id_kategori');
         $status = Status::all()->pluck('nama_status', 'id_status');
        return view('barang.edit', [
            'item' => $item,
            'kategori' =>$kategori,
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = $request->all();
         if($request->foto_barang) {
            $data['foto_barang'] = $request->file('foto_barang')->store('assets/barang','public');
         } else {
            unset($data['foto_barang']);
         }
         $item = Barang::findOrFail($id);
         $item->update($data);

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
         $item = Barang::findOrFail($barang->id_barang);
         $item->delete();
         if($item){
           Stok::where('id_barang', $barang->id_barang)->delete();
         }
         return redirect()->route('barang.index');

    }
}
