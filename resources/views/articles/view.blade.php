@extends('welcome')

@section('content')
<div class="container">
    @if (isset($article->error))
        <div class="card mb-3">
            <div class='card-header bg-danger'>
                {{ $article->error }}
            </div>
        </div>
    @else
        <div class="card mb-3">
            <img src="{{asset($article->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $article->theme }}</h5>
                <p class="card-text"> {{ $article->body }}</p>
                <p class="card-text d-flex justify-content-between">
                    <button type="button" class="btn btn-primary like float-left">
                        Нравится <span class="badge badge-light">{{ $article->likes }}</span>
                    </button>
                    <small class="text-muted float-right align-self-end view">{{ 'Просмотров ' . $article->views }}</small>
                </p>
            </div>
        </div>
    @endif
    <div class="card mb-3 comment">
        <div class="card-header">
            Комментарий
        </div>
        <div class="card-body">
            <form id="comment_form" action="/comment" method="POST">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}"/>
                <div class="form-group">
                    <label for="theme">Тема</label>
                    <input type="text" class="form-control" id="theme" minlength="3" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="text">Сообщение</label>
                    <textarea class="form-control" id="text" rows="3" name="body" minlength="3" required></textarea>
                </div>
                <input type="submit" value="Отправить" class="btn btn-success ">
            </form>
        </div>
    </div>
</div>
<div class="card mb-4">
        <div class="card-body">
        <p class="card-text">
            Тэги
        </p>
            @foreach($tags as $tag)
                <a href="/tag/{{$tag->id}}" class="badge badge-info">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
@endsection