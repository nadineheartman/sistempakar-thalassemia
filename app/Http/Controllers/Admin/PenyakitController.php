<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Menetapkan middleware untuk memastikan pengguna harus login sebelum mengakses controller ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar semua penyakit yang ada dalam sistem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penyakits = Penyakit::all(); // Mengambil semua data penyakit dari database
        return view('admin.penyakit', compact('penyakits')); // Mengirim data penyakit ke view
    }

    /**
     * Menampilkan form untuk membuat data penyakit baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah', ["name" => "Penyakit"]); // Menampilkan form untuk tambah penyakit baru
    }

    /**
     * Menyimpan data penyakit baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'kodepenyakit' => 'required',
            'namapenyakit' => 'required',
        ]);

        // Membersihkan 'kodepenyakit' dari karakter non-numerik
        $cleanedKodePenyakit = preg_replace('/\D/', '', $request->input('kodepenyakit'));

        // Membuat entri penyakit baru di database dengan kodepenyakit yang sudah dibersihkan
        Penyakit::create([
            'kodepenyakit' => $cleanedKodePenyakit,
            'namapenyakit' => $request->input('namapenyakit'),
        ]);

        // Redirect ke halaman indeks penyakit dengan pesan sukses
        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit data penyakit yang dipilih.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyakit $penyakit)
    {
        return view('admin.edit-penyakit', compact('penyakit')); // Menampilkan form edit dengan data penyakit yang ada
    }

    /**
     * Memperbarui data penyakit yang dipilih di dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        // Validasi input dari form
        $request->validate([
            'kodepenyakit' => 'required',
            'namapenyakit' => 'required',
        ]);

        // Membersihkan 'kodepenyakit' dari karakter non-numerik
        $cleanedKodePenyakit = preg_replace('/\D/', '', $request->input('kodepenyakit'));

        // Memperbarui data penyakit di database dengan kodepenyakit yang sudah dibersihkan
        $penyakit->update([
            'kodepenyakit' => $cleanedKodePenyakit,
            'namapenyakit' => $request->input('namapenyakit'),
        ]);

        // Redirect ke halaman indeks penyakit dengan pesan sukses
        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit updated successfully');
    }

    /**
     * Menghapus data penyakit yang dipilih dari database.
     *
     * @param  \App\Models\Penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete(); // Menghapus data penyakit dari database

        // Redirect ke halaman indeks penyakit dengan pesan sukses
        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit deleted successfully');
    }
}
