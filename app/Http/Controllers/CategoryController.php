<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->with(['tags:id,title,slug', 'user:id,name'])->latest()->simplePaginate(6);
        $title = $category->title;

        return view('category.index', [
            'title' => $title,
            'posts' => $posts,
            'category' => $category,
        ]);
    }
}
