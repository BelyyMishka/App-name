<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $title = $tag->title;
        $posts = $tag->posts()->with(['user:id,name', 'category:id,title,slug', 'tags:id,title,slug'])->latest()->simplePaginate(6);

        return view('tag.index', [
            'posts' => $posts,
            'tag' => $tag,
            'title' => $title,
        ]);
    }
}
