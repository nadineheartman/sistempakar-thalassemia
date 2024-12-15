@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Edit Penyakit</h1>
            <div class="mt-10 flex items-center justify-center">
                <div class="w-[500px] rounded-[60px] flex flex-col items-center justify-center">
                    <form action="{{ route('admin.penyakit.update', $penyakit->id) }}" method="POST"
                        class="w-full flex flex-col gap-6 items-center">
                        @csrf
                        @method('PUT')
                        <input required value="P0{{ $penyakit->kodepenyakit }}" name="kodepenyakit" type="text"
                            placeholder="Kode penyakit" class="input admin mx-auto">
                        <input required value="{{ $penyakit->namapenyakit }}" name="namapenyakit" type="text"
                            placeholder="Nama penyakit" class="input admin mx-auto">

                        <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
