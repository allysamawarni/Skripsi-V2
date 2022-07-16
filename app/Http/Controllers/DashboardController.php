<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Komplain;
use Auth;
use App\Models\User;
class DashboardController extends Controller
{
    public function index() {
        $barang = Barang::count();
        $kategori = Kategori::count();
        $komplain = Komplain::where('parent_id', NULL)->count();

        return view('dashboard.index', compact('barang', 'kategori', 'komplain'));
    }
}
