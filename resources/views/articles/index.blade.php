@extends('welcome')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-3">
        @foreach($articles as $article)
            <div class="col mb-4" onclick="javascript:redirect({{ $article->id }})">
                <div class="card h-100">
                <img src="{{asset($article->preview) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->theme }}</h5>
                    <p class="card-text">{{ $article->description }}</p>
                </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{ $articles->links() }}
@endsection