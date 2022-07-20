<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Yajra\DataTables\Facades\DataTables;
use Auth;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

           if(request()->ajax()) {
              $query = Event::orderBy('id', 'desc')->get();
              return DataTables::of($query)
                  ->addIndexColumn()
                  ->addColumn('aksi', function($item) {

                      if(Auth::user()->getRoleNames()[0] == 'Admin'){
                      return '
                          <div class="aksi d-flex align-items-center">
                              <div class="aksi-edit px-1">
                                  <a class="btn btn-success edit" href="'. route('event.edit', $item->id) .'">
                                      edit
                                  </a>
                              </div>
                              <div class="aksi-hapus">
                                  <form class="inline-block" action="'. route('event.destroy', $item->id) .'" method="POST">
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
                  ->rawColumns(['id','aksi'])
                ->make();
          }
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
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
        $barang = Event::create($data);
        return redirect()->route('event.index');
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
      $item = Event::find($id);
        return view('event.edit', compact('item'));
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
         $item = Event::findOrFail($id);
         // dd($item);
         $item->update($data);

        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Event::findOrFail($id);
      // dd($item);
      $item->delete();
      return redirect()->route('event.index');
    }
}
