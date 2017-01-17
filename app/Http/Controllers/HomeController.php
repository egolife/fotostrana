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
        return view('home')->with([
            'posts' => Post::with('liked')->get()
        ]);
    }
}
