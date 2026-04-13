<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar Layanan Kesehatan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Services</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Service Name</th>
        <th>Description</th>
        <th>Availability</th>
        <th>Price</th>
        <th>Category ID</th>
        <th>Category</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td><a href="{{ route('services.show', $service->id) }}">{{ $service->service_name }}</a></td>
            <td>{{ $service->description }}</td>
            <td>{{ $service->availability }}</td>
            <td>{{ $service->price }}</td>
            <td>{{ $service->category_id }}</td>
            <td>{{ $service->category->category_name}}</td>

        </tr>
        @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
