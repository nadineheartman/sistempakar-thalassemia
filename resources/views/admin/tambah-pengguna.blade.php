@extends('components.layout', ['noButton' => true])

@section('content')
    <main class="py-8 mb-8">
        <div class="container px-4 flex flex-col items-center justify-center h-full  gap-10">
            <h1 class="text-center login !text-3xl">REGISTRASI AKUN</h1>
            <div class="max-w-[800px] w-full rounded-[12px] bg-white bg-opacity-70 px-10 py-10 grid md:grid-cols-2">
                <div class="flex flex-col items-center justify-center">
                    <form method="POST" action="{{ route('admin.pengguna.store') }}" class="w-full flex flex-col gap-4 items-center">
                        @csrf
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Nama</label>
                            <input name="name" type="text" placeholder="Masukkan nama" class="input mx-auto w-full">
                            @error('name')
                                <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Email</label>
                            <input name="email" type="email" placeholder="Masukkan email" class="input mx-auto w-full">
                            @error('email')
                                <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Password</label>
                            <input name="password" type="password" placeholder="Masukkan password" class="input mx-auto w-full">
                            @error('password')
                                <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" placeholder="Masukkan konfirmasi password"
                                class="input mx-auto w-full">
                            @error('password_confirmation')
                                <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="mt-8 btn w-fit text-white px-10">DAFTAR</button>

                        {{-- <p class="tracking-widest text-orange">
                            Sudah memiliki akun?
                            <a href="{{ route('login') }}" class="font-bold underline">Login Sekarang</a>
                        </p> --}}
                    </form>
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/images/darah.png') }}" class="object-cover" style="height:200px">
                </div>
            </div>
        </div>
    </main>
@endsection
