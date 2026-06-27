@extends('layouts.admincoreui-app')
@section('title', 'Tambah User - VitaGuard')

@section('content-admin')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Tambah Data User Baru</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.insert') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
    </div>
</div>
@endsection