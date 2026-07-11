@extends('layouts.member-app')
@section('title', $category->category_name . ' - Kategori Layanan')

@push('styles')
<style>
    .service-card { transition: transform 0.2s, box-shadow 0.2s; border: 1px solid #f0f0f0;}
    .service-card:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
</style>
@endpush

@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
           <h1 class="color:#fff;">Kategori: {{ $category->category_name }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container mb-5 mt-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center text-md-left">
            <h3 class="mb-3">Layanan Tersedia ({{ $category->services->count() }})</h3>
        </div>
    </div>
    <div class="row">
        @forelse($category->services as $service)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card p-4 rounded h-100 d-flex flex-column bg-white">
                    <h4 class="mb-3">{{ $service->service_name }}</h4>
                    <p class="text-muted flex-grow-1">{{ Str::limit($service->description, 90) }}</p>
                    <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary btn-sm btn-round-full w-100">Lebih Detail</a>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-warning text-center">Belum ada layanan di kategori ini.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection