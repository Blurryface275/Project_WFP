@extends('layout.app')

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
          {{-- paste sidebar dari blog-sidebar.html di sini --}}
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
