<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $title = 'Blog';
        $posts = Post::with(['category:id,title,slug', 'user:id,name', 'tags:id,title,slug'])->latest()->simplePaginate(6);

        return view('post.index', [
            'title' => $title,
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $title = 'Create post';
        $tags = Tag::getFromCache();
        $categories = Category::getFromCache();

        return view('post.create', [
            'title' => $title,
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'tags' => 'nullable|array',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = Post::addImage($request);
        }

        $post = Post::add($data);

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        $post = Post::with(['category:id,title,slug', 'user:id,name', 'tags:id,title,slug'])
            ->where('slug', $slug)->firstOrFail();

        $title = $post->title;
        views($post)->record();

        return view('post.show', [
            'title' => $title,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $slug)
    {
        $title = 'Edit post';
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $categories = Category::getFromCache();
        $tags = Tag::getFromCache();
        $selectedTags = $post->tags->pluck('id')->all();

        return view('post.edit', [
            'title' => $title,
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'selectedTags' => $selectedTags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'tags' => 'nullable|array',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        $post = Post::where('slug', $slug)->firstOrFail();

        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = Post::editImage($request, $post);
        }

        Post::edit($data, $post);

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        Post::remove($post);

        return redirect()->route('posts.index');
    }
}
