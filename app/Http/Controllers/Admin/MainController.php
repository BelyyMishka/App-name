<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $postsCount = Post::count();
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $tagsCount = Tag::count();

        return view('admin.main.index', [
            'title' => 'Main',
            'postsCount' => $postsCount,
            'usersCount' => $usersCount,
            'categoriesCount' => $categoriesCount,
            'tagsCount' => $tagsCount,
        ]);
    }
}
