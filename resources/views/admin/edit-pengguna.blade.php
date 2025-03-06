@extends('components.layout-admin')

@section('content')
    <main class="py-8 min-h-[calc(100vh-120px)]">
        <div class="container flex flex-col h-full gap-10">
            <h1 class="text-center login">Edit Pengguna</h1>
            <div class="mt-10 flex items-center justify-center">
                <div class="w-[500px] rounded-[60px] flex flex-col items-center justify-center">
                    <form action="{{ route('admin.pengguna.update', $pengguna->id) }}" method="POST"
                        class="w-full flex flex-col gap-6 items-center">
                        @csrf
                        @method('PUT')
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Nama</label>
                            <input value="{{ $pengguna->name }}" required name="name" type="text" placeholder="Nama"
                                class="input admin mx-auto">
                            </div>
                            <div class="w-full">
                                <label class="text-red mb-1" for="">Email</label>
                                <input value="{{ $pengguna->email }}" required name="email" type="email" placeholder="Email"
                                    class="input admin mx-auto">
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Role</label>
                            <input value="{{ $pengguna->role ?? 'user' }}" required name="role" type="text"
                                placeholder="Role" class="input admin mx-auto">
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Password</label>
                            <input required name="password" type="password" placeholder="Password" class="input admin mx-auto">
                        </div>
                        <div class="w-full">
                            <label class="text-red mb-1" for="">Konfirmasi Password</label>
                            <input required name="confirm_password" type="password" placeholder="Confirm Password"
                                class="input admin mx-auto">
                        </div>

                        <button class="mt-8 btn text-xl px-12 py-4">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
