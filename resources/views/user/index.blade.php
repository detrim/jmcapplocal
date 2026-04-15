@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="container mt-4">

        <h4 class="mb-3">Data User</h4>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar User</span>
                @if (auth()->user()->isSuperadmin())
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">+ Tambah User</a>
                @endif
            </div>

            <div class="card-body table-responsive">
                <table id="userTable" class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            {{-- <th>Nama Pengguna</th> --}}
                            <th>Username</th>
                            {{-- <th>Email</th> --}}
                            {{-- <th>Phone</th> --}}
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $i => $user)
                            @php
                                $isSuperAdmin = $user->employee_id === auth()->user()->employee_id;
                            @endphp
                            <tr>
                                <td style="width: 30px;">{{ $i + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                {{-- <td>{{ $user->pegawai->nama ?? '-' }}</td> --}}
                                <td>{{ $user->username }}</td>
                                {{-- <td>{{ $user->email }}</td> --}}
                                {{-- <td>{{ $user->phone }}</td> --}}
                                <td style="width: 100px;">
                                    @if ($user->is_active == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Nonaktif</span>
                                    @endif
                                </td>

                                <td style="width: 200px;">
                                    <a href="{{ route('user.detail', $user->id) }}" class="btn btn-info btn-sm">detail</a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button @disabled($isSuperAdmin) class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data tidak tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="row justify-content-end ">
                    <div class="btn-sm mt-2">
                        <small>{{ $users->links('pagination::bootstrap-5') }}</small>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('user.ajax')
@endsection
