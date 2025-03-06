@extends('components.layout', ['noButton' => true])

@section('content')
    <main class="py-8 mb-8">
        <div class="container px-4 flex flex-col items-center justify-center h-full gap-10">
            <h1 class="text-center login !text-3xl">SISTEM PAKAR SCREENING THALASSEMIA</h1>
            <div class="md:max-w-[800px] w-full rounded-[12px] bg-white bg-opacity-80 px-6 py-6 grid md:grid-cols-2 gap-4">
                <div class="flex flex-col items-center justify-center">
                    <img width="60" height="60" src="{{ asset('assets/images/login.png') }}">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block mt-5 w-full p-2 text-gray-900 bg-yellow-100 rounded-md">
                            {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST" class="mt-5 w-full flex flex-col gap-6 items-center">
                        @csrf
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Email</label>
                            <input required name="email" type="email" placeholder="Masukkan email" class="input mx-auto w-full">
                            @error('email')
                                <span class="text-sm mt-1 text-white text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Password</label>
                            <input required name="password" type="password" placeholder="Masukkan password"
                                class="input mx-auto w-full">
                            @error('password')
                                <span class="text-sm mt-1 text-white text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2 items-center">
                            <button class="mt-2 btn w-fit text-white px-10">LOGIN</button>
                            <a href="{{ route('register') }}" class="text-orange font-bold">Buat Akun</a>
                            <p class="font-normal"><a class="text-slate-400 underline"
                                    href="{{ route('password.request') }}">Lupa password?</a></p>
                        </div>
                    </form>
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('assets/images/darah.png') }}" class="object-cover" style="height:200px">
                </div>
            </div>
        </div>
    </main>
@endsection
