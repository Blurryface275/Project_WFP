@extends('layout.app')
@section('title', 'VitaGuard - Kelola User')
@push('styles')
  <style>
    .pagination .page-link {
      font-size: 0.9rem;
      padding: 6px 12px;
    }
  </style>
@endpush
@section('content')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <style>
    body {
      background-color: #f4f6f9;
    }

    .page-title.bg-1 {
      background: linear-gradient(135deg, #0056b3, #007bff);
      padding: 60px 0;
      color: white;
    }

    .table-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
      overflow: hidden;
    }

    .table thead th {
      background: #343a40;
      color: #fff;
      font-size: 0.85rem;
      font-weight: 600;
      border: none;
      padding: 14px 16px;
    }

    .table tbody td {
      vertical-align: middle;
      padding: 14px 16px;
      font-size: 0.9rem;
    }

    .table-hover tbody tr:hover {
      background-color: #e7f1ff;
    }

    /* Style Spesifik Dokter */
    .doctor-name {
      font-weight: 600;
      color: #2c3e50;
      display: block;
    }

    .specialist-badge {
      display: inline-block;
      background: #e7f1ff;
      color: #0056b3;
      font-weight: 600;
      font-size: 0.75rem;
      padding: 2px 10px;
      border-radius: 15px;
    }

    .img-thumb {
      width: 45px;
      height: 45px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #dee2e6;
    }

    .schedule-tag {
      display: inline-block;
      background: #f8f9fa;
      border: 1px solid #dee2e6;
      font-size: 0.75rem;
      padding: 2px 8px;
      border-radius: 4px;
      margin: 2px;
    }

    .btn-action {
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.8rem;
    }
  </style>

  <section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block text-center">
            <h1 class="text-white">Daftar User</h1>
            <p class="text-white-50">Manajemen informasi dokter VitaGuard</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container mb-5 mt-5">
    <div class="table-card">
      <table class="table table-hover mb-0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Role</th>
          <th>Image</th>
          <th class="text-center">Edit</th>
          <th class="text-center">Delete</th>
        </tr>
      </thead>
      <tbody>
        <!-- looping display data -->
        @foreach ($users as $u)
          <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email}}</td>
            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $u->password }}
            </td>
            <td>{{ $u->role }}</td>
            <td>
              @if ($u->photo)
                <img src="{{ asset('storage/' . $u->photo) }}" class="user-img" class="user-img">
              @else
                <img src="https://i.pinimg.com/170x/d6/5c/fa/d65cfa8b47227df12fb97217e8f940e3.jpg" class="user-img"
                  class="user-img">
              @endif
            </td>
            <td>
              <button class="btn btn-warning btn-sm" onclick="alert('Feature Coming Soon')">
                <span class="glyphicon glyphicon-pencil"></span> Edit
              </button>
            </td>
            <td>
              <button class="btn btn-danger btn-sm" onclick="alert('Feature Coming Soon')">
                <span class="glyphicon glyphicon-trash"></span> Delete
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </div>
@endsection