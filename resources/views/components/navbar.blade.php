{{-- Navbar --}}
<header class="bg-[#A84448] px-8 py-4 sticky top-0">
    <nav class="container flex justify-between items-center">
        <a style="color: #F6E1C3" class="text-decoration-none font-bold flex items-center gap-2 text-cream"
            href="{{ route('home') }}">
            <img width="40" src="/assets/images/logo.svg" alt="Logo">
            Sistem Pakar Thalassemia
        </a>
        <div class="flex gap-12 {{ $noButton ? 'hidden' : '' }}">
            @auth
                {{-- <a style="color: #F6E1C3" class="text-decoration-none font-bold text-lg text-cream screening-btn"
                    href="#">Screening</a> --}}

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="color: #F6E1C3"
                        class="text-decoration-none font-bold text-lg text-cream">Logout</button>
                </form>
            @else
                <a style="color: #F6E1C3" class="text-decoration-none font-bold text-lg text-cream"
                    href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>
</header>

@push('scripts')
    @guest
        <script>
            const screeningBtns2 = document.querySelectorAll(".screening-btn")
            screeningBtns2.forEach(btn => {
                btn.addEventListener("click", () => {
                    window.location.href = "{{ route('login') }}";
                })
            })
        </script>
    @else
        <script>
            const screeningBtns2 = document.querySelectorAll(".screening-btn")

            screeningBtns2.forEach(btn => {
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
