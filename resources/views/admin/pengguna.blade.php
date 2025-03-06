@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Pengguna</h1>
            <div class="mt-10">
                <a href="{{ route('admin.pengguna.create') }}" class="text-lg btn font-bold block w-fit mb-10">TAMBAH
                    PENGGUNA</a>
                <table class="w-full text-left text-neutral-500 rounded-md overflow-hidden">
                    <thead class="text-sm uppercase bg-red text-cream">
                        <tr class="text-center">
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status Screening
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hasil
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penggunas as $user)
                            <tr class="border-[1px] border-orange default-text">
                                <td class="text-center border-[1px] border-orange px-3">{{ $user->id }}</td>
                                <td class="border-[1px] border-orange px-3">{{ $user->name }}</td>
                                <td class="border-[1px] border-orange px-3">{{ $user->email }}</td>
                                <td class="border-[1px] border-orange px-3">
                                    @if ($user->screening_status)
                                        Sudah screening
                                    @else
                                        Belum screening
                                    @endif
                                </td>
                                <td class="border-[1px] border-orange px-3">
                                    @if (isset($user->last_result) && $user->last_result)
                                        <a class="underline" href="/hasil/{{ $user->last_result }}">
                                            {{ $user->hasil->result_penyakit ?? '' }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="border-[1px] border-orange px-3">{{ $user->role === 'admin' ? 'Admin' : 'user' }}
                                </td>
                                <td class="border-[1px] border-orange px-3">
                                    <div class="flex gap-4 items-center py-3 w-full justify-center">
                                        <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn">Ubah</a>
                                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST">
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
