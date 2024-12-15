@extends('components.layout', ['authVar' => true])

@push('styles')
    <link rel="stylesheet" href="css/login.css">
@endpush

@section('content')
    <main class="flex items-center justify-center">
        <div class="container !m-0 flex flex-col items-center justify-center h-full gap-10 px-4">
            <div class="container-login !min-h-[80vh]">
                <div class="flex p-4 rounded-lg mt-20 bg-white bg-opacity-80 !w-full max-w-[600px]">
                    <form action="{{ route('password.email') }}" method="POST"
                        class="w-full flex flex-col gap-2 items-center">
                        @csrf
                        <h1 class="text-3xl font-bold text-orange">Forgot Password</h1>
                        <p class="text-lg text-slate-700">Sistem Pakar Thalassemia</p>
                        <p class="mt-7 text-orange">Silahkan tulis emailmu di sini untuk mengirimkan link untuk mereset
                            password</p>
                        @if ($message = Session::get('error'))
                            <div
                                class="alert alert-danger alert-block mt-5 w-full p-2 text-gray-900 bg-rose-100 rounded-md">
                                {{ $message }}
                            </div>
                        @endif
                        <label class="text-slate-500 mt-4" for="">Email </label>
                        <input required name="email" class="input" type="email" placeholder="Email">
                        @if (session('status'))
                            <div class="bg-green-100 p-3 mt-5 rounded-md col-span-12 mb-5 text-green-800">
                                {{ session('status') }}</div>
                        @endif
                        @if (session('message'))
                            <div class="bg-green-100 p-3 mt-5 rounded-md col-span-12 mb-5 text-green-800">
                                {{ session('message') }}</div>
                        @endif
                        <button class="btn text-white mt-4 w-full">Kirim Email</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
