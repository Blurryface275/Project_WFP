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
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="blog-item mb-5 shadow-sm p-4 rounded bg-white">
          <img src="{{ $article->photo ? asset($article->photo) : asset('images/no-image.png') }}"
               alt="{{ $article->title }}" class="img-fluid mb-4">
          <p class="text-muted">Ditulis oleh: {{ $article->author->name }} &nbsp;|&nbsp; {{ $article->created_at->format('d M Y') }}</p>
          <div class="blog-item-content">
            <p>{{ $article->content }}</p>
            <a href="{{ route('articles.index') }}" class="btn btn-main btn-round-full mt-4">← Kembali</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
