<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artikel Kesehatan</title>
</head>
<body>
    @foreach ($articles as $article )
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src=".../100px180/" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$article->title}}</h5>
    <p class="card-text">{{$article->content(10)}}</p>
    <p class="card-text"><small class="text-muted">Dibuat pada {{$article->created_at}}</small></p>
    <a href="article/{{$article->id}}" class="btn btn-primary">Baca lebih lanjut</a>
  </div>
</div>
    @endforeach
</body>
</html>
