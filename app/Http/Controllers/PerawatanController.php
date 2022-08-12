<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perawatan;
use App\Models\Stok;
use App\Models\Barang;
use App\Models\Status;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
           $query = Perawatan::join('barang', 'perawatans.id_barang', 'barang.id_barang')
                            ->join('stok', 'perawatans.id_stok', 'stok.id_stok')
                            ->join('ukurans', 'ukurans.id_ukuran', 'stok.id_ukuran')
                  ->orderBy('id_perawatan', 'desc')->select('perawatans.*', 'barang.nama_barang', 'ukurans.nama_ukuran')->get();
           return DataTables::of($query)
               ->addIndexColumn()
               ->editColumn('foto_perawatan', function($item){
                   return $item->foto_perawatan ? '<img src="'. Storage::url($item->foto_perawatan).'" style="max-height: 50px;" />' : '';
               })
               ->editColumn('nama_status', function ($item){
                 $status = Status::find($item->id_status);
                 return $status ? $status->nama_status : null;
               })
               ->addColumn('aksi', function($item) {
                 if(Auth::user()->getRoleNames()[0] == 'Admin'){
                    if($item->status_perawatan == 'selesai'){
                        return '';
                    }else{
                        return '
                            <div class="aksi d-flex align-items-center">
                                <div class="aksi-edit px-1">
                                    <a class="btn btn-success edit" href="'. route('perawatan.edit', $item->id_perawatan) .'">
                                        selesai
                                    </a>
                                </div>
                            </div>
                        ';
                    }
                 }else {
                   return null;
                 }
               })
               ->rawColumns(['id_perawatan','foto_perawatan','aksi'])
               ->make();
       }
        return view('perawatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Stok::join('barang', 'barang.id_barang', 'stok.id_barang')
        ->join('ukurans', 'ukurans.id_ukuran', 'stok.id_ukuran')
        ->join('kategori', 'kategori.id_kategori', 'barang.id_kategori')
        ->selectRaw('barang.nama_barang, barang.id_barang, stok.id_stok, kategori.nama_kategori, ukurans.nama_ukuran, SUM(jumlah_stok) as stok')
        ->groupBy('barang.id_barang', 'ukurans.id_ukuran')->get();
        $status = Status::all()->pluck('nama_status', 'id_status');
        return view('perawatan.create', compact('barang', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $stok = Stok::find($request->id_barang);
        $id_barang = $stok->id_barang;
        $id_stok = $stok->id_stok;
      
    //   $request->merge(["id_barang" => $stok->id_barang, "id_stok" => $stok->id_stok]);

        if($request->foto_perawatan) {
            $foto = $request->file('foto_perawatan')->store('assets/perawatan','public');
        } else {
            unset($foto);
        }
        $perawatan = new Perawatan;
        $perawatan->id_barang = $id_barang;
        $perawatan->id_status = $request->id_status;
        $perawatan->id_stok = $id_stok;
        $perawatan->jml_item = $request->jml_item;
        $perawatan->tgl_perawatan = $request->tgl_perawatan;
        $perawatan->foto_perawatan = $foto;
      
        $perawatan->save();

        if ($request->jml_item <= $stok->jumlah_stok) {
        $stok->decrement('jumlah_stok', $request->jml_item);
        } else {
        $stok->decrement('jumlah_stok', $stok->jumlah_stok);
        }
    // Perawatan::create($data);
        //   $perawatan = new Perawatan($request->all());
        //   $perawatan->save();

        // $data = $request->all();
        // if($request->foto_perawatan) {
        //     $data['foto_perawatan'] = $request->file('foto_perawatan')->store('assets/perawatan','public');
        // } else {
        //     unset($data['foto_perawatan']);
        // }
        // Perawatan::create($data);

      return redirect()->route('perawatan.index');
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
    public function edit($id)
    {
        //
        $perawatan = Perawatan::where('id_perawatan', $id)->first();

        $update_data = [
            'status_perawatan' => 'selesai'
        ];

        Perawatan::where('id_perawatan', $id)->update($update_data);

        $id_stok = $perawatan->id_stok;
    
        $jml_kembali = $perawatan->jml_item;
        $id_barang = $perawatan->id_barang;
        $stok = Stok::where('id_stok', $id_stok)->first();
        $insert = [
            'id_barang' => $id_barang,
            'jumlah_stok' => $jml_kembali,
            'keterangan' => '',
            'id_status' => '2',
            'id_ukuran' => $stok->id_ukuran,
          ];
      
        Stok::insert($insert);

        return redirect()->route('perawatan.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
