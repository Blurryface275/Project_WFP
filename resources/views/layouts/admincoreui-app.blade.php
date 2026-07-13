<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v5.5.0
* @link https://coreui.io/product/free-bootstrap-admin-template/
* Copyright (c) 2026 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
-->

<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>@yield('title', 'Admin Dashboard - VitaGuard')</title>
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('core-ui-admin/assets/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('core-ui-admin/assets/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('core-ui-admin/assets/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('core-ui-admin/assets/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114"
    href="{{ asset('core-ui-admin/assets/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120"
    href="{{ asset('core-ui-admin/assets/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144"
    href="{{ asset('core-ui-admin/assets/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152"
    href="{{ asset('core-ui-admin/assets/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180"
    href="{{ asset('core-ui-admin/assets/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192"
    href="{{ asset('core-ui-admin/assets/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('core-ui-admin/assets/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('core-ui-admin/assets/favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('core-ui-admin/assets/favicon/favicon-16x16.png') }}">
  <!-- <link rel="manifest" href="{{ asset('core-ui-admin/assets/favicon/manifest.json') }}"> -->
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="core-ui-admin/assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="{{ asset('core-ui-admin/vendors/simplebar/css/simplebar.css') }}">
  <link rel="stylesheet" href="{{ asset('core-ui-admin/css/vendors/simplebar.css') }}">
  <!-- Main styles for this application-->
  <link href="{{ asset('core-ui-admin/css/style.css') }}" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="{{ asset('core-ui-admin/css/examples.css') }}" rel="stylesheet">
  <script src="{{ asset('core-ui-admin/js/config.js') }}"></script>
  <script src="{{ asset('core-ui-admin/js/color-modes.js') }}"></script>
  <link href="{{ asset('core-ui-admin/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
  @stack('styles')
</head>

<body>
  <!-- NEW SIDEBAR -->
  <div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
      <div class="sidebar-brand me-auto">
        <svg role="img" aria-label="CoreUI Logo Full" class="sidebar-brand-full" width="88" height="32"
          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 312 115">
          <g style="fill: currentColor">
            <path
              d="M96 24.124 57 1.608a12 12 0 0 0-12 0L6 24.124a12.034 12.034 0 0 0-6 10.393V79.55a12.033 12.033 0 0 0 6 10.392l39 22.517a12 12 0 0 0 12 0l39-22.517a12.033 12.033 0 0 0 6-10.392V34.517a12.034 12.034 0 0 0-6-10.393ZM94 79.55a4 4 0 0 1-2 3.464l-39 22.517a4 4 0 0 1-4 0L10 83.014a4 4 0 0 1-2-3.464V34.517a4 4 0 0 1 2-3.464L49 8.536a4 4 0 0 1 4 0l39 22.517a4 4 0 0 1 2 3.464V79.55Z" />
            <path
              d="M74.022 70.071h-2.866a4 4 0 0 0-1.925.494L51.95 80.05 32 68.531V45.554l19.95-11.519 17.29 9.455a4 4 0 0 0 1.919.49h2.863a2 2 0 0 0 2-2v-2.71a2 2 0 0 0-1.04-1.756L55.793 27.02a8.04 8.04 0 0 0-7.843.09L28 38.626a8.025 8.025 0 0 0-4 6.929V68.53a8 8 0 0 0 4 6.928l19.95 11.519a8.043 8.043 0 0 0 7.843.088l19.19-10.532a2 2 0 0 0 1.038-1.753v-2.71a2 2 0 0 0-2-2Z" />
            <g transform="translate(118 33)">
              <path
                d="M50.745.428c-8.28.01-14.99 6.72-15 15v17.277c0 8.285 6.715 15 15 15 8.284 0 15-6.715 15-15V15.428c-.01-8.28-6.72-14.99-15-15Zm7 32.277a7 7 0 0 1-14 0V15.428a7 7 0 0 1 14 0v17.277ZM14.079 8.488a7.01 7.01 0 0 1 7.868 6.075.99.99 0 0 0 .984.865h6.03a1.01 1.01 0 0 0 1-1.097C29.354 6.206 22.38.046 14.243.447 6.161 1-.086 7.762 0 15.864V32.27c-.087 8.101 6.161 14.864 14.244 15.416 8.137.401 15.11-5.759 15.716-13.883a1.01 1.01 0 0 0-.999-1.098h-6.03a.99.99 0 0 0-.985.865 7.01 7.01 0 0 1-7.868 6.076A7.164 7.164 0 0 1 8 32.461V15.672a7.164 7.164 0 0 1 6.079-7.184ZM96.922 27.994a12.158 12.158 0 0 0 7.184-11.077v-3.7c0-6.71-5.44-12.15-12.149-12.15H75a1 1 0 0 0-1 1v44a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-17h6.621l7.916 17.413a1 1 0 0 0 .91.587h6.591a1 1 0 0 0 .91-1.414l-8.026-17.659Zm-.816-11.077a4.154 4.154 0 0 1-4.148 4.15h-9.852v-12h9.852a4.154 4.154 0 0 1 4.148 4.15v3.7ZM139 1.067h-26a1 1 0 0 0-1 1v44a1 1 0 0 0 1 1h26a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-19v-12h13a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1h-13v-10h19a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1ZM177 1.067h-6a1 1 0 0 0-1 1v22.647a7.007 7.007 0 1 1-14 0V2.067a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v22.647a15.003 15.003 0 1 0 30 0V2.067a1 1 0 0 0-1-1Z" />
              <rect width="8" height="38" x="186" y="1.067" rx="1" />
            </g>
          </g>
        </svg>
        <svg role="img" aria-label="CoreUI Logo Signet" class="sidebar-brand-narrow" width="88" height="32"
          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 102 115">
          <g style="fill: currentColor">
            <path
              d="M96 24.124 57 1.608a12 12 0 0 0-12 0L6 24.124a12.034 12.034 0 0 0-6 10.393V79.55a12.033 12.033 0 0 0 6 10.392l39 22.517a12 12 0 0 0 12 0l39-22.517a12.033 12.033 0 0 0 6-10.392V34.517a12.034 12.034 0 0 0-6-10.393ZM94 79.55a4 4 0 0 1-2 3.464l-39 22.517a4 4 0 0 1-4 0L10 83.014a4 4 0 0 1-2-3.464V34.517a4 4 0 0 1 2-3.464L49 8.536a4 4 0 0 1 4 0l39 22.517a4 4 0 0 1 2 3.464V79.55Z" />
            <path
              d="M74.022 70.071h-2.866a4 4 0 0 0-1.925.494L51.95 80.05 32 68.531V45.554l19.95-11.519 17.29 9.455a4 4 0 0 0 1.919.49h2.863a2 2 0 0 0 2-2v-2.71a2 2 0 0 0-1.04-1.756L55.793 27.02a8.04 8.04 0 0 0-7.843.09L28 38.626a8.025 8.025 0 0 0-4 6.929V68.53a8 8 0 0 0 4 6.928l19.95 11.519a8.043 8.043 0 0 0 7.843.088l19.19-10.532a2 2 0 0 0 1.038-1.753v-2.71a2 2 0 0 0-2-2Z" />
          </g>
        </svg>
      </div>
      <button class="btn-close d-lg-none" type="button" data-coreui-theme="dark" aria-label="Close"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
      <!-- ADMIN MENUS -->
      @if(auth()->check() && auth()->user()->role === 'admin')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)"
              d="M425.706 142.294A240 240 0 0 0 16 312v88h144v-32H48v-56c0-114.691 93.309-208 208-208s208 93.309 208 208v56H352v32h144v-88a238.43 238.43 0 0 0-70.294-169.706"
              class="ci-primary" />
            <path fill="var(--ci-primary-color, currentcolor)"
              d="M80 264h32v32H80zm160-136h32v32h-32zm-104 40h32v32h-32zm264 96h32v32h-32zm-102.778 71.1 69.2-144.173-28.85-13.848-69.183 144.135a64.141 64.141 0 1 0 28.833 13.886M256 416a32 32 0 1 1 32-32 32.036 32.036 0 0 1-32 32"
              class="ci-primary" />
          </svg>
          Dashboard
        </a>
      </li>
      <!-- USER MANAGEMENT SEGMENT -->
      <li class="nav-title">User Management System</li>
      <li class="nav-group">
        <a class="nav-link nav-group-toggle" href="#">
          <!-- <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)"
              d="m491.693 256.705-54.957-49.461 16.407-13.406a80.5 80.5 0 0 0 18.363-21.522c18.148-31.441 12.867-70.042-13.144-96.052s-64.612-31.291-96.051-13.142a80.5 80.5 0 0 0-21.52 18.362l-13.408 16.407-49.461-54.956-.579-.611a24.03 24.03 0 0 0-33.941 0l-65.6 65.605 1.19 23.7 33.108 27.056a48.6 48.6 0 0 1 11.079 12.889c10.807 18.722 7.57 41.8-8.056 57.426s-38.7 18.862-57.426 8.058a48.7 48.7 0 0 1-12.9-11.086l-27.047-33.1-23.7-1.189-71.26 71.26a24 24 0 0 0 0 33.942l175.357 175.359a80 80 0 0 0 113.138 0L492.3 291.225a24.03 24.03 0 0 0 0-33.94ZM288.657 449.617a48 48 0 0 1-67.883 0L51.069 279.911l53.1-53.095 15.91 19.473.1.119a80.5 80.5 0 0 0 21.521 18.363c31.441 18.149 70.041 12.867 96.052-13.144s31.291-64.61 13.143-96.05a80.5 80.5 0 0 0-18.363-21.521l-19.591-16.01 47.124-47.124 56.018 62.241 24.282-.579 25.062-30.67a48.6 48.6 0 0 1 12.888-11.078c18.722-10.807 41.8-7.569 57.426 8.056s18.864 38.7 8.057 57.426a48.6 48.6 0 0 1-11.079 12.889l-30.67 25.061-.58 24.282 62.243 56.018Z"
              class="ci-primary" />
          </svg> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 7a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
          </svg>
          User Management
        </a>
        <ul class="nav-group-items compact">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
              href="{{ route('admin.kelolaUser') }}">
              User List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
              href="{{ route('admin.insertUserView') }}">
              Insert New User
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/doctors') ? 'active' : '' }}" href="{{ url('admin/doctors') }}">
              Doctor List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('doctors/create') ? 'active' : '' }}"
              href="{{ url('/doctors/create') }}">
              Insert New Doctor
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-divider"></li>
      <li class="nav-title">Service Management System</li>
      <li class="nav-group">
        <a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)"
              d="M384 200v-56a128 128 0 0 0-256 0v56H88v128c0 92.635 75.364 168 168 168s168-75.365 168-168V200Zm-224-56a96 96 0 0 1 192 0v56H160Zm232 184c0 74.99-61.01 136-136 136s-136-61.01-136-136v-96h272Z"
              class="ci-primary" />
          </svg>
          Service Management
        </a>
        <ul class="nav-group-items compact">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}"
              href="{{ route('admin.categories.index') }}">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Category
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('menu/konsultasi*') ? 'active' : '' }}"
              href="{{ route('menu.konsultasi') }}">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Consultation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('menu/riwayat*') ? 'active' : '' }}"
              href="{{ route('menu.riwayat') }}">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              History
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}"
              href="{{ route('admin.services.index') }}">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Service
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-divider"></li>
      <li class="nav-title">Article Management</li>
      <li class="nav-group">
        <a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)"
              d="M368 16H144a64.072 64.072 0 0 0-64 64v352a64.072 64.072 0 0 0 64 64h224a64.072 64.072 0 0 0 64-64V80a64.072 64.072 0 0 0-64-64m32 416a32.036 32.036 0 0 1-32 32H144a32.036 32.036 0 0 1-32-32V80a32.036 32.036 0 0 1 32-32h224a32.036 32.036 0 0 1 32 32Z"
              class="ci-primary" />
            <path fill="var(--ci-primary-color, currentcolor)"
              d="M176 112h160v32H176zm0 80h160v32H176zm0 80h160v32H176zm0 80h96v32h-96z" class="ci-primary" />
          </svg>
          Article Management
        </a>
        <ul class="nav-group-items compact">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/articles') ? 'active' : '' }}"
              href="{{ route('admin.articles.index') }}">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Article List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/articles/create') ? 'active' : '' }}"
              href="{{ route('admin.articles.create') }}">
              <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
              Insert New Article
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-divider"></li>
      <li class="nav-title">Booking Management</li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)"
              d="M472 48h-48V16h-32v32H120V16H88v32H40a24.028 24.028 0 0 0-24 24v400a24.028 24.028 0 0 0 24 24h432a24.028 24.028 0 0 0 24-24V72a24.028 24.028 0 0 0-24-24m-8 416H48V224h416Zm0-272H48V80h40v32h32V80h272v32h32V80h40Z"
              class="ci-primary" />
          </svg>
          Booking List
        </a>
      </li>
      @endif

      <!-- DOCTOR MENUS -->
      @if(auth()->check() && auth()->user()->role === 'doctor')
      <li class="nav-title">DOKTER</li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('doctor/dashboard') ? 'active' : '' }}" href="{{ route('doctor.dashboard') }}">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)" d="M425.706 142.294A240 240 0 0 0 16 312v88h144v-32H48v-56c0-114.691 93.309-208 208-208s208 93.309 208 208v56H352v32h144v-88a238.43 238.43 0 0 0-70.294-169.706" class="ci-primary" />
            <path fill="var(--ci-primary-color, currentcolor)" d="M80 264h32v32H80zm160-136h32v32h-32zm-104 40h32v32h-32zm264 96h32v32h-32zm-102.778 71.1 69.2-144.173-28.85-13.848-69.183 144.135a64.141 64.141 0 1 0 28.833 13.886M256 416a32 32 0 1 1 32-32 32.036 32.036 0 0 1-32 32" class="ci-primary" />
          </svg>
          Dashboard Dokter
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('doctor/consultations*') ? 'active' : '' }}" href="{{ route('doctor.consultations') }}#aktif">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)" d="M368 16H144a64.072 64.072 0 0 0-64 64v352a64.072 64.072 0 0 0 64 64h224a64.072 64.072 0 0 0 64-64V80a64.072 64.072 0 0 0-64-64m32 416a32.036 32.036 0 0 1-32 32H144a32.036 32.036 0 0 1-32-32V80a32.036 32.036 0 0 1 32-32h224a32.036 32.036 0 0 1 32 32Z" class="ci-primary" />
            <path fill="var(--ci-primary-color, currentcolor)" d="M176 112h160v32H176zm0 80h160v32H176zm0 80h160v32H176zm0 80h96v32h-96z" class="ci-primary" />
          </svg>
          Konsultasi Aktif
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('consultations/history*') ? 'active' : '' }}" href="{{ route('consultations.history') }}">
          <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)" d="M256 16C123.453 16 16 123.453 16 256s107.453 240 240 240 240-107.453 240-240S388.547 16 256 16ZM256 464c-114.691 0-208-93.309-208-208S141.309 48 256 48s208 93.309 208 208-93.309 208-208 208Z" class="ci-primary" />
            <path fill="var(--ci-primary-color, currentcolor)" d="M256 96a16 16 0 0 0-16 16v129.585l-71.185 71.185 22.627 22.628 80.558-80.56V112a16 16 0 0 0-16-16Z" class="ci-primary" />
          </svg>
          Riwayat Konsultasi
        </a>
      </li>
      @endif
    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
  </div>
  <!-- NEW SIDEBAR -->

  <!-- NEW CONTENT -->
  <div class="wrapper d-flex flex-column min-vh-100">
    <!-- HEADER -->
    <header class="header header-sticky p-0 mb-4">
      <div class="container-fluid border-bottom px-4">
        <button class="header-toggler" type="button"
          onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
          style="margin-inline-start: -14px">
          <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="var(--ci-primary-color, currentcolor)" d="M80 96h352v32H80zm0 144h352v32H80zm0 144h352v32H80z"
              class="ci-primary" />
          </svg>
        </button>
        <ul class="header-nav">
          <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-link nav-link py-2 px-2 d-flex align-items-center" type="button"
              aria-expanded="false" data-coreui-toggle="dropdown">
              <svg class="icon icon-lg theme-icon-active" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="var(--ci-primary-color, currentcolor)"
                  d="M256 16C123.452 16 16 123.452 16 256s107.452 240 240 240 240-107.452 240-240S388.548 16 256 16m-22 446.849a208.35 208.35 0 0 1-169.667-125.9c-.364-.859-.706-1.724-1.057-2.587L234 429.939Zm0-69.582L50.889 290.76A210 210 0 0 1 48 256q0-9.912.922-19.67L234 339.939Zm0-90L54.819 202.96a206 206 0 0 1 9.514-27.913Q67.1 168.5 70.3 162.191L234 253.934Zm0-86.015L86.914 134.819a209.4 209.4 0 0 1 22.008-25.9q3.72-3.72 7.6-7.228L234 166.027Zm0-87.708-89.648-49.093A206.95 206.95 0 0 1 234 49.151ZM464 256a207.775 207.775 0 0 1-198 207.761V48.239A207.79 207.79 0 0 1 464 256"
                  class="ci-primary" />
              </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="--cui-dropdown-min-width: 8rem">
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="light">
                  <svg class="icon icon-lg me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="var(--ci-primary-color, currentcolor)"
                      d="M256 104c-83.813 0-152 68.187-152 152s68.187 152 152 152 152-68.187 152-152-68.187-152-152-152m0 272a120 120 0 1 1 120-120 120.136 120.136 0 0 1-120 120M240 16h32v48h-32zm0 432h32v48h-32zm208-208h48v32h-48zm-432 0h48v32H16zm372.687 171.314 22.627-22.627 32 32-22.627 22.627zm-320-320 22.628-22.628 32 32-22.628 22.628zm-.002 329.375 32-32 22.628 22.626-32 32zm320.002-320.003 32-32 22.628 22.628-32 32z"
                      class="ci-primary" />
                  </svg>
                  Light
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center" type="button" data-coreui-theme-value="dark">
                  <svg class="icon icon-lg me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="var(--ci-primary-color, currentcolor)"
                      d="M268.279 496c-67.574 0-130.978-26.191-178.534-73.745S16 311.293 16 243.718A252.25 252.25 0 0 1 154.183 18.676a24.44 24.44 0 0 1 34.46 28.958 220.12 220.12 0 0 0 54.8 220.923A218.75 218.75 0 0 0 399.085 333.2a220.2 220.2 0 0 0 65.277-9.846 24.439 24.439 0 0 1 28.959 34.461A252.26 252.26 0 0 1 268.279 496M153.31 55.781A219.3 219.3 0 0 0 48 243.718C48 365.181 146.816 464 268.279 464a219.3 219.3 0 0 0 187.938-105.31 253 253 0 0 1-57.13 6.513 250.54 250.54 0 0 1-178.268-74.016 252.15 252.15 0 0 1-67.509-235.4Z"
                      class="ci-primary" />
                  </svg>
                  Dark
                </button>
              </li>
              <li>
                <button class="dropdown-item d-flex align-items-center active" type="button"
                  data-coreui-theme-value="auto">
                  <svg class="icon icon-lg me-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="var(--ci-primary-color, currentcolor)"
                      d="M256 16C123.452 16 16 123.452 16 256s107.452 240 240 240 240-107.452 240-240S388.548 16 256 16m-22 446.849a208.35 208.35 0 0 1-169.667-125.9c-.364-.859-.706-1.724-1.057-2.587L234 429.939Zm0-69.582L50.889 290.76A210 210 0 0 1 48 256q0-9.912.922-19.67L234 339.939Zm0-90L54.819 202.96a206 206 0 0 1 9.514-27.913Q67.1 168.5 70.3 162.191L234 253.934Zm0-86.015L86.914 134.819a209.4 209.4 0 0 1 22.008-25.9q3.72-3.72 7.6-7.228L234 166.027Zm0-87.708-89.648-49.093A206.95 206.95 0 0 1 234 49.151ZM464 256a207.775 207.775 0 0 1-198 207.761V48.239A207.79 207.79 0 0 1 464 256"
                      class="ci-primary" />
                  </svg>
                  Auto
                </button>
              </li>
            </ul>
          </li>
          <li class="nav-item py-1">
            <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
              aria-expanded="false">
              <!-- PROFPIC -->
              <div class="avatar avatar-md">
                @if(auth()->check() && auth()->user()->photo)
                  <img class="avatar-img" src="{{ asset('storage/' . auth()->user()->photo) }}"
                    alt="{{ auth()->user()->email }}">
                @else
                  <img class="avatar-img" src="{{ asset('images/no-image.png') }}" alt="Default Avatar">
                @endif
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
              <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold rounded-top mb-2">Account
              </div>
              @if(auth()->check() && auth()->user()->role === 'doctor')
                <a class="dropdown-item" href="{{ route('doctor.profile') }}">
                  <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile
                </a>
              @elseif(auth()->check() && auth()->user()->role === 'admin')
                <a class="dropdown-item" href="{{ route('profile.index') }}">
                  <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Profile
                </a>
              @endif
              <a class="dropdown-item" href="{{ route('logout') }}">
                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path fill="var(--ci-primary-color, currentcolor)"
                    d="M77.155 272.034H351.75v-32.001H77.155l75.053-75.053v-.001l-22.628-22.626-113.681 113.68.001.001h-.001L129.58 369.715l22.628-22.627v-.001z"
                    class="ci-primary" />
                  <path fill="var(--ci-primary-color, currentcolor)" d="M160 16v32h304v416H160v32h336V16z"
                    class="ci-primary" />
                </svg>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
      <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0">
            <!-- kalau yg login admin, ini redirect ke dashboard punyae admin -->
            @if(auth()->check() && auth()->user()->role === 'admin')
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            @endif
            <!-- kalau yg login doctor, yawes arahin ke punyae doctor -->
            @if(auth()->check() && auth()->user()->role === 'doctor')
            <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Home</a></li>
            @endif
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <div class="body flex-grow-1">
      <div class="container-lg px-4">
        <!-- NAV BAR ATAS -->
        <!-- /.row-->
        <!-- CONTENT BODY -->
        @yield('content-admin')
      </div>
    </div>
    <footer class="footer px-4">
      <div>
        <a href="https://coreui.io">CoreUI</a>
        <a href="https://coreui.io/product/free-bootstrap-admin-template/">Bootstrap Admin Template</a>
        &copy; 2026 creativeLabs.
      </div>
      <div class="ms-auto">
        Powered by&nbsp;
        <a href="https://coreui.io/bootstrap/docs/">CoreUI UI Components</a>
      </div>
    </footer>
  </div>
  <!-- NEW CONTENT -->
  <!-- CoreUI and necessary plugins-->
  <script src="{{ asset('core-ui-admin/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
  <script src="{{ asset('core-ui-admin/vendors/simplebar/js/simplebar.min.js') }}"></script>
  <script>
    const header = document.querySelector("header.header");

    document.addEventListener("scroll", () => {
      if (header) {
        header.classList.toggle("shadow-sm", document.documentElement.scrollTop > 0);
      }
    });
  </script>
  <!-- Plugins and scripts required by this view-->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('core-ui-admin/vendors/chart.js/js/chart.umd.js') }}"></script>
  <script src="{{ asset('core-ui-admin/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
  <script src="{{ asset('core-ui-admin/vendors/@coreui/utils/js/index.js') }}"></script>
  <script src="{{ asset('core-ui-admin/js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>