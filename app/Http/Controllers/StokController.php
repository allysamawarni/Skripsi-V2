<?php

namespace App\Http\Controllers;
use App\Models\Stok;
use App\Models\Barang;
use App\Models\Status;
use App\Models\Ukuran;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = Stok::join('barang', 'barang.id_barang', 'stok.id_barang')
                      ->leftJoin('status', 'status.id_status', 'stok.id_status')
                      ->leftJoin('ukurans', 'ukurans.id_ukuran', 'stok.id_ukuran')
                      ->select('barang.nama_barang', 'stok.*', 'nama_ukuran', 'nama_status')
                      ->orderBy('id_stok', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('aksi', function($item) {
                  if(Auth::user()->getRoleNames()[0] == 'Admin'){

                    return '
                        <div class="aksi d-flex align-items-center">
                            <div class="aksi-edit px-1">
                                <a class="btn btn-success edit" href="'. route('stok.edit', $item->id_stok) .'">
                                    edit
                                </a>
                            </div>
                            <div class="aksi-hapus">
                                <form class="inline-block" action="'. route('stok.destroy', $item->id_stok) .'" method="POST">
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
            ->rawColumns(['nama_barang', 'jumlah_stok', 'ketrangan', 'aksi'])
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
        $ukuran = Ukuran::all()->pluck('nama_ukuran', 'id_ukuran');
        $status = Status::all()->pluck('nama_status', 'id_status');
        return view('stok.create', [
            'barang' => $barang,
            'ukuran' => $ukuran,
            'status' => $status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
    public function edit(Request $request, $id)
    {
        $item = Stok::findOrFail($id);
        $barang = Barang::all()->pluck('nama_barang', 'id_barang');
        $ukuran = Ukuran::all()->pluck('nama_ukuran', 'id_ukuran');
        return view('stok.edit', [
            'item' => $item,
            'barang' => $barang,
            'ukuran' => $ukuran,
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
        $item = Stok::findOrFail($id);
        $item->update($data);
        return redirect()->route('stok.index');
    }

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
