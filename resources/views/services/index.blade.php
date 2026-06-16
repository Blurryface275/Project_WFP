@extends('layouts.member-app')
@section('title','Layanan - VitaGuard')
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Our services</span>
          <h1 class="text-capitalize mb-5 text-lg">What We Do</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Our services</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section service-2">
	<div class="container">
		<div class="row">
            @php
                $serviceImages = ['service-1.jpg', 'service-2.jpg', 'service-3.jpg', 'service-4.jpg', 'service-6.jpg', 'service-8.jpg'];
            @endphp
        @foreach ($services as $service)
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-block mb-5">
					<img src="{{ asset('images/service/' . $serviceImages[$loop->index % count($serviceImages)]) }}" alt="" class="img-fluid">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">{{$service->service_name}}</h4>
						<p class="mb-4">{{$service->description}}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="h5 title-color mb-0">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            @if($service->availability)
                                <span class="badge badge-success px-3 py-2">Tersedia</span>
                            @else
                                <span class="badge badge-danger px-3 py-2">Tidak Tersedia</span>
                            @endif
                        </div>
                        <p>Jam layanan : {{ $service->availability }}</p>
					</div>
				</div>
			</div>
        @endforeach
		</div>

	</div>
</section>
<section class="section cta-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<div class="cta-content">
					<div class="divider mb-4"></div>
					<h2 class="mb-5 text-lg">We are pleased to offer you the <span class="title-color">chance to have the healthy</span></h2>
					<a href="{{route('doctors.schedule')}}" class="btn btn-main-2 btn-round-full">Get appoinment<i class="icofont-simple-right  ml-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
