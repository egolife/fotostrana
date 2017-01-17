<a href="{{ route('posts.like', $post->id) }}" class="text-danger js-like">
    {{ $post->liked->count() }}
    <i class="glyphicon glyphicon-heart{{ $post->likedByUser() ? '' : '-empty' }}"></i>
</a>

<div class="liked-users js-liked-users hidden">
    <ul class="test">
        @foreach($post->liked as $user)
            @if($user->id == request()->user()->id)
                <li>Я</li>
            @else
                <li>{{ $user->name }}</li>
            @endif
        @endforeach
    </ul>
</div>

