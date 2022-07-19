<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perawatan;
use App\Models\Barang;
use App\Models\Status;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


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
           $query = Perawatan::orderBy('id_perawatan', 'desc')->get();
           return DataTables::of($query)
               ->addIndexColumn()
               ->editColumn('foto_perawatan', function($item){
                   return $item->foto_perawatan ? '<img src="'. Storage::url($item->foto_perawatan).'" style="max-height: 50px;" />' : '';
               })
               ->editColumn('status_barang', function ($item){
                 $status = Status::find($item->id_status);
                 return $status ? $status->nama_status : null;
               })
               ->addColumn('aksi', function($item) {
                   return '
                       <div class="aksi d-flex align-items-center">
                           <div class="aksi-edit px-1">
                               <a class="btn btn-success edit" href="'. route('perawatan.edit', $item->id_barang) .'">
                                   edit
                               </a>
                           </div>
                           <div class="aksi-hapus">
                               <form class="inline-block" action="'. route('perawatan.destroy', $item->id_barang) .'" method="POST">
                                   <button class="btn btn-danger">
                                       hapus
                                   </button>
                                       '. method_field('delete') . csrf_field() .'
                               </form>
                           </div>
                       </div>
                   ';

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
