@extends('components.layout')

@section('content')
    <main class="py-8 flex items-center">
        <div class="px-4 container flex flex-col items-center justify-center h-full gap-6">
            <h1 class="text-center !text-3xl login">KESIMPULAN</h1>

            @if (!isset($hasil))
                <p class="text-red text-2xl font-semibold">ANDA SEHAT!</p>
            @else
                @if ($hasil == 'Normal')
                    <p class="text-red font-semibold text-lg txtshdw tracking-wide text-center">
                        Berdasarkan atas tingkatan kondisi yang dialami sesuai dengan gejala yang ada,
                        anda diprediksi <span class="text-yellow-800">Tidak Menderita Penyakit Thalassemia</span> karena
                        tingkat kepercayaan
                        {{ floor($persen * 100) }}%.
                        meskipun anda memiliki keluarga dengan riwayat Thalassemia.
                    </p>
                @else
                    <p class="text-red font-semibold text-lg txtshdw tracking-wide text-center">
                        Berdasarkan atas tingkatan kondisi yang dialami sesuai dengan gejala yang ada,
                        anda diprediksi menderita penyakit
                        <span class="text-yellow-800">
                            {{ $hasil }}
                        </span>
                        dengan tingkat kepercayaan {{ floor($persen * 100) }}%
                    </p>
                @endif
            @endif

            @if (isset($hasil))
                @if ($hasil == 'Thalassemia Mayor')
                    {{-- Mayor --}}
                    <div class="my-2 text-red text-lg font-semibold text-center">
                        <p class="text-center">
                            Segera lakukan pemeriksaan laboratorium darah lengkap oleh dokter. Apabila hasil pemeriksaan
                            laboratorium nantinya sesuai dengan hasil screening, maka solusi pengobatan yang harus dilakukan
                            selanjutnya adalah :
                        <ol>
                            <li>1. Transfusi darah rutin (harus dengan pengawasan dokter)</li>
                            <li>2. Terapi kelasi besi (harus dengan pengawasan dokter)</li>
                            <li>3. Melakukan transplantasi sumsum tulang (jika diperlukan)</li>
                        </ol>
                        </p>
                    </div>
                @elseif ($hasil == 'Thalassemia Intermedia')
                    {{-- Mayor --}}
                    <div class="my-2 text-red text-lg font-semibold text-center">
                        <p class="text-center">
                            Segera lakukan pemeriksaan laboratorium darah lengkap oleh dokter. Apabila hasil pemeriksaan
                            laboratorium nantinya sesuai dengan hasil screening, maka solusi pengobatan yang harus dilakukan
                            selanjutnya adalah :
                        <ol>
                            <li>1. Transfusi darah secara berkala (tetapi tidak rutin, jika diperlukan)</li>
                            <li>2. Terapi kelasi besi (diperlukan apabila kadar ferritin nya tinggi)</li>
                        </ol>
                        </p>
                    </div>
                @elseif($hasil == 'Thalassemia Minor')
                    {{-- MINOR --}}
                    <div class="my-2 text-red text-lg font-semibold text-center">
                        Thalassemia Minor tidak memerlukan pengobatan dan transfusi darah. Tetapi,
                        dianjurkan untuk tetap melakukan pemeriksaan laboratorium darah lengkap lebih
                        lanjut oleh dokter, terlebih untuk pasangan yang akan menikah.
                    </div>
                @elseif($hasil == 'Normal')
                    {{-- NORMAL --}}
                    <div class="my-2 text-red text-lg font-semibold text-center">
                        Untuk mendapatkan diagnosa pasti, dibutuhkan pemeriksaan
                        laboratorium darah lengkap lebih lanjut oleh dokter sebagai penunjang.
                    </div>
                @endif
            @endif
            @if (!isset($hasil))
                {{-- SEHAT --}}
                <div class="my-2 text-red text-lg font-semibold txtshdw text-center txtshdw">
                    Selamat, anda <span class="text-yellow-800">Tidak Menderita Thalassemia</span>. Usahakan untuk tetap
                    melakukan screening
                    terhadap pasangan anda sebelum melakukan pernikahan, untuk mencegah
                    terjadinya Thalassemia pada generasi anda selanjutnya.
                </div>
            @endif
            <div
                class="flex items-center justify-center p-4 rounded-lg bg-red bg-opacity-30 font-semibold text-red text-center">
                Harap diperhatikan! Ketika Anda mencetak hasil dari screening saat ini, maka Anda tidak akan bisa melakukan
                screening lagi di akun ini. <br> Ketika menekan uji coba maka anda bisa melakukan screening lagi dengan
                catatan
                hasil saat ini akan dihapus
            </div>
            <div class="flex gap-10 items-center">
                @php
                    $route = null;

                    if (isset($hasil)) {
                        $route = route('get_hasil_konsultasi', ['id' => $id]);
                    } else {
                        $route = route('get_normal_result');
                    }
                @endphp

                <button id="cetakBtn" href="{{ $route }}"
                    class="txtshdw-2 font-bold text-center hover:opacity-60 shadow-md text-red p-4 rounded-xl bg-orange w-fit mx-auto">CETAK</button>
                <a href="/"
                    class="txtshdw-2 font-bold text-center hover:opacity-60 shadow-md text-red p-4 rounded-xl bg-orange w-fit mx-auto">UJI
                    COBA</a>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const cetakBtns = document.querySelectorAll("#cetakBtn")

        cetakBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Ketika hasil sudah dicetak Anda tidak akan bisa melakukan screening lagi di akun ini.",
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: `Tidak`,
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'text-base px-6 py-2 font-bold text-white bg-blue-600 rounded-full',
                        denyButton: 'text-base px-6 py-2 font-bold text-white bg-red rounded-full',
                    }
                }).then((result) => {
                    console.log("{{ $route }}")
                    if (result.isConfirmed) {
                        window.location.href = "{{ $route }}"
                        setTimeout(() => {
                            window.location.href = "/"
                        }, 3000);
                    }
                })
            })
        });
    </script>

    @if (Session::has('downloaded'))
        <script>
            Swal.fire({
                title: "Hasil screening berhasil dicetak!",
                text: "Hasil bisa dilihat di file yang sudah didownload dan bisa dilihat di riwayat screening.",
                confirmButtonText: 'Ok',
                customClass: {
                    confirmButton: 'text-base px-6 py-2 font-bold text-white bg-blue-600 rounded-full',
                    denyButton: 'text-base px-6 py-2 font-bold text-white bg-red rounded-full',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/"
                }
            })
        </script>
    @endif
@endpush
