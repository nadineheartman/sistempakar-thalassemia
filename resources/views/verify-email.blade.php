@extends('components.layout')

@section('content')
    <main class="py-14 flex items-center flex-col justify-center">
        <div class="container px-4">
            @if (session('message'))
                <div class="bg-green-100 p-3 rounded-md col-span-12 mb-5 text-green-800">{{ session('message') }}</div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 p-3 rounded-md col-span-12 mb-5 text-green-800">{{ session('success') }}</div>
            @endif
        </div>
        <section class="container px-4 py-4 flex flex-col gap-5 items-center justify-center">
            <div class="flex items-center gap-4 flex-col bg-white bg-opacity-50 py-12 px-20 rounded-md">
                <img src="https://www.pngmart.com/files/17/Verification-Logo-PNG-HD.png" alt="" width="80">
                <h1 class="text-center text-3xl font-bold text-red">Verifikasi Emailmu dulu!</h1>
                <p class="text-lg text-center">Kami sudah mengirimkan email verifikasi ke email yang terdaftar. Untuk
                    melanjutkan
                    menggunakan
                    aplikasi, silahkan verifikasi melalui email yang sudah dikirimkan</p>

                <div class="flex items-center gap-2 justify-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 flex">Keluar</button>
                    </form>
                    <form method="post" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn text-white w-fit">Kirim Ulang</button>
                    </form>
                </div>
            </div>
        </section>

    </main>
@endsection
