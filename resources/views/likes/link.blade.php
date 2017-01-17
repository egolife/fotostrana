{{ $post->liked->count() }}
<i class="glyphicon glyphicon-heart{{ $post->likedByUser() ? '' : '-empty' }}"></i>