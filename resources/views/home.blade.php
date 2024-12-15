@extends('components.layout')

@section('content')
    <main class="py-4 my-8 flex items-center">
        <div class="container flex flex-col h-full gap-5 px-6">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-10">
                    <h1 class="text-xl text-red txtshdw-2 font-semibold">THALASSEMIA</h1>
                    <p class="text-red txtshdw-2 mt-4">
                        Thalassemia adalah penyakit genetik yang disebabkan oleh adanya kelainan darah akibat sel
                        darah merah di dalam pembuluh darah penderita mudah mengalami kerusakan. Kondisi tersebut
                        menyebabkan umur dari sel darah merah penderita akan menjadi lebih pendek jika dibandingkan
                        dengan umur dari sel darah merah orang normal pada umumnya, yaitu 120 hari.</p>
                </div>
                <div class="col-span-12 md:col-span-2 flex items-center justify-center md:items-end md:justify-end">
                    <img src="{{ asset('assets/images/darah.png') }}" class="object-contain" style="width:140px">
                </div>
            </div>
            <h2 class="text-center mt-6 text-xl text-red txtshdw-2 font-semibold">JENIS DAN SOLUSI PENGOBATAN</h2>
            <div class="flex flex-col md:flex-row gap-6 justify-center w-full">
                <div class="flex flex-col gap-4 flex-1 items-center bg-orange rounded-lg bg-opacity-40 p-4">
                    <div class="font-bold text-red">
                        Thalassemia Mayor
                    </div>
                    <p class="text-sm text-red text-center">
                        Transfusi darah rutin, terapi kelasi besi, dan transplantasi sumsum tulang (jika diperlukan)
                    </p>
                </div>
                <div class="flex flex-col gap-4 flex-1 items-center bg-orange rounded-lg bg-opacity-40 p-4">
                    <div class="font-bold text-red">
                        Thalassemia Intermedia
                    </div>
                    <p class="text-sm text-red text-center">
                        Transfusi darah secara berkala dan terapi kelasi besi
                    </p>
                </div>
                <div class="flex flex-col gap-4 flex-1 items-center bg-orange rounded-lg bg-opacity-40 p-4">
                    <div class="font-bold text-red">
                        Thalassemia Minor
                    </div>
                    <p class="text-sm text-red">
                        Tidak memerlukan pengobatan dan transfusi darah
                    </p>
                </div>
            </div>

            <p class="text-center font-bold text-red mt-8">
                Sistem Pakar Screening Penyakit Thalassemia merupakan sebuah platform berbasis website yang
                berfungsi untuk melakukan screening terhadap penyakit Thalassemia agar dapat terdeteksi secara dini.
            </p>

            @auth
                <button
                    class="screening-btn txtshdw-2 font-bold text-center hover:opacity-60 shadow-md text-red p-4 rounded-xl bg-orange w-fit mx-auto mt-4">
                    @if (Auth::user()->screening_status == '1')
                        RIWAYAT SCREENING
                    @else
                        SCREENING SEKARANG
                    @endif
                </button>
            @else
            @endauth
        </div>
    </main>
@endsection

@push('scripts')
    @guest
        <script>
            const screeningBtns = document.querySelectorAll(".screening-btn")
            screeningBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    window.location.href = "{{ route('login') }}";
                })
            })
        </script>
    @else
        <script>
            const screeningBtns = document.querySelectorAll(".screening-btn")

            screeningBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    if ("{{ Auth::user()->screening_status }}" == 1) {
                        window.location.href = "{{ route('riwayat') }}"
                    } else {
                        Swal.fire({
                            title: "Pertanyaan Pra-screening",
                            text: "Screening penyakit Thalassemia memerlukan informasi mengenai riwayat kesehatan keluarga. Apakah Anda memiliki anggota keluarga dengan riwayat penyakit Thalassemia?",
                            showDenyButton: true,
                            confirmButtonText: 'Ya',
                            denyButtonText: `Tidak`,
                            reverseButtons: true,
                            customClass: {
                                confirmButton: 'text-base px-6 py-2 font-bold text-white bg-blue-600 rounded-full',
                                denyButton: 'text-base px-6 py-2 font-bold text-white bg-red rounded-full',
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('screening') }}"
                            } else if (result.isDenied) {
                                window.location.href = "{{ route('result', ['hasil' => 'normal']) }}"
                            }
                        })
                    }
                })
            });
        </script>
    @endguest
@endpush
