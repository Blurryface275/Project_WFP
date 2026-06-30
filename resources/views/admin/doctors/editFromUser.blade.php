@extends('layouts.admincoreui-app')
@section('title', 'Tambah User - VitaGuard')
@section('content-admin')
<h2>Lengkapi Data Dokter: {{ $user->name }}</h2>
<form method="POST" action="{{ route('doctors.update', $data->id) }}">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <label for="doctor_name">Doctor Name</label>
        <input type="text" name="name" id="name" class="form-control" 
               placeholder="Enter doctor name" value="{{ $data->name }}" required>
        <small class="form-text text-muted">Please write down Doctor Name here.</small>
    </div>

    <div class="form-group mb-3">
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization" id="specialization" class="form-control" 
               placeholder="Enter specialization" value="{{ $data->specialization }}" required>
        <small class="form-text text-muted">Please write down Doctor Specialization here.</small>
    </div>

    <div class="form-group mb-3">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" id="phone" class="form-control" 
               placeholder="Enter phone number" value="{{ $data->phone_number }}" required>
        <small class="form-text text-muted">Please write down Doctor Phone Number here.</small>
    </div>

    <div class="form-group mb-3">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" class="form-control" 
               placeholder="Enter email address" value="{{ $data->email }}" required>
        <small class="form-text text-muted">Please write down Doctor Email Address here.</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection