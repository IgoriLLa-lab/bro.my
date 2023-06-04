<!DOCTYPE html>
<html>
<head>
    <title>Статьи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-4 mb-4">Статьи</h1>

    <ul class="list-group">
        @foreach($articles as $article)
            <li class="list-group-item">
                <h4>{{ $article->title }}</h4>
                <img src="{{ asset($article->image) }}" alt="Изображение">
                <p>{{ $article->description }}</p>
                <ul>
                    @if ($article->tags)
                        @foreach ($article->tags as $tag)
                            <li>{{ $tag->name }}</li>
                        @endforeach
                    @endif
                </ul>
            </li>
        @endforeach
    </ul>

    <div class="pagination justify-content-center">
        <ul class="pagination">
            <li class="page-item {{ $articles->currentPage() == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $articles->previousPageUrl() }}">Предыдущая</a>
            </li>

            @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $articles->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <li class="page-item {{ $articles->currentPage() == $articles->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $articles->nextPageUrl() }}">Следующая</a>
            </li>
        </ul>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
Теперь в каждой статье будет отображаться изображение, описание и список тегов.






