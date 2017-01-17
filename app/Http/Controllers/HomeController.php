<?php

namespace FotoStrana\Http\Controllers;

use FotoStrana\Post;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response|View
     */
    public function index()
    {
        $query = request('category') ? Post::whereHas('categories', function ($query) {
            $query->where('id', request('category'));
        }) : Post::query();

        return view('home')->with([
            'posts' => $query->with('liked', 'categories')->get()
        ]);
    }
}
