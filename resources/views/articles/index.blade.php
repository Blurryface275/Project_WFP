@extends('layouts.member-app')
@section('title','VitaGuard - Artikel')
@push('styles')
<style>
    .pagination .page-link {
        font-size: 0.9rem;
        padding: 6px 12px;
    }
</style>
@endpush
@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Our blog</span>
          <h1 class="text-capitalize mb-5 text-lg">Blog articles</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Our blog</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>
<section class="section blog-wrap">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
            @foreach ($articles as $article)
                <div class="col-lg-12 col-md-12 mb-5">
                <div class="blog-item">
                    <div class="blog-thumb">
                        <img src="{{ $article->photo ? asset($article->photo) : asset('images/blog/blog-1.jpg') }}"
                            alt="{{ $article->title }}"
                            class="img-fluid"
                            onerror="this.src='{{ asset('images/blog/blog-1.jpg') }}'">
                    </div>

                    <div class="blog-item-content">
                        <div class="blog-item-meta mb-3 mt-4">
                            <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i>5 Comments</span>
                            <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i>{{$article->created_at}}</span>
                        </div>

                        <h2 class="mt-3 mb-3"><a href="{{route('articles.show', $article->id)}}">{{$article->title}}</a></h2>

                         <p class="card-text">{{ Str::limit($article->content, 100) }}</p>

                        <a href="{{route('articles.show', $article->id)}}" target="_blank" class="btn btn-main btn-icon btn-round-full">Read More <i class="icofont-simple-right ml-2"></i></a>
                    </div>
                </div>
            </div>
            @endforeach



	<div class="col-lg-12 col-md-12 mt-3">
    {{ $articles->links('vendor.pagination.custom') }}
</div>

</div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
	<div class="sidebar-widget search  mb-3 ">
		<h5>Search Here</h5>
		<form action="#" class="search-form">
			<input type="text" class="form-control" placeholder="search">
			<i class="ti-search"></i>
		</form>
	</div>


	<div class="sidebar-widget latest-post mb-3">
		<h5>Popular Posts</h5>

        <div class="py-2">
        	<span class="text-sm text-muted">03 Mar 2018</span>
            <h6 class="my-2"><a href="#">Thoughtful living in los Angeles</a></h6>
        </div>

        <div class="py-2">
       		<span class="text-sm text-muted">03 Mar 2018</span>
            <h6 class="my-2"><a href="#">Vivamus molestie gravida turpis.</a></h6>
        </div>

        <div class="py-2">
        	<span class="text-sm text-muted">03 Mar 2018</span>
            <h6 class="my-2"><a href="#">Fusce lobortis lorem at ipsum semper sagittis</a></h6>
        </div>
	</div>

	<div class="sidebar-widget tags mb-3">
		<h5 class="mb-4">Tags</h5>

		<a href="#">Doctors</a>
		<a href="#">agency</a>
		<a href="#">company</a>
		<a href="#">medicine</a>
		<a href="#">surgery</a>
		<a href="#">Marketing</a>
		<a href="#">Social Media</a>
		<a href="#">Branding</a>
		<a href="#">Laboratory</a>
	</div>


	<div class="sidebar-widget schedule-widget mb-3">
		<h5 class="mb-4">Time Schedule</h5>

		<ul class="list-unstyled">
		  <li class="d-flex justify-content-between align-items-center">
		    <span>Monday - Friday</span>
		    <span>9:00 - 17:00</span>
		  </li>
		  <li class="d-flex justify-content-between align-items-center">
		    <span>Saturday</span>
		    <span>9:00 - 16:00</span>
		  </li>
		  <li class="d-flex justify-content-between align-items-center">
		    <span>Sunday</span>
		    <span>Closed</span>
		  </li>
		</ul>

		<div class="sidebar-contatct-info mt-4">
			<p class="mb-0">Need Urgent Help?</p>
			<h3>+23-4565-65768</h3>
		</div>
	</div>

</div>
      </div>
    </div>
  </div>
</section>
@endsection
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Kesehatan - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img{
            width: 400px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4">Artikel Kesehatan</h2>
        <div class="row">

            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top"
                            src="{{ $article->photo ?? 'https://placehold.co/400x200?text=No+Image' }}"
                            alt="{{ $article->title }}" onerror="this.src='https://placehold.co/400x200?text=No+Image'">
                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Baca lebih
                                lanjut</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</body>

</html> --}}
