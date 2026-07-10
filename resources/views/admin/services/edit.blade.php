@extends('layouts.admincoreui-app');
@section('content-admin');
    <!-- Header edit service -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Data Layanan</strong>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Edit Layanan</h5>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="service_name" class="form-label">Nama Layanan</label>
                    <input type="text" class="form-control" id="service_name" name="service_name" value="{{ $service->service_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" required>{{ $service->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="availability" class="form-label">Ketersediaan</label>
                    <input type="text" class="form-control" id="availability" name="availability" value="{{ $service->availability }}" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $service->price }}" required>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $service->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection