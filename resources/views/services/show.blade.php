@extends('layouts.member-app')

@section('title', 'Layanan: ' . $service->service_name . ' - VitaGuard')

@section('content')
<!-- Header judul halaman -->
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Detail Layanan</span>
          <h1 class="text-capitalize mb-5 text-lg">{{ $service->service_name }}</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section service-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="service-block mb-5">
          <!-- Gambar dummy untuk layanan-->
          <img src="{{ asset('images/service/service-2.jpg') }}" alt="{{ $service->service_name }}" class="img-fluid rounded mb-4" onerror="this.src='{{ asset('images/service/service-1.jpg') }}'">
          
          <div class="content">
            <h2 class="mt-4 mb-2 title-color">{{ $service->service_name }}</h2>
            
            <!-- Badge punya kategori dan status -->
            <div class="d-flex align-items-center mb-4">
                <!-- Nampilin nama kategori -->
                <span class="badge badge-info px-3 py-2 mr-3"><i class="icofont-tags mr-1"></i> {{ $service->category->category_name ?? 'Umum' }}</span>
                
                <!-- Cek status ketersediaan layanannya -->
                @if(strtolower($service->availability) == 'tersedia')
                    <span class="badge badge-success px-3 py-2"><i class="icofont-check-circled mr-1"></i> Tersedia</span>
                @else
                    <span class="badge badge-danger px-3 py-2"><i class="icofont-close-circled mr-1"></i> {{ $service->availability }}</span>
                @endif
            </div>
            
            <!-- Deskripsi dari database -->
            <p class="mb-4 text-justify" style="line-height: 1.8; font-size: 1.1rem;">
                {{ $service->description }}
            </p>
            
            <!-- Kotak rincian biaya -->
            <div class="alert alert-primary mt-4 p-4 d-flex justify-content-between align-items-center rounded shadow-sm">
                <h4 class="mb-0 text-primary">Biaya Layanan</h4>
                <h4 class="mb-0 text-primary">Rp {{ number_format($service->price, 0, ',', '.') }}</h4>
            </div>

            <!-- Tombol interaksi -->
            <div class="mt-5">
                <a href="{{ route('doctors.schedule') }}" class="btn btn-main btn-round-full mr-2">Book Appointment <i class="icofont-simple-right ml-2"></i></a>
                <a href="{{ route('services.index') }}" class="btn btn-solid-border btn-round-full">Kembali Daftar Layanan</a>
            </div>
          </div>
        </div>
      </div>

      {{-- Sidebar Kanan --}}
      <div class="col-lg-4">
        <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
          
          <div class="sidebar-widget search mb-3">
              <h5>Cari Layanan Tambahan</h5>
              <form action="#" class="search-form">
                  <input type="text" class="form-control" placeholder="Cari...">
                  <i class="ti-search"></i>
              </form>
          </div>

          <div class="sidebar-widget schedule-widget mb-3">
              <h5 class="mb-4">Jam Operasional Kami</h5>
              <ul class="list-unstyled">
                <li class="d-flex justify-content-between align-items-center">
                  <span>Senin - Jumat</span><span>9:00 - 17:00</span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <span>Sabtu</span><span>9:00 - 16:00</span>
                </li>
                <li class="d-flex justify-content-between align-items-center">
                  <span>Minggu</span><span>Tutup / Libur</span>
                </li>
              </ul>
              
              <div class="sidebar-contatct-info mt-4">
                  <p class="mb-0">Butuh Bantuan Darurat?</p>
                  <h3>+62-8123-4567-890</h3>
              </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
