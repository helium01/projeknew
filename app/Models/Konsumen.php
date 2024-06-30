<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $fillable = [
        'id_Konsumen',
        'Nama',
        'Alamat',
        'NoHp',
    ];
}
