<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'required|min:1',
        ]);

        $title = "Search";
        $search = $request->search;
        $posts = Post::with(['category:id,title,slug', 'user:id,name', 'tags:id,title,slug'])
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->latest()
            ->simplePaginate(6);

        return view('search.index', [
            'posts' => $posts,
            'title' => $title,
            'search' => $search,
        ]);
    }
}
