@extends('layouts.admin-app')

@section('title', 'Profil Dokter')
@section('page-title', 'Pengaturan Profil Anda')

@section('content')
<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="https://ui-avatars.com/api/?name=Dokter&size=300&background=e7f1ff&color=0d6efd"
                     alt="User profile picture">
                <h3 class="profile-username mt-3">Dr. Placeholder</h3>
                <p class="text-muted">Dokter Spesialis Umum</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#">Data Pribadi</a></li>
                </ul>
            </div>
            <div class="card-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" value="Dr. Placeholder" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" value="dokter@vitaguard.com" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pengalaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="5 Tahun">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); alert('Ini masih placeholder');">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
