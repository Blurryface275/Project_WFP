<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$article->title}} - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <a href="{{route('articles.index')}}" class="btn btn-secondary mb-3">← Kembali</a>

        <img class="img-fluid mb-3" src="{{ $article->photo ?? '{{asset('images/no-image.png')}}' }}"
            alt="{{ $article->title }}">

        <h2>{{$article->title}}</h2>
        <p class="text-muted">Ditulis oleh: {{ $article->author->name }} pada {{ $article->created_at }}</p>
        <p>{{$article->content}}</p>
    </div>
</body>

</html>