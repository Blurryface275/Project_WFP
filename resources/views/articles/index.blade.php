<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Kesehatan - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img{
            width: 400px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4">Artikel Kesehatan</h2>
        <div class="row">

            @foreach($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img class="card-img-top"
                            src="{{ $article->photo ?? 'https://placehold.co/400x200?text=No+Image' }}"
                            alt="{{ $article->title }}" onerror="this.src='https://placehold.co/400x200?text=No+Image'">
                        <div class="card-body">
                            <h5 class="card-title">{{$article->title}}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Baca lebih
                                lanjut</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</body>

</html>