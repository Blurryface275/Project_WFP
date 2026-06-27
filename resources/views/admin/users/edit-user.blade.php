@extends('layouts.admincoreui-app')
@section('title', 'Edit User - VitaGuard')

@section('content-admin')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Edit Data User</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.edit', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti password">
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doctor" {{ $user->role == 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Photo Profile</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    @if($user->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $user->photo) }}" width="100" class="rounded border">
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                    <a href="{{ route('admin.kelolaUser') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection