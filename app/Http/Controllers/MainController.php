<?php

namespace App\Http\Controllers;

use App\Models\Post;

class MainController extends Controller
{
    public function index()
    {
        $title = 'Main';
        $posts = Post::with(['category:id,title,slug', 'user:id,name', 'tags:id,title,slug'])->recent(3)->get();

        return view('main.index', [
            'title' => $title,
            'posts' => $posts,
        ]);
    }
}
