<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kelola USer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

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
      </tr>
    </thead>
    <tbody>
        <!-- looping display data -->
         @foreach ($users as $u)
         <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email}}</td>
            <td>{{ $u->password }}</td>
            <td>{{ $u->role }}</td>
         </tr>
         @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
