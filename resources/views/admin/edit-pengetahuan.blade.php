@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Edit Pengetahuan</h1>
            <div class="mt-10 flex items-center justify-center">
                <div class="w-[500px] rounded-[60px] flex flex-col items-center justify-center">
                    <form action="{{ route('admin.pengetahuan.update', $pengetahuan->id) }}" method="POST"
                        class="w-full flex flex-col gap-6 items-center">
                        @csrf
                        @method('PUT')
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Kode Penyakit</label>
                            <select required class="input admin mx-auto" name="penyakit_id" id="">
                                <option value="" disabled>Kode Penyakit</option>
                                @foreach ($penyakits as $penyakit)
                                    <option {{ $penyakit->id === $pengetahuan->penyakit->id ? 'selected' : '' }}
                                        value="{{ $penyakit->id }}">P0{{ $penyakit->id }} -
                                        {{ $penyakit->namapenyakit }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full">
                            <label class="text-red mb-1" for="">Kode Gejala</label>
                            <select required class="input admin mx-auto" name="gejala_id" id="">
                                <option value="" disabled>Kode Gejala</option>
                                @foreach ($gejalas as $gejala)
                                    <option {{ $gejala->id === $pengetahuan->gejala->id ? 'selected' : '' }}
                                        value="{{ $gejala->id }}">
                                        {{ 'G' . str_pad($gejala->kodegejala, 2, '0', STR_PAD_LEFT) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full">
                            <label class="text-red mb-1" for="">Kode Penyakit</label>
                            <input value="{{ $pengetahuan->nilai_cf }}" required name="nilai_cf" type="text"
                                placeholder="Nilai CF" class="input admin mx-auto">
                        </div>

                        <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
