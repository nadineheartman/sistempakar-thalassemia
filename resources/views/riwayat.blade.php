@extends('components.layout')

@section('content')
    <main class="py-14 mb-8">
        <div class="container mx-4 flex flex-col items-center h-full min-h-screen gap-10">
            <h1 class="text-center login">RIWAYAT SCREENING</h1>

            @if (!isset($hasil))
                <p class="text-red text-2xl font-semibold">Anda belum pernah melakukan screening di sini...</p>
            @else
                <div class="flex flex-col gap-5">
                    @foreach ($hasil as $item)
                        <a href="/hasil/{{ $item->id }}"
                            class="flex items-start justify-start flex-col rounded-md border-[1px] border-tertiary hover:bg-primary bg-white px-8 py-4">
                            <p class="">
                                <b>Hasil:</b> {{ floor($item->nilai_akurasi * 100) }}%
                                {{ $item->result_penyakit }}
                            </p>
                            Tanggal test: {{ $item->created_at }}
                        </a>
                    @endforeach
                </div>
            @endif


        </div>
    </main>
@endsection
