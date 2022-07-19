<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
     use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $guarded = [];

    public function kategori() {
        return $this->hasOne(Kategori::class, 'id_kategori', 'id_kategori');
    }
    public function status()
    {
        return $this->hasOne(Status::class, 'id_status', 'id_status');
    }
}
