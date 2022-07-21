<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;
use App\Models\User;
use App\Models\Barang;
use App\Models\Stok;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Pemakaian::join('users', 'users.id', 'pemakaian.id_user')
                      ->join('barang', 'barang.id_barang', 'pemakaian.id_barang')
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
                ->addColumn('acc_ketua', function($item){
                  $ket = User::find($item->acc_ketua);
                  return $ket ? $ket->name : null;
                })
                ->editColumn('aksi', function ($item) {

                    if(Auth::user()->getRoleNames()[0] == 'Admin' && $item->jumlah_dikembalikan != null){
                      return '
                      <div class="aksi d-flex align-items-center">
                            <div class="aksi-edit px-1">
                              <form class="inline-block" action="'. route('pemakaian.terima', $item->id_pemakaian) .'" method="POST">
                                  <button class="btn btn-success">
                                      Terima
                                  </button>
                                      '. method_field('post') . csrf_field() .'
                              </form>
                            </div>
                      </div>
                      ';
                    } else if (Auth::user()->getRoleNames()[0] == 'Ketua' && $item->acc_ketua == null) {
                      return '
                        <div class="aksi d-flex align-items-center">
                            <div class="aksi-edit px-1">
                              <form class="inline-block" action="'. route('pemakaian.terima', $item->id_pemakaian) .'" method="POST">
                                  <button class="btn btn-success">
                                      Terima
                                  </button>
                                      '. method_field('post') . csrf_field() .'
                              </form>
                            </div>
                            <div class="aksi-hapus">
                                <form class="inline-block" action="'. route('pemakaian.destroy', $item->id_pemakaian) .'" method="POST">
                                    <button class="btn btn-danger">
                                        Tolak
                                    </button>
                                        '. method_field('delete') . csrf_field() .'
                                </form>
                            </div>
                        </div>
                        ';
                    } else {
                      return null;
                    }
                })
            ->rawColumns(['id_user', 'name', 'nama_peminjam', 'aksi'])
            ->make();
        }

        return view('pemakaian.index');
    }
    public function terima(Request $request, $id){
         $item = Pemakaian::findOrFail($id);
         $item->update([
          'acc_ketua' => Auth::user()->id,
          'status' => $item->status = 'Disetujui',
        ]);
         // dd($item);
         return redirect()->route('pemakaian.index');
    }
    public function terimaBarang(Request $request) {
      $pemakaian  = Pemakaian::find($request->id_pemakaian);
      $pemakaian->jumlah_diterima= $request->jumlah_diterima > $pemakaian->jml_item ? $pemakaian->jml_item : $request->jumlah_diterima;
      $pemakaian->diterima_pada = now();
      $pemakaian->save();
      return response()->json($pemakaian);
    }

    public function kembaliBarang(Request $request) {
        $pemakaian  = Pemakaian::find($request->id_pemakaian);
        $pemakaian->jumlah_dikembalikan= $request->jumlah_dikembalikan > $pemakaian->jumlah_diterima ? $pemakaian->jumlah_diterima : $request->jumlah_dikembalikan;
        $pemakaian->status = 'Selesai';
        $pemakaian->pengembalian_pada = now();
        $pemakaian->save();

        $stok = Stok::find($pemakaian->id_stok);
        if($stok){
          $stok->increment('jumlah_stok', $pemakaian->jumlah_dikembalikan);
        }
        return response()->json($pemakaian);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all()->pluck('name', 'id');
        $barang = Barang::join('stok', 'stok.id_barang', 'barang.id_barang')
                    ->join('ukurans', 'ukurans.id_ukuran', 'stok.id_ukuran')
                    ->where('stok.jumlah_stok', '>', 0)
                    ->select('nama_barang', 'barang.id_barang', 'ukurans.nama_ukuran', 'stok.id_stok', 'stok.jumlah_stok')
                    ->get();

        return view('pemakaian.create', [
            'user'=>$user,
            'barang' => $barang
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
      $user = Auth::user()->getRoleNames()[0];
      $data = $request->all();
      $stok = Stok::find($request->id_barang);
      $user = Auth::user()->getRoleNames()[0];
      if($user != 'Admin'){
        $data['id_user'] = Auth::user()->id;
      }
      $data['id_barang'] = $stok->id_barang;
      $barang = Pemakaian::create($data);
      $data['pdf_pemakaian'] = $request->file('pdf_pemakaian')->store('assets/pdf_pemakaian','public');
      if($request->jml_item <= $stok->jumlah_stok){
        $stok->decrement('jumlah_stok', $request->jml_item);
      }else{
        $stok->decrement('jumlah_stok', $stok->jumlah_stok);
      }
      if($user == 'Ukm'){
        return redirect()->back()->with('message', 'Peminjamanmu berhasil, mohon tunggu disetujui.');
      }else{
        return redirect()->route('pemakaian.index');
      }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemakaian $pemakaian)
    {
        $item = Pemakaian::findOrFail($pemakaian->id_pemakaian);
        $user = User::all()->pluck('name', 'id');
        $barang = Barang::all()->pluck('nama_barang', 'id_barang');
        return view('pemakaian.edit', [
            'item' => $item,
            'user' => $user,
            'barang' => $barang
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
       $item = Pemakaian::findOrFail($id);
       // dd($item);
       $item->update($data);

      return redirect()->route('pemakaian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $item = Pemakaian::findOrFail($id);
       $stok = Stok::find($item->id_stok);
       if($stok){
         $stok->increment('jumlah_stok', $item->jml_item);
       }
       $item->delete();
      return redirect()->route('pemakaian.index');
    }
}
