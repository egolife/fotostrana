@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Лента новостей</div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <article class="feed-item js-feed-item">
                                <h4>{{ $post->title }}</h4>
                                <p>{{ str_limit($post->body) }}</p>
                                @foreach($post->categories as $category)
                                    <a href="?category={{ $category->id }}">
                                        <span class="label label-success">{{ $category->name }}</span>
                                    </a>
                                @endforeach

                                <div class="feed-item-likes">
                                    @include('likes.link')
                                </div>
                            </article>

                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
