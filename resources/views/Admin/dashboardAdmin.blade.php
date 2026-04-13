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
        <h2>VitaGuard</h2>
        <h4>Welcome Admin</h4>
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item"><a href="{{ route('admin.users') }}" class="nav-link text-white">Kelola User</a>
                </li>
                <li class="nav-item"><a href="{{ route('admin.dokter.list') }}" class="nav-link text-white">List
                        Dokter</a></li>
            </ul>
        </div>
    </div>

</body>

</html>