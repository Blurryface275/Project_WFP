@extends('layouts.admin-app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Daftar Artikel</h2>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary mb-3">Tambah Artikel</a>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Judul Artikel</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articles as $index => $article)
                                <tr>
                                    <td>{{ $articles->firstItem() + $index }}</td>
                                    <td>
                                        @if($article->photo)
                                            <img src="{{ asset('storage/' . $article->photo) }}" width="80" alt="Foto artikel">
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->category->category_name ?? 'Tanpa Kategori' }}</td>
                                    <td>{{ $article->author->nama_lengkap ?? 'Tidak ada penulis' }}</td>
                                    <td>
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada artikel.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $articles->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection