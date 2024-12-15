<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodepenyakit', 'namapenyakit', 'solusi'
    ];

    public function pengetahuans()
    {
        return $this->hasMany(Pengetahuan::class);
    }
}
