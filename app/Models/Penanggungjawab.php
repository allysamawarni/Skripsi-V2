<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanggungjawab extends Model
{
    use HasFactory;

    protected $table = 'penanggungjawab';
    protected $primaryKey = 'id_pj';
    protected $gyarded = [];

}
