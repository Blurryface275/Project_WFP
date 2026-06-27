@extends('layouts.admincoreui-app')
@section('title', 'Dashboard Admin - VitaGuard')
@section('content-admin')
<p class="text-muted">Menampilkan {{ $doctors->count() }} dokter tersedia</p>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead><tr><th>Foto</th><th>Nama</th><th>Spesialis</th><th>Pengalaman</th><th>Aksi</th></tr></thead>
<tbody>
@foreach($doctors as $doctor)
<tr>
<td>
@if($doctor->user && $doctor->user->photo)
<img src="{\{ asset('storage/' . $doctor->user->photo) }\}" width="50">
@else
<img src="https://ui-avatars.com/api/?name={\{ urlencode($doctor->name) }\}" width="50">
@endif
</td>
<td>{\{ $doctor->name }\}</td>
<td>{\{ $doctor->specialization }\}</td>
<td>{\{ $doctor->experience_years }\} Tahun</td>
<td><button class="btn btn-sm btn-warning">Edit</button> <button class="btn btn-sm btn-danger">Hapus</button></td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
