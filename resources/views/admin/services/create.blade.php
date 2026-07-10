@extends('layouts.admincoreui-app');
@section('content-admin');
    <!-- Header create service -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Data Layanan</strong>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Tambah Layanan</h5>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="service_name" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control" id="service_name" name="service_name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="availability" class="form-label">Ketersediaan</label>
                    <input type="text" class="form-control" id="availability" name="availability" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection