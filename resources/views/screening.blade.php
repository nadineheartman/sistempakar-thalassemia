@extends('components.layout')

@section('content')
    <main class="py-8">
        <div class="container px-4 flex flex-col h-full min-h-screen items-start justify-center gap-5">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-8">
                    <h1 class="text-xl text-red txtshdw-2 font-semibold">SCREENING THALASSEMIA</h1>
                    <p class="text-lg text-red font-bold txtshdw mt-4">PERHATIAN!</p>
                    <p class="text-red txtshdw-2 mt-2">
                        Silahkan menjawab pertanyaan dengan cara memilih tingkatan kondisi yang dialami berdasarkan
                        gejala yang ada. Jika sudah, tekan tombol lihat hasil screening di bawah untuk mengetahui hasil
                        dari screening Thalassemia yang telah dilakukan. Semakin sesuai kondisi dan riwayat penyakit yang
                        anda alami dengan jawaban yang anda isi, maka hasil screening akan semakin akurat.
                    </p>
                </div>
                <div class="col-span-12 md:col-span-4 justify-center flex md:items-end md:justify-end">
                    <img src="{{ asset('assets/images/darah.png') }}" class="object-cover" style="height:160px">
                </div>
            </div>

            <form class="py-4 flex flex-col w-full" action="{{ route('hasil_konsultasi') }}" method="POST">
                @csrf
                @foreach ($gejalas as $idx => $gejala)
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div>
                        @if (Str::contains($gejala->namagejala, 'Transfusi'))
                            <p class="text-red">Apakah Anda pernah melakukan
                                <strong>{{ $gejala->namagejala }}</strong> ? (selain karena kecelakaan, operasi dan
                                melahirkan)
                            </p>
                            <div class="flex flex-col gap-2 mt-2">
                                @php
                                    $kondisiTransfusi = collect([
                                        (object) ['id' => '1', 'kondisi' => 'Rutin (> 10 kali)'],
                                        (object) ['id' => '2', 'kondisi' => 'Sering (> 5 kali)'],
                                        (object) ['id' => '3', 'kondisi' => 'Jarang (> 3 kali)'],
                                        (object) ['id' => '4', 'kondisi' => 'Pernah (< 3 kali)'],
                                        (object) ['id' => '5', 'kondisi' => 'Tidak pernah'],
                                    ]);
                                @endphp
                                @foreach ($kondisiTransfusi as $index => $kondisi)
                                    <div class="flex gap-2 items-center text-red ml-4 !text-base">
                                        <input required type="radio" name="kondisi[{{ $idx }}]"
                                            value="{{ $gejala->kodegejala }}_{{ $kondisi->id }}"
                                            id="kondisi-{{ $idx }}-{{ $index }}">
                                        <label
                                            for="kondisi-{{ $idx }}-{{ $index }}">{{ $kondisi->kondisi }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-red">Seberapa yakin anda merasakan gejala
                                <strong>{{ $gejala->namagejala }}</strong> ?
                            </p>
                            <div class="flex flex-col gap-2 mt-2">
                                @foreach ($kondisis as $index => $kondisi)
                                    <div class="flex gap-2 items-center text-red ml-4 !text-base">
                                        <input required type="radio" name="kondisi[{{ $idx }}]"
                                            value="{{ $gejala->kodegejala }}_{{ $kondisi->id }}"
                                            id="kondisi-{{ $idx }}-{{ $index }}">
                                        <label
                                            for="kondisi-{{ $idx }}-{{ $index }}">{{ $kondisi->kondisi }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
                <button type="submit"
                    class="txtshdw-2 mt-10 font-bold text-center hover:opacity-60 shadow-md text-red p-4 rounded-xl bg-orange w-fit mx-auto">SELESAI</button>
            </form>

        </div>
    </main>
@endsection
