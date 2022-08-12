<?php

namespace App\Http\Controllers;

use App\Models\Penanggungjawab;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;

class PenanggungjawabController extends Controller
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
            $query = Penanggungjawab::join('users', 'users.id', 'penanggungjawab.id_users')
                    ->select('penanggungjawab.*', 'users.name')
                    ->orderBy('penanggungjawab.id_pj', 'desc')->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('aksi', function($item) {
                    if(Auth::user()->getRoleNames()[0] == 'Admin'){

                        if($item->status == 'aktiv'){
                            return '
                                <div class="aksi d-flex align-items-center">
                                    <div class="aksi-hapus">
                                        <a class="btn btn btn-danger edit" href="'. url('nonaktiv_pj', $item->id_pj) .'">
                                            Non Aktiv
                                        </a>
                                    </div>
                                </div>
                            ';

                        }else{
                            return '
                            <div class="aksi d-flex align-items-center">
                                <div class="aksi-edit px-1">
                                    <a class="btn btn-success edit" href="'. url('aktiv_pj', $item->id_pj) .'">
                                        Aktiv
                                    </a>
                                </div>
                            </div>
                            ';
                        }
                    }else {
                      return null;
                    }

        })
            ->rawColumns(['aksi'])
            ->make();
        }

        return view('penaggungjawab.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::select('*')->get();
        return view('penaggungjawab.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        //
        $data_update = [
            'status' => "non-aktiv"
        ];

        $pj = Penanggungjawab::select('*')->get();

        foreach ($pj as $key => $value) {
            Penanggungjawab::where('id_pj', $value->id_pj)->update($data_update);
        }


        $data = [
            'id_users' => $request->id_users,
            'tahun' => $request->tahun,
        ];
        
        Penanggungjawab::insert($data);

        return redirect()->route('penanggungjawab');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penanggungjawab  $penanggungjawab
     * @return \Illuminate\Http\Response
     */
    public function aktiv($id_pj)
    {
        //
        $data_update = [
            'status' => "non-aktiv"
        ];

        $pj = Penanggungjawab::select('*')->get();

        foreach ($pj as $key => $value) {
            Penanggungjawab::where('id_pj', $value->id_pj)->update($data_update);
        }

        $update = [
            'status' => "aktiv"
        ];

        Penanggungjawab::where('id_pj', $id_pj)->update($update);
        return redirect()->route('penanggungjawab');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penanggungjawab  $penanggungjawab
     * @return \Illuminate\Http\Response
     */
    public function non_aktiv($id_pj)
    {
        //
        $data_update = [
            'status' => "non-aktiv"
        ];

        $pj = Penanggungjawab::select('*')->get();

        foreach ($pj as $key => $value) {
            Penanggungjawab::where('id_pj', $value->id_pj)->update($data_update);
        }

        $update = [
            'status' => "non-aktiv"
        ];

        Penanggungjawab::where('id_pj', $id_pj)->update($update);
        return redirect()->route('penanggungjawab');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penanggungjawab  $penanggungjawab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penanggungjawab $penanggungjawab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penanggungjawab  $penanggungjawab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penanggungjawab $penanggungjawab)
    {
        //
    }
}
