@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Gejala</h1>
            <div class="mt-10">
                <a href="{{ route('admin.gejala.create') }}" class="text-lg btn font-bold block w-fit mb-10">TAMBAH GEJALA</a>
                <table class="w-full text-left text-neutral-500 rounded-md overflow-hidden">
                    <thead class="text-sm uppercase bg-red text-cream">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kode Gejala
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Gejala
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gejalas as $item)
                            <tr class="border-[1px] border-orange default-text">
                                <td class="text-center border-[1px] border-orange px-3">{{ $item->id }}</td>
                                <td class="border-[1px] border-orange px-3">
                                    {{ 'G' . str_pad($item->kodegejala, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="border-[1px] border-orange px-3">{{ $item->namagejala }}</td>
                                <td class="border-[1px] border-orange px-3">
                                    <div class="flex gap-4 items-center py-3 w-full justify-center">
                                        <a href="{{ route('admin.gejala.edit', $item->id) }}" class="btn">Ubah</a>
                                        <form action="{{ route('admin.gejala.destroy', $item->id) }}" method="POST">
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
