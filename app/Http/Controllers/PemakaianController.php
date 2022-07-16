<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemakaian;
use App\Models\User;
use App\Models\Barang;
use Yajra\DataTables\Facades\DataTables;


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
                ->editColumn('action', function ($item) {
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
            ->rawColumns(['id_user','nama_user','aksi'])
            ->make();
        }

        return view('pemakaian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all()->pluck('name', 'id');
        $barang = Barang::all()->pluck('nama_barang', 'id_barang');
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
      $data = $request->all();
      $barang = Pemakaian::create($data);
      return redirect()->route('pemakaian.index');
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
         $user = User::all()->pluck('nama_user', 'id_user');

        return view('pemakaian.edit', [
            'item' => $item,
            'user' =>$user,
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
