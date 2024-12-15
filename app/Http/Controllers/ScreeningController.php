<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kondisi;
use App\Models\Gejala;
use App\Models\Konsultasi;
use App\Models\Pengetahuan;
use App\Models\Penyakit;
use App\Models\User;
use App\Models\Hasil;
use \Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;

class ScreeningController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kondisis = Kondisi::all();
        $gejalas = Gejala::all();
        return view('screening', compact('kondisis', 'gejalas'));
    }

    // fungsi untuk mendapatkan hasil terbaik berdasarkan hasil konsultasi
    function get_best_result($arr)
    {
        $maxValue = -INF;
        $maxArray = [];

        foreach ($arr as $item) {
            $value = $item->persen;

            if ($value > $maxValue) {
                $maxValue = $value;
                $maxArray = $item;
            }
        }

        return $maxArray;
    }

    // fungsi untuk menampilkan hasil konsultasi
    public function hasil_konsultasi(Request $request)
    {
        $users = User::all();
        $array_bobot = array('1', '0.8', '0.6', '0.4', '0');
        $arr_gejala = array();
        $kondisis = $request->kondisi;

        for ($i = 0; $i < count($kondisis); $i++) {
            $arkondisi = explode("_", $kondisis[$i]);
            if (strlen($kondisis[$i]) > 1) {
                $arr_gejala += array($arkondisi[0] => $arkondisi[1]);
            }
        }
        // dd($arr_gejala);
        $penyakits = Penyakit::orderBy('id')->get();
        $penyakit_array = $penyakits->toArray();

        // membuat array penyakit dengan nama dan solusi
        foreach ($penyakit_array as $row_penyakit) {
            $nama_penyakit[$row_penyakit['kodepenyakit']] = $row_penyakit['namapenyakit'];
            $solusi_penyakit[$row_penyakit['kodepenyakit']] = $row_penyakit['solusi'];
        }

        $arr_penyakit = array();
        $gejalas = Gejala::orderBy('id')->get();

        // PERHITUNGAN CERTAINTY FACTOR
        foreach ($penyakits as $rpenyakit) {
            $cf = 0;
            $basis = DB::table('pengetahuans')
                ->where('penyakit_id', '=',  $rpenyakit->id)
                ->get();
            $cf_rule = [];
            $c_fold = 0;

            foreach ($basis as $rgejala) {
                for ($i = 0; $i < count($kondisis); $i++) {
                    $array_kondisi = explode("_", $kondisis[$i]);
                    $gejala = $array_kondisi[0];
                    if ($rgejala->gejala_id == $gejala) {
                        $cf = ($rgejala->nilai_cf) * ($array_bobot[$array_kondisi[1] - 1]);
                        array_push($cf_rule, $cf);
                        $c_fold_arr = [];
                        for ($j = 0; $j < count($cf_rule) - 1; $j++) {
                            $cf1 = $j == 0 ? $cf_rule[$j] : $c_fold;
                            $cf2 = $cf_rule[$j + 1];

                            if (($cf1 >= 0 && $cf2 > 0)) {
                                $cf_combine = $cf1 + $cf2 * (1 - $cf1);
                            } elseif ($cf1 < 0 || $cf2 < 0) {
                                $cf_combine = $cf1 + $cf2 / ((1 - abs($cf1)) + (1 - abs($cf2)));
                            } else {    
                                $cf_combine = $cf1 + $cf2 * (1 + $cf1);
                            }
                            $c_fold = $cf_combine;
                            array_push($c_fold_arr, $c_fold);
                        }
                    }
                }
            }
            if ($c_fold > 0) {
                $arr_penyakit += array($rpenyakit->kodepenyakit => number_format($c_fold, 5));
                arsort($arr_penyakit);
            } elseif ($c_fold == 0) {
                $arr_penyakit += array($rpenyakit->kodepenyakit => number_format(0, 0));
            }
        }
        // mengurutkan array penyakit berdasarkan nilai CF
        arsort($arr_penyakit);
        $input_gejala = serialize($arr_gejala);
        $input_penyakit = serialize($arr_penyakit);

        // membuat array penyakit dengan ID dan persentase
        $np1 = 0;
        foreach ($arr_penyakit as $key1 => $value1) {
            $np1++;
            $idpkt1[$np1] = $key1;
            $vlpkt1[$np1] = $value1;
        }

        foreach ($penyakits as $key => $penyakit) {
            $penyakit->persen = $arr_penyakit[$key + 1];
        }

        $semua_kondisi_user = [];
        foreach ($arr_gejala as $gejala) {
            $get_kondisi = Kondisi::where('id', $gejala)->first();
            if ($get_kondisi) {
                array_push($semua_kondisi_user, $get_kondisi->kondisi);
            }
        }
        foreach ($gejalas as $key => $gejala) {
            $gejala->kondisi_user = $semua_kondisi_user[$key];
        }

        // menyimpan hasil screening
        $simpan = Konsultasi::create([
            'penyakit' => $input_penyakit,
            'gejala' => $input_gejala,
        ]);

        $best_result = $this->get_best_result($penyakits);

        if ($simpan) {
            $get_id_konsultasi  = DB::table('konsultasis')
                ->select('id')
                ->orderBy('id', 'DESC')
                ->limit(1)->get();
            foreach ($get_id_konsultasi as $row_id_konsul) {
                $id_konsultasi  = $row_id_konsul->id;
            }
            Hasil::create([
                'user_id' => $request['user_id'],
                'konsultasi_id' => $id_konsultasi,
                'penyakit_id' => $best_result->id,
                'nilai_akurasi' => $best_result->persen,
            ]);
        }

        // perbarui data hasil di tabel user dan hasil
        $hasils = Hasil::latest()->where('user_id', Auth::user()->id)->first();
        $gejala_json = json_encode($gejalas);
        $penyakit_json = json_encode($penyakits);

        User::where('id', Auth::user()->id)->update([
            'last_result' => $hasils->id,
        ]);

        Hasil::latest()->where('user_id', Auth::user()->id)->update([
            'json_gejala' => $gejala_json,
            'json_penyakit' => $penyakit_json,
        ]);

        return view('hasil', compact('gejalas', 'penyakits', 'semua_kondisi_user', 'users', 'hasils', 'best_result', 'penyakit_json', 'gejala_json'));
    }

    // fungsi untuk menampilkan hasil konsultasi dalam format PDF
    public function get_hasil_konsultasi(Request $request, $id)
    {
        $hasil = Hasil::where("id", $id)->first();
        $penyakits = json_decode($hasil->json_penyakit);
        $gejalas = json_decode($hasil->json_gejala);

        return view('pdf.hasil', compact('gejalas', 'penyakits', 'hasil'));
    }

    // fungsi untuk hasilkan PDF hasil screening normal tanpa data penyakit dan gejala
    public function generate_normal_result(Request $request)
    {
        $hasil = Hasil::create([
            'user_id' => Auth::user()->id,
            'konsultasi_id' => 0,
            'penyakit_id' => 0,
            'nilai_akurasi' => 0,
            'result_penyakit' => "Sehat",
        ]);

        User::where('id', Auth::user()->id)->update([
            'last_result' => $hasil->id,
        ]);

        $data = [
            'title' => 'Hasil Screening Sistem Pakar Thalassemia',
            'date' => date('d/m/Y'),
            'hasil' => $hasil,
            'isPdf' => true,
            'penyakits' => null,
            'gejalas' => null,
        ];

        $user = Auth::user();
        User::where('id', $user->id)->update([
            'screening_status' => true,
        ]);

        $pdf = PDF::loadView('pdf.hasil', $data)->setOptions(['defaultFont' => 'sans-serif']);;
        return $pdf->download('screening-result.pdf');

        return view("home");
    }

    // fungsi untuk simpan hasil penyakit yang dipilih oleh pengguna
    public function save_hasil(Request $request, $id, $name)
    {
        $result = Hasil::where('id', $id)->update([
            'result_penyakit' => $name,
        ]);
        $persen = Hasil::where('id', $id)->get();
        $persen = $persen[0]->nilai_akurasi;
        $hasil = $name;

        return view('result', compact('hasil', 'persen', 'id'));
    }

    // fungsi untuk menyimpan hasil penyakit yang dipilih oleh pengguna
    public function get_result_pdf(Request $request, $id)
    {
        $hasil = Hasil::where("id", $id)->first();
        $penyakits = json_decode($hasil->json_penyakit);
        $gejalas = json_decode($hasil->json_gejala);

        $data = [
            'title' => 'Hasil Screening Sistem Pakar Thalassemia',
            'date' => date('d/m/Y'),
            'isPdf' => true,
            'hasil' => $hasil,
            'penyakits' => $penyakits,
            'gejalas' => $gejalas,
        ];

        $user = Auth::user();
        User::where('id', $user->id)->update([
            'screening_status' => true,
        ]);

        $timestamp = now()->format('YmdHis'); // Get current timestamp in the format YYYYMMDDHHmmss
        $filename = 'screening-result-' . $timestamp . '.pdf';

        FacadesSession::flash('downloaded', true);

        $pdf = PDF::loadView('pdf.hasil', $data)->setOptions(['defaultFont' => 'sans-serif']);;
        return $pdf->download($filename);
        // return redirect()->route('home')->with("success", "Hasil screening disimpan!");
    }
}
