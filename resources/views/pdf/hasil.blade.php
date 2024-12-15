@extends('components.layout')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <main class="py-8 mb-8">
        <div class="container px-4 flex flex-col h-full gap-10">
            <h1 class="login text-center">HASIL SCREENING THALASSEMIA</h1>
            <div class="max-w-[800px] md:w-[800px] md:mx-auto text-red font-semibold self-start">
                <div class="">Nama: {{ $hasil->user->name }}</div>
                <div class="">Tanggal Screening: {{ Carbon::parse($hasil->created_at)->format('d-m-Y') }}
                </div>
            </div>
            @if ($gejalas)
                <div class="overflow-auto">
                    <div class="mx-auto" style="max-width: 800px">
                        <h2 class="font-bold text-lg text-red text-left">Gejala yang dialami</h2>
                        <table class="styled-table w-full mt-3 text-left text-neutral-500 rounded-md overflow-hidden">
                            <thead class="text-sm uppercase bg-red text-cream">
                                <tr class="text-center">
                                    <th scope="col" class="px-3 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Gejala
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Nilai Keyakinan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejalas as $key => $gejala)
                                    <tr class="border-[1px] border-orange default-text">
                                        <td class="text-center border-[1px] border-orange px-3">{{ ++$key }}</td>
                                        <td class="border-[1px] border-orange px-3">{{ $gejala->namagejala }}</td>
                                        @php
                                            $optionUser = $gejala->kondisi_user;
                                            if (
                                                $gejala->namagejala === 'Transfusi darah' ||
                                                $gejala->namagejala === 'Pernah Transfusi darah?'
                                            ) {
                                                switch ($gejala->kondisi_user) {
                                                    case 'Pasti':
                                                        $optionUser = 'Rutin (> 10 kali)';
                                                        break;
                                                    case 'Hampir Pasti':
                                                        $optionUser = 'Sering (> 5 kali)';
                                                        break;
                                                    case 'Kemungkinan Besar':
                                                        $optionUser = 'Jarang (> 3 kali)';
                                                        break;
                                                    case 'Mungkin':
                                                        $optionUser = 'Pernah (< 3 kali)';
                                                        break;
                                                    case 'Tidak':
                                                        $optionUser = 'Tidak pernah';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            }
                                        @endphp
                                        <td class="border-[1px] border-orange px-3">{{ $optionUser }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if ($penyakits)
                <div class="overflow-auto">
                    <div class="mx-auto" style="max-width: 800px">
                        <h2 class="font-bold text-red text-lg text-left">Persentase Penyakit</h2>
                        <table class="styled-table mt-3 w-full text-left text-neutral-500 rounded-md overflow-hidden">
                            <thead class="text-sm uppercase bg-red text-cream">
                                <tr class="text-center">
                                    <th scope="col" class="px-3 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Nama Penyakit
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Tingkat Kepercayaan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penyakits as $key => $penyakit)
                                    <tr class="text-center default-text">
                                        <td scope="col" class="text-center border-[1px] border-orange px-3">
                                            {{ ++$key }}
                                        </td>
                                        <td scope="col" class="border-[1px] border-orange px-3">
                                            {{ $penyakit->namapenyakit }}
                                        </td>
                                        <td scope="col" class="border-[1px] border-orange px-3">
                                            {{ $penyakit->persen }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="mt-4">
                <p class="text-center font-bold text-3xl text-red hasil-akhir">Hasil Akhir: {{ $hasil->result_penyakit }}
                </p>
            </div>

            @if ($hasil->result_penyakit != 'Normal' && $hasil->result_penyakit != 'Sehat')
                <h1 class="mt-4 text-3xl mb-3 font-bold text-center login">Solusi:
            @endif
        </div>
        @if ($hasil->result_penyakit == 'Thalassemia Mayor')
            {{-- Mayor --}}
            <div class="text-red md:text-xl font-semibold text-center mt-3 max-w-[600px] mx-auto">
                <p class="text-center">
                    Silahkan lanjutkan pengobatan rutin yang biasa dilakukan, seperti :
                <ol>
                    <li>1. Transfusi darah rutin (harus dengan pengawasan dokter)</li>
                    <li>2. Terapi kelasi besi (harus dengan pengawasan dokter)</li>
                    <li>3. Melakukan transplantasi sumsum tulang (jika diperlukan)</li>
                </ol>
                </p>
            </div>
        @elseif ($hasil->result_penyakit == 'Thalassemia Intermedia')
            {{-- Mayor --}}
            <div class="text-red text-xl font-semibold text-center mt-3 max-w-[600px] mx-auto">
                <p class="text-center">
                    Segera lakukan pemeriksaan laboratorium darah lengkap oleh dokter. Apabila hasil pemeriksaan
                    laboratorium
                    nantinya sesuai dengan hasil screening, maka solusi pengobatan yang harus dilakukan selanjutnya
                    adalah :
                <ol>
                    <li>1. Transfusi darah secara berkala (tetapi tidak rutin, jika diperlukan)</li>
                    <li>2. Terapi kelasi besi (diperlukan apabila kadar ferritin nya tinggi)</li>
                </ol>
                </p>
            </div>
        @elseif($hasil->result_penyakit == 'Thalassemia Minor')
            {{-- MINOR --}}
            <div class="text-red text-xl font-semibold text-center mt-3 max-w-[600px] mx-auto">
                Thalassemia Minor tidak memerlukan pengobatan dan transfusi darah. Tetapi,
                dianjurkan untuk tetap melakukan pemeriksaan laboratorium darah lengkap lebih
                lanjut oleh dokter, terlebih untuk pasangan yang akan menikah.
            </div>
        @elseif($hasil->result_penyakit == 'Normal')
            <div class="text-red text-xl font-semibold text-center txtshdw mt-3 max-w-[600px] mx-auto">
                Anda diprediksi <span class="text-yellow-800">tidak menderita penyakit Thalassemia</span> karena tingkat
                kepercayaan 0%. meskipun anda
                memiliki keluarga dengan riwayat Thalassemia.

                Untuk mendapatkan diagnosa pasti, dibutuhkan pemeriksaan laboratorium darah lengkap lebih lanjut oleh dokter
                sebagai penunjang.
            </div>
        @elseif($hasil->result_penyakit == 'Sehat')
            <div class="text-red text-xl font-semibold text-center txtshdw mt-3 max-w-[600px] mx-auto">
                Selamat, anda <span class="text-yellow-800">tidak menderita penyakit Thalassemia</span>. Usahakan untuk
                tetap melakukan screening terhadap pasangan anda
                sebelum melakukan pernikahan, untuk mencegah terjadinya Thalassemia pada generasi anda selanjutnya.
            </div>
        @endif
        </div>
    </main>


    @if (isset($isPdf))
        <style>
            * {
                font-family: sans-serif;
            }

            header,
            footer {
                display: none;
            }

            ol {
                list-style: none
            }

            .hasil-akhir {
                font-size: 24px;
                font-weight: bold
            }

            .styled-table thead tr {
                background-color: #A84448;
                color: #ffffff;
                text-align: left;
            }

            .styled-table th,
            .styled-table td {
                padding: 12px 15px;
            }

            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #A84448;
            }

            .styled-table tbody tr.active-row {
                font-weight: bold;
                color: #A84448;
            }

            .styled-table {
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 0.9em;
                font-family: sans-serif;
                min-width: 400px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }
        </style>
    @endif
@endsection
