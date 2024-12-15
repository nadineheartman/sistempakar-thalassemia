<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengetahuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyakit_id', 'gejala_id', 'nilai_cf'
    ];

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
