@extends('layouts.admincoreui-app')

@section('title', 'Data Dokter - VitaGuard')

@section('page-title', 'Kelola Data Dokter')

@section('content-admin')
<div class="container-fluid">
    <div class="fade-in">
        {{-- Di sini kita hilangkan max-width, jadinya card akan melebar penuh 100% mengikuti kontainer --}}
        <div class="card w-100">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span class="font-weight-bold" style="font-size: 1.1rem;">Tambah Dokter Baru</span>
                <a href="{{ route('doctor.list') }}" class="btn btn-sm btn-light">
                    Kembali ke Daftar
                </a>
            </div>
            
            <form method="POST" action="{{ route('doctors.store') }}">
                @csrf
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="name" class="form-label font-weight-bold">Nama Dokter</label>
                        <input type="text" name="name" id="name" 
                            class="form-control @error('name') is-invalid @enderror" 
                            value="{{ old('name') }}" placeholder="Masukkan nama lengkap dokter beserta gelar" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="specialization" class="form-label font-weight-bold">Spesialisasi</label>
                        <input type="text" name="specialization" id="specialization" 
                            class="form-control @error('specialization') is-invalid @enderror" 
                            value="{{ old('specialization') }}" placeholder="Contoh: Spesialis Anak, Kandungan, Umum" required>
                        @error('specialization')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="experience_years" class="form-label font-weight-bold">Pengalaman Kerja (Tahun)</label>
                        <input type="number" name="experience_years" id="experience_years" 
                            class="form-control @error('experience_years') is-invalid @enderror" 
                            value="{{ old('experience_years') }}" min="0" placeholder="Contoh: 5" required>
                        @error('experience_years')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone_number" class="form-label font-weight-bold">Nomor Telepon</label>
                        <input type="text" name="phone_number" id="phone_number" 
                            class="form-control @error('phone_number') is-invalid @enderror" 
                            value="{{ old('phone_number') }}" placeholder="Contoh: 081234567890" required>
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label font-weight-bold">Email Dokter</label>
                        <input type="email" name="email" id="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" placeholder="Contoh: dokter@vitaguard.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                
                <div class="card-footer d-flex justify-content-end" style="gap: 10px;">
                    <button type="reset" class="btn btn-secondary text-white">Reset Form</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Dokter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection