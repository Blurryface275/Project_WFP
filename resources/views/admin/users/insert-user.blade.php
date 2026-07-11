@extends('layouts.admincoreui-app')
@section('title', 'Tambah User - VitaGuard')

@section('content-admin')
    <div class="container">
        <h2>Insert Data User</h2>
        <p>Admin dapat Insert Data User</p>
        <form action="{{ route('admin.kelolaUser.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="member">Member</option>
                    <option value="doctor">Doctor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Photo Profile</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <a href="{{ route('admin.kelolaUser') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection