<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = 'pemakaian';
    protected $primaryKey = 'id_pemakaian';
    protected $guarded = [];

    protected $fillable = [
        'id_pemakaian','id_user','nama_kegiatan','tgl_pinjam','tgl_pengembalian','jml_item', 'id_barang', 'nama_peminjam'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
