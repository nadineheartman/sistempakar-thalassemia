<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Mengatur middleware untuk memastikan pengguna harus login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar semua pengguna.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penggunas = User::all(); // Mengambil semua data pengguna dari database
        return view('admin.pengguna', compact('penggunas')); // Mengirim data pengguna ke view
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah-pengguna', ["name" => "Pengguna"]); // Menampilkan form untuk tambah pengguna baru
    }

    /**
     * Menyimpan pengguna baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        // Membuat pengguna baru dengan data yang telah divalidasi
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']), // Hashing password
            'role' => 'user',
        ]);

        // Redirect ke halaman indeks pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit data pengguna yang dipilih.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pengguna)
    {
        return view('admin.edit-pengguna', compact('pengguna')); // Menampilkan form edit dengan data pengguna
    }

    /**
     * Memperbarui data pengguna yang dipilih di dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pengguna)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        // Jika password tidak diubah, hanya update data lain
        if ($request->password == NULL) {
            User::where('id', $pengguna->id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'role' => $request['role'],
            ]);
        } else {
            // Jika password diubah, update juga password
            User::where('id', $pengguna->id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']), // Hashing password
                'role' => $request['role'],
            ]);
        }

        // Redirect ke halaman indeks pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Menghapus pengguna yang dipilih dari database.
     *
     * @param  \App\Models\User  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete(); // Menghapus pengguna dari database

        // Redirect ke halaman indeks pengguna dengan pesan sukses
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'User deleted successfully');
    }

    // /**
    //  * Mencari pengguna berdasarkan keyword yang diberikan.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function search(Request $request)
    // {
    //     $keyword = $request->search; // Mendapatkan keyword pencarian
    //     $penggunas = User::where('name', 'like', "%" . $keyword . "%")->paginate(5); // Mencari pengguna yang namanya sesuai dengan keyword
    //     return view('admin.user.show', compact('penggunas'))->with('i', (request()->input('page', 1) - 1) * 5); // Menampilkan hasil pencarian dengan pagination
    // }
}
