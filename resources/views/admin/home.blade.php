@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)] flex items-center justify-center">
        <div class="container flex flex-col items-center justify-center h-full gap-4">
            <h1 class="text-center login">ADMIN</h1>
            <div class="w-[500px] rounded-[16px] bg-red px-8 gap-6 py-6 bxshdw flex flex-col items-center justify-center">
                <a href="{{ route('admin.pengguna.index') }}"
                    class="input text-center text-red w-full text-base py-4 font-bold">PENGGUNA</a>
                <a href="{{ route('admin.penyakit.index') }}"
                    class="input text-center text-red w-full text-base py-4 font-bold">PENYAKIT</a>
                <a href="{{ route('admin.gejala.index') }}"
                    class="input text-center text-red w-full text-base py-4 font-bold">GEJALA</a>
                <a href="{{ route('admin.pengetahuan.index') }}"
                    class="input text-center text-red w-full text-base py-4 font-bold">BASIS
                    PENGETAHUAN</a>
            </div>
        </div>
    </main>
@endsection
