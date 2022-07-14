<?php

namespace App\Http\Controllers;
use App\Models\Stok;
use App\Models\Barang;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class Stokcontroller extends Controller
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
            $query = Stok::orderBy('id_stok', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('aksi', function($item) {
            return '
                <div class="aksi d-flex align-items-center">
                    <div class="aksi-edit px-1">
                        <a class="btn btn-success edit" href="'. route('stok.edit', $item->id_stok) .'">
                            edit
                        </a>
                    </div>
                </div>
            ';

        })
            ->rawColumns(['aksi'])
            ->make();
        }

        return view('stok.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all()->pluck('nama_barang', 'id_barang');
        return view('stok.create', [
            'barang'=>$barang
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
        Stok::create($data);

        return redirect()->route('stok.index');
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
        $item = Stok::findOrFail($stok->id_stok);
         $kategori = Barang::all()->pluck('nama_barang', 'id_barang');

        return view('stok.edit', [
            'item' => $item,
            'barang' =>$barang,
        ]);
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $data = $request->all();
    //     $item = Stok::findOrFail($id);

    //     $item->update($data);
    //     return redirect()->route('stok.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Stok::findOrFail($id);
            $data->delete();
            return redirect()->route('stok.index');
    }
}
