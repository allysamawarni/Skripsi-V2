<?php

namespace App\Http\Controllers;
use App\Models\Status;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;


class Statuscontroller extends Controller
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
            $query = Status::orderBy('id_status', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('aksi', function($item) {
            return '
                <div class="aksi d-flex align-items-center">
                    <div class="aksi-edit px-1">
                        <a class="btn btn-success edit" href="'. route('status.edit', $item->id_status) .'">
                            edit
                        </a>
                    </div>
                    <div class="aksi-hapus">
                        <form class="inline-block" action="'. route('status.destroy', $item->id_status) .'" method="POST">
                            <button class="btn btn-danger">
                                hapus
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

        return view('status.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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
        Status::create($data);

        return redirect()->route('status.index');
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
        $item = Status::findOrFail($id);

        return view('status.edit', [
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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Status::findOrFail($id);

        $item->update($data);
        return redirect()->route('status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $data = Status::findOrFail($id);
            $data->delete();
            return redirect()->route('status.index');
    
    }
}
