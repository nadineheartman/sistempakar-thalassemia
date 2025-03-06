@extends('components.layout')

@section('content')
    <main class="py-8">
        <div class="container px-4 flex flex-col h-full min-h-screen items-center justify-center gap-10">
            <h1 class="login text-center">HASIL SCREENING THALASSEMIA</h1>
            <input type="hidden" value="{{ $best_result->id }}" name="id_penyakit" id="id_penyakit">
            <div class="overflow-auto max-w-[90vw] w-full">
                <div class="mx-auto w-full" style="max-width: 800px">
                    <h2 class="font-bold text-red text-lg text-left">Gejala yang dialami</h2>
                    <table class="w-full mt-3 text-left text-neutral-500 rounded-md overflow-hidden">
                        <thead class="text-sm uppercase bg-red text-cream">
                            <tr class="text-center">
                                <th scope="col" class="px-3 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    Gejala
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    Nilai Keyakinan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gejalas as $key => $gejala)
                                <tr class="border-[1px] border-orange default-text">
                                    <td class="text-center border-[1px] border-orange px-3">{{ ++$key }}</td>
                                    <td class="border-[1px] border-orange px-3">{{ $gejala->namagejala }}</td>
                                    @php
                                        $optionUser = $gejala->kondisi_user;
                                        if (
                                            $gejala->namagejala === 'Transfusi darah' ||
                                            $gejala->namagejala === 'Pernah Transfusi darah?'
                                        ) {
                                            switch ($gejala->kondisi_user) {
                                                case 'Pasti':
                                                    $optionUser = 'Rutin (> 10 kali)';
                                                    break;
                                                case 'Hampir Pasti':
                                                    $optionUser = 'Sering (> 5 kali)';
                                                    break;
                                                case 'Kemungkinan Besar':
                                                    $optionUser = 'Jarang (> 3 kali)';
                                                    break;
                                                case 'Mungkin':
                                                    $optionUser = 'Pernah (< 3 kali)';
                                                    break;
                                                case 'Tidak':
                                                    $optionUser = 'Tidak pernah';
                                                    break;
                                                default:
                                                    break;
                                            }
                                        }
                                    @endphp
                                    <td class="border-[1px] border-orange px-3">{{ $optionUser }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-auto max-w-[90vw]">
                <div class="mx-auto w-full" style="max-width: 800px">
                    <h2 class="font-bold text-red text-lg text-left">Persentase Penyakit</h2>
                    <table class="mt-3 w-full text-left text-neutral-500 rounded-md overflow-hidden">
                        <thead class="text-sm uppercase bg-red text-cream">
                            <tr class="text-center">
                                <th scope="col" class="px-3 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    Nama Penyakit
                                </th>
                                <th scope="col" class="px-3 py-3">
                                    Tingkat Kepercayaan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyakits as $key => $penyakit)
                                <tr class="text-center default-text">
                                    <td scope="col" class="text-center border-[1px] border-orange px-3">
                                        {{ ++$key }}
                                    </td>
                                    <td scope="col" class="border-[1px] border-orange px-3">
                                        {{ $penyakit->namapenyakit }}
                                    </td>
                                    <td scope="col" class="border-[1px] border-orange px-3">
                                        {{ $penyakit->persen }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- <div class="flex mt-10 gap-10 items-center justify-center">
                <button class="shdw text-2xl px-10 py-4 font-bold txtshdw-2 text-red bg-red rounded-full">CETAK</button>
                <button
                    class="shdw text-2xl px-10 py-4 font-bold txtshdw-2 text-red bg-red rounded-full">SELESAI</button>
            </div> --}}
            <div class="flex gap-10 items-center justify-center">
                <button id="nextBtn"
                    class="txtshdw-2 font-bold text-center hover:opacity-60 shadow-md text-red p-4 rounded-xl bg-orange w-fit mx-auto">Lanjutkan</button>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        const nextButton = document.getElementById("nextBtn")
        const idPenyakit = document.getElementById("id_penyakit").value

        localStorage.setItem("gejala", "{{ $gejala_json }}")
        localStorage.setItem("penyakit", "{{ $penyakit_json }}")

        nextButton.addEventListener("click", () => {
            if (idPenyakit == 2) {
                Swal.fire({
                    text: "Berdasarkan atas hasil persentase screening, anda termasuk ke dalam jenis penyakit Thalassemia Mayor / Intermedia. Apakah gejala yang anda alami sudah diderita sejak bayi?",
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: `Tidak`,
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'text-base px-3 py-2 font-bold text-white bg-blue-600 rounded-full',
                        denyButton: 'text-base px-3 py-2 font-bold text-white bg-red rounded-full',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                            "{{ '/save-hasil/    ' . $hasils->id . '/' . 'Thalassemia Mayor' }}"
                    } else if (result.isDenied) {
                        window.location.href =
                            "{{ '/save-hasil/' . $hasils->id . '/' . 'Thalassemia Intermedia' }}"
                    }
                })
            } else {
                if ("{{ $hasils->nilai_akurasi }}" == 0) {
                    window.location.href =
                        "{{ '/save-hasil/' . $hasils->id . '/' . 'Normal' }}"
                } else {
                    window.location.href =
                        "{{ '/save-hasil/' . $hasils->id . '/' . 'Thalassemia Minor' }}"
                }
            }
        })
        // cek ebstResult semisal dia mayor/indtermedai nanti munculin popu kalo engga nanti langsung next aja

        // perlu tambah kolom nama penyakit di tabel hasil?? -> nanti yg dicetak dan disave ke db hasil akhir ini
    </script>
@endpush
