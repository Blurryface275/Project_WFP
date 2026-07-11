@extends('layouts.member-app')

@section('title', $article->title . ' - VitaGuard')

@section('content')

{{-- ambil struktur dari blog-single.html milik Novena --}}
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Artikel</span>
          <h1 class="text-capitalize mb-5 text-lg">{{ $article->title }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section blog-wrap">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="blog-item mb-5">
          <img src="{{ $article->photo ? asset($article->photo) : asset('images/no-image.png') }}"
               alt="{{ $article->title }}" class="img-fluid mb-4">
          <p class="text-muted">Ditulis oleh: {{ $article->author->name }} &nbsp;|&nbsp; {{ $article->created_at->format('d M Y') }}</p>
          <div class="blog-item-content">
            <p>{{ $article->content }}</p>
            <a href="{{ route('articles.index') }}" class="btn btn-main btn-round-full mt-4">← Kembali</a>
          </div>
        </div>
      </div>

      {{-- Sidebar dari blog-sidebar.html baris 234–331 --}}
      <div class="col-lg-4">
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                    <div class="sidebar-widget search mb-3">
              <h5>Cari Artikel</h5>
              <form action="#" class="search-form">
                  <input type="text" class="form-control" placeholder="Cari...">
                  <i class="ti-search"></i>
              </form>
          </div>
          
          <div class="sidebar-widget tags mb-3">
              <h5 class="mb-4">Kategori / Tag</h5>
              <a href="#">Kesehatan</a>
              <a href="#">Diet</a>
              <a href="#">Tips & Trik</a>
          </div>

          <div class="sidebar-widget schedule-widget mb-3">
              <h5 class="mb-4">Jam Operasional Layanan</h5>
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between align-items-center">
                  <span>Senin - Jumat</span><span>9:00 - 17:00</span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <span>Sabtu</span><span>9:00 - 16:00</span>
                </li>
              </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
