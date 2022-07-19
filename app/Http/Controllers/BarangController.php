<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Status;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(request()->ajax()) {
            $query = Barang::with('status')->orderBy('id_barang', 'desc')->get();
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
                ->editColumn('status_barang', function ($item){
                  return $item->status->nama_status;
                })
                ->editColumn('penyusutan', function($item){
                  if($item->nilai_residu != null || $item->umur_barang != null){
                    $penyusutan = ((Int) $item->harga_beli - (Int) $item->nilai_residu) / (Int)$item->umur_barang;
                  }
                  return $item->nilai_residu || $item->umur_barang ? number_format($penyusutan) : 0;
                })
                ->addColumn('aksi', function($item) {
                    return '
                        <div class="aksi d-flex align-items-center">
                            <div class="aksi-edit px-1">
                                <a class="btn btn-success edit" href="'. route('barang.edit', $item->id_barang) .'">
                                    edit
                                </a>
                            </div>
                            <div class="aksi-hapus">
                                <form class="inline-block" action="'. route('barang.destroy', $item->id_barang) .'" method="POST">
                                    <button class="btn btn-danger">
                                        hapus
                                    </button>
                                        '. method_field('delete') . csrf_field() .'
                                </form>
                            </div>
                        </div>
                    ';

                })
                ->rawColumns(['id_kategori','foto_barang','aksi'])
                ->make();
        }

        return view('barang.index');
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
        return view('barang.create', [
            'kategori' => $kategori,
            'status' => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
        $data = $request->all();
        $data['foto_barang'] = $request->file('foto_barang')->store('assets/barang','public');
        $barang = Barang::create($data);
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

         return redirect()->route('barang.index');

    }
}
