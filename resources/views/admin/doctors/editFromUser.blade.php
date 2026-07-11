@extends('layouts.admincoreui-app')
@section('title', 'Tambah User - VitaGuard')
@section('content-admin')
    <h2>Lengkapi Data Dokter: {{ $user->name }}</h2>
    <form method="POST" action="{{ route('admin.doctors.updateFromUser', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Doctor Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter doctor name"
                value="{{ old('name', optional($doctor)->name ?? $user->name) }}" required>
            <small class="form-text text-muted">Please write down Doctor Name here.</small>
        </div>

        <div class="form-group mb-3">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" id="specialization" class="form-control"
                placeholder="Enter specialization" value="{{ old('specialization', optional($doctor)->specialization) }}"
                required>
            <small class="form-text text-muted">Please write down Doctor Specialization here.</small>
        </div>

        <div class="form-group mb-3">
            <label for="experience_years">Experience (years)</label>
            <input type="text" name="experience_years" id="experience_years" class="form-control"
                placeholder="Enter years of experience"
                value="{{ old('experience_years', optional($doctor)->experience_years) }}" required>
            <small class="form-text text-muted">Please write down Doctor's years of experience here.</small>
        </div>

        <div class="form-group mb-3">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Enter phone number"
                value="{{ old('phone_number', optional($doctor)->phone_number) }}" required>
            <small class="form-text text-muted">Please write down Doctor Phone Number here.</small>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address"
                value="{{ old('email', optional($doctor)->email ?? $user->email) }}" required>
            <small class="form-text text-muted">Please write down Doctor Email Address here.</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection