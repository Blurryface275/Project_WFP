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
                    
                    {{-- FOTO AYYUB (DUMMY JIKA DATABASE TIDAK PUNYA FOTO) --}}
                    <div class="mb-4">
                        <img src="{{ asset('images/team/test-thumb2.jpg') }}" alt="Foto" class="rounded-circle border border-primary shadow" width="150" height="150" style="object-fit: cover; border-width: 4px !important;">
                    </div>
                    
                    {{-- Mencetak Variabel yang dilempar dari Controller --}}
                    <h3 class="font-weight-bold">{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->email }}</p>
                    
                    <hr class="my-4">
                    
                    <div class="text-left mt-4 px-lg-4">
                        <h5 class="mb-3 text-primary">Informasi Akun</h5>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th width="35%" class="text-muted">Nama Lengkap</th>
                                <td>: <span class="font-weight-semibold">{{ $user->name }}</span></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Alamat Email</th>
                                <td>: {{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tipe Hak Akses</th>
                                <td>: 
                                    <span class="badge badge-success px-3 py-2 text-uppercase">
                                        {{ $user->role }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-muted">Bergabung Pada</th>
                                <td>: {{ $user->created_at ? $user->created_at->format('d M Y') : 'Tidak Tercatat' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-5">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 mr-2">Kembali</a>
                        <a href="#" class="btn btn-warning px-4 text-white">Edit Profil (Segera)</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection