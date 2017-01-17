@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Лента новостей</div>

                    <div class="panel-body">
                        @foreach($posts as $post)
                            <article class="feed-item">
                                <h4>{{ $post->title }}</h4>
                                <p>{{ str_limit($post->body) }}</p>

                                <div class="feed-item-likes">
                                    <a href="#" class="text-danger">
                                        {{ $post->liked->count() }}
                                        <i class="glyphicon glyphicon-heart{{ $post->likedByUser() ? '-empty' : '' }}"></i>
                                    </a>
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
