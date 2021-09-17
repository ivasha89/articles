@extends('welcome')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-3">
        @if($articles->count())
            @foreach($articles as $article)
                <div class="col mb-4">
                    <div class="card h-100 border-secondary">
                    <img src="{{asset($article->preview)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/article/{{ $article->id }}">{{ $article->theme }}</a></h5>
                        <p class="card-text">{{ $article->description }}</p>
                    </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12">
                {{ $articles->links() }}
            </div>
        @else
            <div class="col mb-4">
                <div class="card h-100 border-secondary">
                <div class="card-body">
                    <h5 class="card-title">
                    There is no any article
                    </h5>
                </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection