<?php

namespace FotoStrana\Http\Controllers;

use FotoStrana\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Переключает лайк пользователя у поста (ставит/убирает)
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function like(Post $post)
    {
        request()->user()->likes()->toggle($post);

        return response()->json([
            'html' => view('likes.link', ['post' => $post])->render()
        ]);

    }
}
