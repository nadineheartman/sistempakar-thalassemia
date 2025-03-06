@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Tambah {{ $name }}</h1>
            <div class="flex items-center justify-center">
                @if ($name === 'Pengguna')
                    <div class="max-w-[800px] w-full rounded-[12px] bg-white bg-opacity-70 px-10 py-10 grid md:grid-cols-2">
                        <div class="flex flex-col items-center justify-center">
                            <form action="{{ route('admin.pengguna.store') }}" method="POST"
                                class="w-full flex flex-col gap-4 items-center">
                                @csrf
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Nama</label>
                                    <input name="name" type="text" placeholder="Masukkan nama"
                                        class="input mx-auto w-full">
                                    @error('name')
                                        <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Email</label>
                                    <input name="email" type="email" placeholder="Masukkan email"
                                        class="input mx-auto w-full">
                                    @error('email')
                                        <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Password</label>
                                    <input name="password" type="password" placeholder="Masukkan password"
                                        class="input mx-auto w-full">
                                    @error('password')
                                        <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Konfirmasi Password</label>
                                    <input name="password_confirmation" type="password"
                                        placeholder="Masukkan konfirmasi password" class="input mx-auto w-full">
                                    @error('password_confirmation')
                                        <span class="text-sm mt-1 text-red text-opacity-80" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="mt-8 btn w-fit text-white px-10">TAMBAH</button>
                            </form>
                        </div>
                        <div class="flex items-center justify-center">
                            <img src="{{ asset('assets/images/darah.png') }}" class="object-cover" style="height:200px">
                        </div>
                    </div>
                @else
                    <div class="w-[500px] rounded-[60px] flex flex-col items-center justify-center">
                        @if ($name === 'Penyakit')
                            <form action="{{ route('admin.penyakit.store') }}" method="POST"
                                class="w-full flex flex-col gap-6 items-center">
                                @csrf
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Kode Penyakit</label>
                                    <input required name="kodepenyakit" type="text" placeholder="Masukkan Kode penyakit"
                                        class="input admin mx-auto">
                                </div>
                                
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Nama Penyakit</label>
                                    <input required name="namapenyakit" type="text" placeholder="Masukkan Nama penyakit"
                                        class="input admin mx-auto">
                                </div>

                                <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                            </form>
                        @elseif($name === 'Gejala')
                            <form action="{{ route('admin.gejala.store') }}" method="POST"
                                class="w-full flex flex-col gap-6 items-center">
                                @csrf
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Kode Gejala</label> 
                                    <input required name="kodegejala" type="text" placeholder="Masukkan Kode gejala"
                                        class="input admin mx-auto">
                                </div>
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Nama Gejala</label>
                                    <input required name="namagejala" type="text" placeholder="Masukkan Nama gejala"
                                        class="input admin mx-auto">
                                </div>

                                <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                            </form>
                        @else
                            <form action="{{ route('admin.pengetahuan.store') }}" method="POST"
                                class="w-full flex flex-col gap-6 items-center">
                                @csrf
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Kode Penyakit</label>
                                    <select required class="input admin mx-auto" name="penyakit_id" id="">
                                        <option value="" disabled selected>Kode Penyakit</option>
                                        @foreach ($penyakits as $penyakit)
                                            <option value="{{ $penyakit->id }}">P0{{ $penyakit->id }} -
                                                {{ $penyakit->namapenyakit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Kode Gejala</label>
                                    <select required class="input admin mx-auto" name="gejala_id" id="">
                                        <option value="" disabled selected>Kode Gejala</option>
                                        @foreach ($gejalas as $gejala)
                                            <option value="{{ $gejala->id }}">
                                                {{ 'G' . str_pad($gejala->kodegejala, 2, '0', STR_PAD_LEFT) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="w-full">
                                    <label class="text-red mb-1" for="">Nilai CF</label>
                                    <input required name="nilai_cf" type="text" placeholder="Masukkan Nilai CF"
                                        class="input admin mx-auto">
                                </div>

                                <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
