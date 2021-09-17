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
        <div class="card mb-3 border-secondary">
            <img src="{{asset($article->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $article->theme }}</h5>
                <p class="card-text"> {{ $article->body }}</p>
                <p class="card-text d-flex justify-content-between">
                    <button type="button" class="btn btn-primary like float-left">
                        Likes <span class="badge badge-light">{{ $article->likes }}</span>
                    </button>
                    <small class="text-muted float-right align-self-end view">{{ 'Views ' . $article->views }}</small>
                </p>
            </div>
        </div>
    @endif
    <div id="comments">
        @foreach($comments as $comment)
            <div class="card mb-3 border-info">
                <div class="card-header">
                    {{ $comment->subject }}
                </div>
                <div class="card-body">
                    <p>{{ $comment->body }}</p>
                </div>
                <div class="card-footer text-right">
                    <small>
                        {{ $comment->date }}
                    </small>
            </div>
        </div>
        @endforeach
        <div class="card mb-3 border-info" style="display: none" id='comment'>
            <div class="card-header">
            </div>
            <div class="card-body">
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    <div class="card mb-3 comment border-success">
        <div class="card-header">
            Comment
        </div>
        <div class="card-body">
            <form id="comment_form" action="/comment" method="POST">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}"/>
                <div class="form-group">
                    <label for="theme">Subject</label>
                    <input type="text" class="form-control" id="theme" minlength="3" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="text">Message</label>
                    <textarea class="form-control" id="text" rows="3" name="body" minlength="3" required></textarea>
                </div>
                <input type="submit" value="Post" class="btn btn-success ">
            </form>
        </div>
    </div>
</div>
<div class="card mb-4">
        <div class="card-body">
        <p class="card-text">
            Tags
        </p>
            @foreach($tags as $tag)
                <a href="/tag/{{$tag->id}}" class="badge badge-info">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
@endsection