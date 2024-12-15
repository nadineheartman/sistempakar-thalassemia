@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Penyakit</h1>
            <div class="mt-10">
                <a href="{{ route('admin.penyakit.create') }}" class="text-lg btn font-bold block w-fit mb-10">TAMBAH
                    PENYAKIT</a>
                <table class="w-full text-left text-neutral-500 rounded-md overflow-hidden">
                    <thead class="text-sm uppercase bg-red text-cream">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Peyakit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Peyakit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyakits as $item)
                            <tr class="border-[1px] border-orange default-text">
                                <td class="text-center border-[1px] border-orange px-3">{{ $item->id }}</td>
                                <td class="border-[1px] border-orange px-3">
                                    {{ 'P' . str_pad($item->kodepenyakit, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="border-[1px] border-orange px-3">{{ $item->namapenyakit }}</td>
                                <td class="border-[1px] border-orange px-3">
                                    <div class="flex gap-4 items-center py-3 w-full justify-center">
                                        <a href="{{ route('admin.penyakit.edit', $item->id) }}" class="btn">Ubah</a>
                                        <form action="{{ route('admin.penyakit.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
