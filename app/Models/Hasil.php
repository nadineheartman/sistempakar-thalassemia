<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyakit;

class Hasil extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'konsultasi_id', 'penyakit_id', 'nilai_akurasi', 'result_penyakit', 'json_gejala', 'json_penyakit'
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
