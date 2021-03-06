<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\User;
use App\Models\Event;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
           $query = Pembelian::join('users as u1', 'u1.id', 'pembelians.id_user')
                      ->leftJoin('users as u2', 'u2.id', 'pembelians.assign_by')
                      ->leftJoin('events', 'events.id', 'pembelians.id_event')
                      ->select('pembelians.*', 'pembelians.assign_by as id_assign', 'u2.name as assign_by', 'u1.name as name')
                      ->orderBy('id', 'desc')->get();
           return DataTables::of($query)
               ->addIndexColumn()
               ->editColumn('nama_pembelian', function ($item) {
                 return $item->nama_pembelian;
               })
               ->editColumn('assign_by', function($item){
                 $ketua = $item->id_assign ? User::find($item->id_assign) : null;
                 $kema = $item->acc_kema ? User::find($item->acc_kema) : null;
                 $rektor = $item->acc_rektor ? User::find($item->acc_rektor) : null;
                 if($ketua){
                   return '
                    <div>
                    '.($ketua ? $ketua->name : '').'<br />
                    '.($kema ? $kema->name : '').'<br />
                    '.($rektor ? $rektor->name : '').'<br />
                    </div>
                  ';
                 }else {
                   return null;
                 }
               })
               ->editColumn('image_pembelian', function($item) {
                   return $item->image_pembelian ? '<img src="'. Storage::url($item->image_pembelian).'" style="max-height: 50px;" />' : '';
               })
               ->editColumn('harga_pembelian', function($item) {
                   return number_format($item->harga_pembelian);
               })
               ->editColumn('created_at', function($item) {
                 return \Carbon\Carbon::parse($item->created_at)->format('d-M-Y');
               })
               ->addColumn('pdf_file', function($item) {
                 if($item->pdf_file != null){
                   return '
                     <a href="'.Storage::url($item->pdf_file).'" class="btn btn-primary btn-sm" target="_blank">
                      File Pembelian
                     </a>
                   ';
                 } else {
                   return '';
                 }
               })
               ->addColumn('aksi', function($item) {
                 $user = Auth::user()->getRoleNames()[0];
                 if($user == 'Ketua' && $item->assign_by == null) {
                   return '
                     <div class="aksi d-flex align-items-center">
                         <div class="aksi-edit px-1">
                           <form class="inline-block" action="'. route('pembelian.terima', $item->id) .'" method="POST">
                               <button class="btn btn-success">
                                   Terima
                               </button>
                                   '. method_field('post') . csrf_field() .'
                           </form>
                         </div>
                         <div class="aksi-hapus">
                             <form class="inline-block" action="'. route('pembelian.destroy', $item->id) .'" method="POST">
                                 <button class="btn btn-danger">
                                     Tolak
                                 </button>
                                     '. method_field('delete') . csrf_field() .'
                             </form>
                         </div>
                     </div>
                     ';
                 } else if($user == 'Admin' && $item->assign_by == null) {
                     return '
                         <div class="aksi d-flex align-items-center">
                             <div class="aksi-edit px-1">
                                 <a class="btn btn-success edit" href="'. route('pembelian.edit', $item->id) .'">
                                     edit
                                 </a>
                             </div>
                             <div class="aksi-hapus">
                                 <form class="inline-block" action="'. route('pembelian.destroy', $item->id) .'" method="POST">
                                     <button class="btn btn-danger">
                                         hapus
                                     </button>
                                         '. method_field('delete') . csrf_field() .'
                                 </form>
                             </div>
                         </div>
                     ';
                 } else if($user == 'Kema' && $item->assign_by != null && $item->acc_kema == null) {
                   return '
                     <div class="aksi d-flex align-items-center">
                         <div class="aksi-edit px-1">
                           <form class="inline-block" action="'. route('pembelian.terimakema', $item->id) .'" method="POST">
                               <button class="btn btn-success">
                                   Terima
                               </button>
                                   '. method_field('post') . csrf_field() .'
                           </form>
                         </div>
                         <div class="aksi-hapus">
                             <form class="inline-block" action="'. route('pembelian.destroy', $item->id) .'" method="POST">
                                 <button class="btn btn-danger">
                                     Tolak
                                 </button>
                                     '. method_field('delete') . csrf_field() .'
                             </form>
                         </div>
                     </div>
                     ';
                 } else if($user == 'Rektor' && $item->acc_kema != null && $item->acc_rektor == null) {
                   return '
                     <div class="aksi d-flex align-items-center">
                         <div class="aksi-edit px-1">
                           <form class="inline-block" action="'. route('pembelian.terimarektor', $item->id) .'" method="POST">
                               <button class="btn btn-success">
                                   Terima
                               </button>
                                   '. method_field('post') . csrf_field() .'
                           </form>
                         </div>
                         <div class="aksi-hapus">
                             <form class="inline-block" action="'. route('pembelian.destroy', $item->id) .'" method="POST">
                                 <button class="btn btn-danger">
                                     Tolak
                                 </button>
                                     '. method_field('delete') . csrf_field() .'
                             </form>
                         </div>
                     </div>
                     ';
                 } else if($user == 'Ketua' && $item->assign_by != null){
                   return '
                     <div class="aksi d-flex align-items-center">
                         <div class="aksi-edit px-1">
                             <span class="btn btn-primari edit"">
                                 Disetujui
                             </span>
                         </div>
                     </div>
                   ';
                 } else {
                   return null;
                 }
             })
           ->rawColumns(['id','image_pembelian','aksi', 'pdf_file', 'assign_by'])
           ->make();
       }

        return view('pembelian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = Event::all()->pluck('nama_event', 'id');
        return view('pembelian.create', compact('event'));
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
        $data['image_pembelian'] = $request->file('image_pembelian')->store('assets/pembelian','public');
        $data['pdf_file'] = $request->file('pdf_file')->store('assets/pdfpembelian','public');
        $data['id_user'] = Auth::user()->id;
        $barang = Pembelian::create($data);
        return redirect()->route('pembelian.index');
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
      $item = Pembelian::find($id);
      $event = Event::all()->pluck('nama_event', 'id');
        return view('pembelian.edit', compact('item', 'event'));
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
         if($request->image_pembelian) {
            $data['image_pembelian'] = $request->file('image_pembelian')->store('assets/pembelian','public');
         } else {
            unset($data['image_pembelian']);
         }
         $data['id_user'] = Auth::user()->id;
         $item = Pembelian::findOrFail($id);
         $item->update($data);

        return redirect()->route('pembelian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $item = Pembelian::findOrFail($id);
         $item->delete();

         return redirect()->route('pembelian.index');
    }

    public function terima($id){
       $item = Pembelian::findOrFail($id);
       $item->update(['assign_by' => Auth::user()->id]);
       return redirect()->route('pembelian.index');
    }
    public function terimakema($id){
       $item = Pembelian::findOrFail($id);
       $item->update(['acc_kema' => Auth::user()->id]);
       return redirect()->route('pembelian.index');
    }
    public function terimarektor($id){
       $item = Pembelian::findOrFail($id);
       $item->update(['acc_rektor' => Auth::user()->id]);
       return redirect()->route('pembelian.index');
    }
}
