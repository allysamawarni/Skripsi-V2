<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index() {
        $barang = Barang::count();
        $kategori = Kategori::count();
        return view('dashboard.index', compact('barang', 'kategori'));
    }
}
