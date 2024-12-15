<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Mengatur middleware untuk memastikan pengguna harus login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar semua gejala.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gejalas = Gejala::all(); // Mengambil semua data gejala dari database
        return view('admin.gejala', compact('gejalas')); // Mengirim data gejala ke view
    }

    /**
     * Menampilkan form untuk membuat gejala baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah', ["name" => "Gejala"]); // Menampilkan form untuk tambah gejala baru
    }

    /**
     * Menyimpan gejala baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'kodegejala' => 'required',
            'namagejala' => 'required',
        ]);

        // Membersihkan 'kodegejala' dari karakter non-numerik
        $cleanedKodeGejala = preg_replace('/\D/', '', $request->input('kodegejala'));

        // Membuat gejala baru dengan data yang telah divalidasi dan kodegejala yang sudah dibersihkan
        Gejala::create([
            'kodegejala' => $cleanedKodeGejala,
            'namagejala' => $request->input('namagejala'),
        ]);

        // Redirect ke halaman indeks gejala dengan pesan sukses
        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit data gejala yang dipilih.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function edit(Gejala $gejala)
    {
        return view('admin.edit-gejala', compact('gejala')); // Menampilkan form edit dengan data gejala
    }

    /**
     * Memperbarui data gejala yang dipilih di dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gejala $gejala)
    {
        // Validasi data input
        $request->validate([
            'kodegejala' => 'required',
            'namagejala' => 'required',
        ]);

        // Membersihkan 'kodegejala' dari karakter non-numerik
        $cleanedKodeGejala = preg_replace('/\D/', '', $request->input('kodegejala'));

        // Memperbarui data gejala dengan kodegejala yang sudah dibersihkan
        $gejala->update([
            'kodegejala' => $cleanedKodeGejala,
            'namagejala' => $request->input('namagejala'),
        ]);

        // Redirect ke halaman indeks gejala dengan pesan sukses
        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala updated successfully');
    }

    /**
     * Menghapus gejala yang dipilih dari database.
     *
     * @param  \App\Models\Gejala  $gejala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gejala $gejala)
    {
        $gejala->delete(); // Menghapus gejala dari database

        // Redirect ke halaman indeks gejala dengan pesan sukses
        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala deleted successfully');
    }
}
