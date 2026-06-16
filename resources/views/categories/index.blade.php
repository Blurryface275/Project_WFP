@extends('layouts.member-app')
@section('title','VitaGuard - Kategori Layanan')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f6f9; }
        .page-header {
            background: linear-gradient(135deg, #0056b3, #007bff);
            color: white;
            padding: 32px 0;
            margin-bottom: 30px;
            border-radius: 0 0 20px 20px;
        }
        .page-header h2 { font-weight: 700; }
        .page-header p { opacity: 0.8; margin-bottom: 0; }
        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .table thead th {
            background: #343a40;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            border: none;
            padding: 14px 16px;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 14px 16px;
            font-size: 0.9rem;
        }
        .table-hover tbody tr:hover { background-color: #e7f1ff; }
        .category-name { font-weight: 600; color: #2c3e50; }
        .badge-service {
            display: inline-block;
            background: #e7f1ff;
            color: #0056b3;
            font-weight: 600;
            font-size: 0.78rem;
            padding: 5px 12px;
            border-radius: 20px;
            margin: 3px 4px 3px 0;
        }
        .badge-empty {
            color: #adb5bd;
            font-style: italic;
            font-size: 0.85rem;
        }
        .id-col {
            font-weight: 700;
            color: #007bff;
            font-size: 1rem;
            width: 60px;
        }
        .count-badge {
            background: #007bff;
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 10px;
            margin-left: 6px;
        }
    </style>
</head>
<body>

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
           <h1 class="color:#fff;">Kategori Layanan Kesehatan</h1>
        <p>Kelola kategori dan layanan yang tersedia di VitaGuard</p>

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

<div class="container mb-5 mt-5">
    <div class="table-card">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Nama Kategori</th>
                    <th>Layanan Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="id-col text-center">{{ $category->id }}</td>
                    <td>
                        <span class="category-name">{{ $category->category_name }}</span>
                        <span class="count-badge">{{ $category->services->count() }} layanan</span>
                    </td>
                    <td>
                        @forelse ($category->services as $service)
                            <span class="badge-service">{{ $service->service_name }}</span>
                        @empty
                            <span class="badge-empty">Belum ada layanan</span>
                        @endforelse
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <small class="text-muted">Total: {{ $categories->count() }} kategori</small>
    </div>
</div>
@endsection
