@extends('layouts.member-app')

@section('title', 'Profil Saya - VitaGuard')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #0056b3, #007bff);">
                    <h4 class="mb-0 text-white">Profil Pengguna</h4>
                </div>
                <div class="card-body text-center p-5">
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger text-left">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- GAMBAR PROFIL --}}
                        <div class="mb-4">
                            @if($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profile" class="rounded-circle border border-primary shadow" width="150" height="150" style="object-fit: cover; border-width: 4px !important;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150" alt="Foto Default" class="rounded-circle border border-primary shadow" width="150" height="150" style="border-width: 4px !important;">
                            @endif
                            <div class="mt-3 text-center">
                                <label for="photo" class="btn btn-sm btn-outline-primary" style="cursor: pointer;">Ubah Foto</label>
                                <input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="this.nextElementSibling.innerText = this.files[0].name">
                                <small class="d-block text-muted mt-1"></small>
                            </div>
                        </div>
                        
                        <div class="text-left mt-4 px-lg-4">
                            <h5 class="mb-3 text-primary">Informasi Akun</h5>
                            <div class="form-group row border-bottom pb-2 mb-3">
                                <label class="col-sm-4 col-form-label text-muted">Tipe Hak Akses</label>
                                <div class="col-sm-8 pt-2">
                                    <span class="badge badge-success px-3 py-2 text-uppercase">{{ $user->role }}</span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-4 col-form-label text-muted">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label class="col-sm-4 col-form-label text-muted">Alamat Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-4 col-form-label text-muted">Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-sm-4 col-form-label text-muted">Konfirmasi Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 text-center border-top">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 text-white">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection