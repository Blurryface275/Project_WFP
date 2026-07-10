@extends('layouts.admincoreui-app');
@section('content-admin');
    <!-- Header index service -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Daftar Layanan</h5>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Tambah Layanan</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th>Ketersediaan</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->availability }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->category->category_name }}</td>
                                <td>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <!-- pake bootstrap Pagination biar ga error pas di klik next/prev -->
                {{ $services->links('pagination::bootstrap-5') }} 
            </div>
@endsection