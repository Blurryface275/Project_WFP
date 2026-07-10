@extends('layouts.admincoreui-app')

@section('content-admin')
<h2>Edit Kategori</h2>

@if($errors->any())
    <div class="alert alert-danger">
        Cek kembali isian form Anda.
    </div>
@endif

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="col-lg-6">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="category_name" class="form-label">Nama Kategori</label>
        <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('category_name', $category->category_name) }}" required>
        @error('category_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">Update Kategori</button>
</form>
@endsection
