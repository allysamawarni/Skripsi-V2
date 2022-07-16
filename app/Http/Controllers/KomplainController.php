<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komplain;
use App\Models\Barang;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

          if(request()->ajax())
          {
              $query = Komplain::with('barang')//join('barang', 'barang.id_barang', 'komplains.id')
                          ->join('users', 'users.id', 'komplains.id_user')
                          ->where('parent_id', NULL)
                          ->select('komplains.*', 'users.name')
                          ->orderBy('komplains.id', 'asc')->get();
                          // dd($query);
              return DataTables::of($query)
                  ->addIndexColumn()
                  ->addColumn('nama_barang', function($item){
                    // dd($item->barang);
                    return $item->barang->nama_barang;
                  })
                  ->editColumn('aksi', function ($item) {
                        return '
                            <div class="aksi d-flex align-items-center">
                                <div class="aksi-edit px-1">
                                    <a class="btn btn-success edit" href="'. route('komplain.show', $item->id) .'">
                                        Lihat
                                    </a>
                                </div>
                                <div class="aksi-hapus">
                                    <form class="inline-block" action="'. route('komplain.destroy', $item->id) .'" method="POST">
                                        <button class="btn btn-danger">
                                            Hapus
                                        </button>
                                            '. method_field('delete') . csrf_field() .'
                                    </form>
                                </div>
                            </div>
                        ';
                    })
              ->rawColumns(['name','nama_barang', 'pesan', 'aksi'])
              ->make();
          }
        return view('komplain.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $barang = Barang::all()->pluck('nama_barang', 'id_barang');
         return view('komplain.create', compact('barang'));
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
        $data['id_user'] = Auth::user()->id;

        $barang = Komplain::create($data);
        $user = Auth::user()->getRoleNames()[0];

        if($user == 'Ukm'){
          return redirect()->back();
        }else{
          return redirect()->route('komplain.index');
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
      $komplain = Komplain::with('barang')//join('barang', 'barang.id_barang', 'komplains.id')
                  ->join('users', 'users.id', 'komplains.id_user')
                  ->where('komplains.id', $id)
                  ->select('komplains.*', 'users.name')
                  ->first();
        return view('komplain.show', compact('komplain'));
    }

    public function reply(Request $request, $id) {
        $komp = Komplain::find($id);
         $data = $request->all();
         $data['parent_id'] = $id;
         $data['id_user'] = Auth::user()->id;
         $data['id_barang'] = $komp->id_barang;
         $item = Komplain::create($data);
        return redirect()->route('komplain.index');
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

      return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       $item = Komplain::findOrFail($id);
       $item->delete();

       $parent = Komplain::where('parent_id', $item->id)->delete();

       return redirect()->route('komplain.index');

    }
}
