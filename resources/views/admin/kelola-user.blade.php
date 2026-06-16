<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <title>Kelola USer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .user-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
    }
  </style>
</head>

<body> -->
@extends('layouts.admin-app')
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
  <div class="container">
    <h2>Kelola Data User</h2>
    <p>Admin dapat melakukan pengelolaan data yaitu edit dan delete : </p>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Role</th>
          <th>Image</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <!-- looping display data -->
        @foreach ($users as $u)
          <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email}}</td>
            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $u->password }}</td>
            <td>{{ $u->role }}</td>
            <td>
              @if ($u->photo)
                <img src="{{ asset('storage/' . $u->photo) }}" class="user-img" class="user-img">
              @else
                <img src="https://i.pinimg.com/170x/d6/5c/fa/d65cfa8b47227df12fb97217e8f940e3.jpg" class="user-img" class="user-img">
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
@endsection
<!-- 
</body>

</html> -->
