@extends('layouts.admincoreui-app')

@section('title', 'Profil Dokter')
@section('page-title', 'Pengaturan Profil Anda')

@section('content-admin')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=300&background=e7f1ff&color=0d6efd"
                     alt="User profile picture">
                <h3 class="profile-username mt-3">{{ $doctor->name }}</h3>
                <p class="text-muted">{{ $doctor->specialization }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        @if(session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#">Data Pribadi</a></li>
                </ul>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('doctor.profile.update') }}">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="inputName" value="{{ old('name', $doctor->name) }}" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="inputEmail" value="{{ old('email', $doctor->user->email) }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputSpecialization" class="col-sm-2 col-form-label">Spesialisasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="specialization" id="inputSpecialization" value="{{ old('specialization', $doctor->specialization) }}" placeholder="Spesialisasi">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone_number" id="inputPhone" value="{{ old('phone_number', $doctor->phone_number) }}" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label">Pengalaman (Tahun)</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.1" class="form-control" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
