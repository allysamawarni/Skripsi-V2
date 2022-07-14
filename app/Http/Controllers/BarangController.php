<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
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
            $query = Barang::orderBy('id_barang', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('id_kategori', function ($item) {
                return $item->kategori->nama_kategori ?? ' ';
                })
                ->editColumn('foto_barang', function($item){
                    return $item->foto_barang ? '<img src="'. Storage::url($item->foto_barang).'" style="max-height: 50px;" />' : '';
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
        return view('barang.create', [
            'kategori'=>$kategori
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
        $data ['foto_barang'] = $request->file('foto_barang')->store('assets/barang','public');
        Barang::create($data);

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

        return view('barang.edit', [
            'item' => $item,
            'kategori' =>$kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarangRequest $request, Barang $barang)
    {
         $data = $request->all();
         if($request->foto_barang)
         {
            $data ['foto_barang'] = $request->file('foto_barang')->store('assets/barang','public');
        
         }
        else
        {
            unset($data['foto_barang']);
        }
        $item = Barang::findOrFail($barang->id_barang);
        $item ->update($data);

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
