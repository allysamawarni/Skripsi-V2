<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $primaryKey = 'id_stok';
    protected $guarded = [];

    public function ukuran(){
      return $this->hasOne(Ukuran::class, 'id_ukuran', 'id_ukuran');
    }
    public function status(){
      return $this->hasOne(Status::class, 'id_status', 'id_status');
    }

}
