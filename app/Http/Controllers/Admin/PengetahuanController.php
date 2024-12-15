<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengetahuan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PengetahuanController extends Controller
{
    /**
     * Mengatur middleware untuk memastikan pengguna harus login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar semua data pengetahuan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengetahuans = Pengetahuan::all(); // Mengambil semua data pengetahuan dari database
        return view('admin.pengetahuan', compact('pengetahuans')); // Mengirim data pengetahuan ke view
    }

    /**
     * Menampilkan form untuk membuat data pengetahuan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();

        return view('admin.tambah', ["name" => "Pengetahuan", "penyakits" => $penyakits, "gejalas" => $gejalas]); // Menampilkan form untuk tambah pengetahuan baru
    }

    /**
     * Menyimpan data pengetahuan baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'gejala_id' => 'required',
            'penyakit_id' => 'required',
            'nilai_cf' => 'required',
        ]);

        // Membersihkan 'gejala_id' dan 'penyakit_id' dari karakter non-numerik
        $cleanedGejalaId = preg_replace('/\D/', '', $request->input('gejala_id'));
        $cleanedPenyakitId = preg_replace('/\D/', '', $request->input('penyakit_id'));

        // Membuat data pengetahuan baru dengan ID yang sudah dibersihkan
        Pengetahuan::create([
            'gejala_id' => $cleanedGejalaId,
            'penyakit_id' => $cleanedPenyakitId,
            'nilai_cf' => $request->input('nilai_cf'),
        ]);

        // Redirect ke halaman indeks pengetahuan dengan pesan sukses
        return redirect()->route('admin.pengetahuan.index')
            ->with('success', 'Pengetahuan created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit data pengetahuan yang dipilih.
     *
     * @param  \App\Models\Pengetahuan  $pengetahuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengetahuan $pengetahuan)
    {
        $penyakits = Penyakit::all();
        $gejalas = Gejala::all();

        return view('admin.edit-pengetahuan', compact('pengetahuan', 'penyakits', 'gejalas'));
    }

    /**
     * Memperbarui data pengetahuan yang dipilih di dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengetahuan  $pengetahuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengetahuan $pengetahuan)
    {
        // Validasi data input
        $request->validate([
            'gejala_id' => 'required',
            'penyakit_id' => 'required',
            'nilai_cf' => 'required',
        ]);

        // Membersihkan 'gejala_id' dan 'penyakit_id' dari karakter non-numerik
        $cleanedGejalaId = preg_replace('/\D/', '', $request->input('gejala_id'));
        $cleanedPenyakitId = preg_replace('/\D/', '', $request->input('penyakit_id'));

        // Memperbarui data pengetahuan dengan ID yang sudah dibersihkan
        $pengetahuan->update([
            'gejala_id' => $cleanedGejalaId,
            'penyakit_id' => $cleanedPenyakitId,
            'nilai_cf' => $request->input('nilai_cf'),
        ]);

        // Redirect ke halaman indeks pengetahuan dengan pesan sukses
        return redirect()->route('admin.pengetahuan.index')
            ->with('success', 'Pengetahuan updated successfully');
    }

    /**
     * Menghapus data pengetahuan yang dipilih dari database.
     *
     * @param  \App\Models\Pengetahuan  $pengetahuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengetahuan $pengetahuan)
    {
        $pengetahuan->delete(); // Menghapus data pengetahuan dari database

        // Redirect ke halaman indeks pengetahuan dengan pesan sukses
        return redirect()->route('admin.pengetahuan.index')
            ->with('success', 'Pengetahuan deleted successfully');
    }
}
