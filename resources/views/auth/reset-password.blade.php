@extends('components.layout', ['authVar' => true])

@push('styles')
    <link rel="stylesheet" href="/css/login.css">
@endpush

@section('content')
    <main class="flex items-center justify-center">
        <div class="container !m-0 flex flex-col items-center justify-center h-full gap-10">
            <div class="container-login !min-h-[70vh]">
                <div class="flex p-4 rounded-lg mt-12 bg-white bg-opacity-80 !w-full max-w-[600px]">
                    <form action="{{ route('password.update') }}" method="POST"
                        class="w-full flex flex-col gap-2 items-center">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <h1 class="text-3xl font-bold text-orange">Reset Password</h1>
                        <p class="text-orange">Buat password baru</p>
                        @if ($message = Session::get('error'))
                            <div
                                class="alert alert-danger alert-block mt-5 w-full p-2 text-gray-900 bg-rose-100 rounded-md">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="w-full">
                            <label class="text-slate-500 mt-4 text-left" for="">Email </label>
                            <input required value="{{ app('request')->input('email') }}" name="email" class="input"
                                type="email" placeholder="Email">
                            @error('email')
                                <span class="text-sm mt-1 text-rose-600 text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="text-slate-500 mt-4 text-left" for="">Password baru</label>
                            <input required name="password" class="input" type="password" placeholder="Password">
                            @error('password')
                                <span class="text-sm mt-1 text-rose-600 text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="text-slate-500 mt-4 text-left" for="">Konfirmasi password baru</label>
                            <input required name="password_confirmation" class="input" type="password"
                                placeholder="Konfirmasi password">
                            @error('password_confirmation')
                                <span class="text-sm mt-1 text-rose-600 text-opacity-80" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        @if (session('status'))
                            <div class="bg-green-100 p-3 mt-5 rounded-md col-span-12 mb-5 text-green-800">
                                {{ session('status') }}</div>
                        @endif
                        @if (session('message'))
                            <div class="bg-green-100 p-3 mt-5 rounded-md col-span-12 mb-5 text-green-800">
                                {{ session('message') }}</div>
                        @endif
                        <button class="btn text-white mt-4 w-full">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
