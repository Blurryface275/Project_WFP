@extends('layouts.admincoreui-app')

@section('content-admin')
<h2>Daftar Kategori</h2>
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Service</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
            <tr>
                <td>{{ $categories->firstItem() + $index }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->services->count() }}</td>
                <td>
                    <!-- Tombol lihat pake yg public punya karena detail kategori cukup diliat dari view pengunjung -->
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info text-white" target="_blank">Lihat</a>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $categories->links('pagination::bootstrap-5') }}
</div>
@endsection
