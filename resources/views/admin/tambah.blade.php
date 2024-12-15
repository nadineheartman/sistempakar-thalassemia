@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Tambah {{ $name }}</h1>
            <div class="mt-10 flex items-center justify-center">
                <div class="w-[500px] rounded-[60px] flex flex-col items-center justify-center">
                    @if ($name === 'Pengguna')
                        <form action="{{ route('admin.pengguna.store') }}" method="POST"
                            class="w-full flex flex-col gap-6 items-center">
                            @csrf
                            <input required name="name" type="text" placeholder="Nama" class="input admin mx-auto">
                            <input required name="email" type="email" placeholder="Email" class="input admin mx-auto">
                            <input required name="role" type="text" placeholder="Role" class="input admin mx-auto">
                            <input required name="password" type="password" placeholder="Password"
                                class="input admin mx-auto">
                            <input required name="confirm_password" type="password" placeholder="Confirm Password"
                                class="input admin mx-auto">

                            <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                        </form>
                    @elseif($name === 'Penyakit')
                        <form action="{{ route('admin.penyakit.store') }}" method="POST"
                            class="w-full flex flex-col gap-6 items-center">
                            @csrf
                            <input required name="kodepenyakit" type="text" placeholder="Kode penyakit"
                                class="input admin mx-auto">
                            <input required name="namapenyakit" type="text" placeholder="Nama penyakit"
                                class="input admin mx-auto">

                            <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                        </form>
                    @elseif($name === 'Gejala')
                        <form action="{{ route('admin.gejala.store') }}" method="POST"
                            class="w-full flex flex-col gap-6 items-center">
                            @csrf
                            <input required name="kodegejala" type="text" placeholder="Kode gejala"
                                class="input admin mx-auto">
                            <input required name="namagejala" type="text" placeholder="Nama gejala"
                                class="input admin mx-auto">

                            <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                        </form>
                    @else
                        <form action="{{ route('admin.pengetahuan.store') }}" method="POST"
                            class="w-full flex flex-col gap-6 items-center">
                            @csrf
                            <select required class="input admin mx-auto" name="penyakit_id" id="">
                                <option value="" disabled selected>Kode Penyakit</option>
                                @foreach ($penyakits as $penyakit)
                                    <option value="{{ $penyakit->id }}">P0{{ $penyakit->id }} -
                                        {{ $penyakit->namapenyakit }}</option>
                                @endforeach
                            </select>
                            <select required class="input admin mx-auto" name="gejala_id" id="">
                                <option value="" disabled selected>Kode Gejala</option>
                                @foreach ($gejalas as $gejala)
                                    <option value="{{ $gejala->id }}">{{ 'G' . str_pad($gejala->kodegejala, 2, '0', STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                            <input required name="nilai_cf" type="text" placeholder="Nilai CF"
                                class="input admin mx-auto">

                            <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
