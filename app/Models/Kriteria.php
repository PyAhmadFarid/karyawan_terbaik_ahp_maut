<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    public function Perbandigan(){
        return $this->hasMany(Perbandingan::class,'id_kriteria_1','id');
    }
}
