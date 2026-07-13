@extends('layouts.admincoreui-app')

@section('content-admin')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Preview Artikel: {{ $article->title }}</h4>
    </div>
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="{{ $article->photo ? asset('storage/' . $article->photo) : asset('images/no-image.png') }}" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;" alt="{{ $article->title }}">
        </div>
        <div class="d-flex text-muted mb-4 border-bottom pb-3">
            <!-- Pake nama_lengkap sesuai kolom di database -->
            <span class="me-4"><i class="cil-user"></i> Penulis: <strong>{{ $article->author->nama_lengkap ?? 'Admin' }}</strong></span>
            <span class="me-4"><i class="cil-tags"></i> Kategori: <strong>{{ $article->category->category_name ?? '-' }}</strong></span>
        </div>
        <div class="text-justify mt-3" style="line-height: 1.8;">
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection