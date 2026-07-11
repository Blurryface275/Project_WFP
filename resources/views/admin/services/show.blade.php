@extends('layouts.admincoreui-app')

@section('content-admin')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Detail Layanan: {{ $service->service_name }}</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                <tr><th width="25%">Kategori</th><td>{{ $service->category->category_name ?? '-' }}</td></tr>
                <tr><th>Harga</th><td class="text-success font-weight-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</td></tr>
                <tr><th>Ketersediaan</th><td>{{ $service->availability }}</td></tr>
                <tr><th>Deskripsi</th><td>{!! nl2br(e($service->description)) !!}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning text-white">Edit</a>
    </div>
</div>
@endsection