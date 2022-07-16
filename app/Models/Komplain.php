<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class Komplain extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function barang() {
        return $this->hasOne(Barang::class, 'id_barang', 'id_barang');
    }
}
