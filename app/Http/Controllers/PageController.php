<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin.home');
    }

    public function riwayat()
    {
        $hasil = Hasil::latest()->where('user_id', Auth::user()->id)->first();
        $penyakits = json_decode($hasil->json_penyakit);
        $gejalas = json_decode($hasil->json_gejala);

        return view('pdf.hasil', compact('hasil', 'penyakits', 'gejalas'));
    }
}
