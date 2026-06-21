<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'VitaGuard')</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icofont/icofont.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/slick-carousel/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/slick-carousel/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  @stack('styles')
</head>

<body id="top">

<header>
  <div class="header-top-bar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <ul class="top-bar-info list-inline-item pl-0 mb-0">
            <li class="list-inline-item"><a href="mailto:support@klinik.com"><i class="icofont-support-faq mr-2"></i>support@klinik.com</a></li>
            <li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>Jl. Kesehatan No. 1, Jakarta</li>
          </ul>
        </div>
        <div class="col-lg-6">
          <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
            <a href="tel:+62-21-1234567">
              <span>Hubungi Kami : </span>
              <span class="h4">021-1234567</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navigation" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/welcome') }}">
        <span style="font-size: 1.5rem; font-weight: bold; color: #1a1a2e;">VitaGuard</span>
    </a>


      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
        aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icofont-navigation-menu"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarmain">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ request()->is('welcome') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/welcome') }}">Home</a>
          </li>
          <li class="nav-item {{ request()->is('services*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('services.index') }}">Layanan</a>
          </li>
          <li class="nav-item dropdown {{ request()->is('doctors*') ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" href="{{ route('doctors.index') }}" id="dropdown03"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dokter <i class="icofont-thin-down"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown03">
              <li><a class="dropdown-item" href="{{ route('doctors.index') }}">Daftar Dokter</a></li>
              <li><a class="dropdown-item" href="{{ route('doctors.schedule') }}">Jadwal Dokter</a></li>
            </ul>
          </li>
          <li class="nav-item {{ request()->is('articles*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('articles.index') }}">Artikel</a>
          </li>
          <li class="nav-item {{ request()->is('categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">Kategori Layanan</a> 
          </li>
          <!-- divider vertical -->
          <li class="nav-item">
            <span class="nav-link" style="color: #adb5bd;">|</span>
          </li>
          <!-- Section profile dan logout -->
           @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownAuth" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownAuth">
              <li><a class="dropdown-item" href="profile.index">Profile Kamu</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <!-- Karena pakai route::get('logout') jadi gausah form, langsung aja pake link <a> biasa -->
                     <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                      <i class="icofont-logout mr-2"></i>Logout
                  </a>
              </li>
            </ul>
          </li>
          @else
          {{-- Jika pengunjung belum punya sesi Login (Tamu) --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li> 
          <li class="nav-item d-flex align-items-center">
            <a class="btn btn-main-2 btn-round-full ml-2" href="{{ route('register') }}" style="padding: 8px 20px line-height: 1.5;">Register</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
</header>

@yield('content')

<footer class="footer section gray-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mr-auto col-sm-6">
        <div class="widget mb-5 mb-lg-0">
          <div class="logo mb-4">
            <img src="{{ asset('images/logo-vitaguard-transparent.png') }}" alt="Klinik Sehat" class="img-fluid">
          </div>
          <p>Kami memberikan pelayanan kesehatan terbaik dengan tenaga medis profesional dan berpengalaman.</p>
          <ul class="list-inline footer-socials mt-4">
            <li class="list-inline-item"><a href="#!"><i class="icofont-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#!"><i class="icofont-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#!"><i class="icofont-linkedin"></i></a></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="widget mb-5 mb-lg-0">
          <h4 class="text-capitalize mb-3">Layanan</h4>
          <div class="divider mb-4"></div>
          <ul class="list-unstyled footer-menu lh-35">
            <li><a href="{{ route('services.index') }}">Semua Layanan</a></li>
            <li><a href="{{ route('doctors.index') }}">Daftar Dokter</a></li>
            <li><a href="{{ route('doctors.schedule') }}">Jadwal Dokter</a></li>
            <li><a href="{{ route('articles.index') }}">Artikel Kesehatan</a></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 col-sm-6">
        <div class="widget mb-5 mb-lg-0">
          <h4 class="text-capitalize mb-3">Informasi</h4>
          <div class="divider mb-4"></div>
          <ul class="list-unstyled footer-menu lh-35">
            <li><a href="#!">Tentang Kami</a></li>
            <li><a href="#!">Kebijakan Privasi</a></li>
            <li><a href="#!">Syarat & Ketentuan</a></li>
            <li><a href="#!">FAQ</a></li>
          </ul>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget widget-contact mb-5 mb-lg-0">
          <h4 class="text-capitalize mb-3">Hubungi Kami</h4>
          <div class="divider mb-4"></div>
          <div class="footer-contact-block mb-4">
            <div class="icon d-flex align-items-center">
              <i class="icofont-email mr-3"></i>
              <span class="h6 mb-0">Dukungan 24/7</span>
            </div>
            <h4 class="mt-2"><a href="mailto:support@klinik.com">support@klinik.com</a></h4>
          </div>
          <div class="footer-contact-block">
            <div class="icon d-flex align-items-center">
              <i class="icofont-support mr-3"></i>
              <span class="h6 mb-0">Senin - Jumat : 08:00 - 18:00</span>
            </div>
            <h4 class="mt-2"><a href="tel:+62-21-1234567">021-1234567</a></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-btm py-4 mt-5">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="copyright">
            Copyright &copy; {{ date('Y') }} Klinik Sehat. All rights reserved.
          </div>
        </div>
        <div class="col-lg-6">
          <div class="subscribe-form text-lg-right mt-5 mt-lg-0">
            <form action="#" class="subscribe">
              <input type="text" class="form-control" placeholder="Alamat Email Anda" required>
              <button type="submit" class="btn btn-main-2 btn-round-full">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <a class="backtop scroll-top-to" href="#top">
            <i class="icofont-long-arrow-up"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugins/shuffle/shuffle.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

@stack('scripts')

</body>
</html>
