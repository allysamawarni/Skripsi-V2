<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class KategoriController extends Controller
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
            $query = Kategori::orderBy('id_kategori', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('aksi', function($item) {
            return '
                <div class="aksi d-flex align-items-center">
                    <div class="aksi-edit px-1">
                        <a class="btn btn-success edit" href="'. route('kategori.edit', $item->id_kategori) .'">
                            Edit
                        </a>
                    </div>
                    <div class="aksi-hapus">
                        <form class="inline-block" action="'. route('kategori.destroy', $item->id_kategori) .'" method="POST">
                            <button class="btn btn-danger">
                                Hapus
                            </button>
                                '. method_field('delete') . csrf_field() .'
                        </form>
                    </div>
                </div>
            ';

        })
            ->rawColumns(['aksi'])
            ->make();
        }

        return view('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        $data = $request->all();
        Kategori::create($data);

        return redirect()->route('kategori.index');

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
        $item = Kategori::findOrFail($id);

        return view('kategori.edit', [
            'item'=>$item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, $id)
    {
        $data = $request->all();
        $item = Kategori::findOrFail($id);

        $item->update($data);
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        return redirect()->route('kategori.index');

    }
}
