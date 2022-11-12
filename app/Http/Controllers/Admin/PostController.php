<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.post.index', [
            'title' => 'Posts',
        ]);
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::select(['id', 'title', 'user_id', 'category_id'])->with(['tags:id,title,slug', 'category:id,title,slug', 'user:id,name'])->get();
            return DataTables::of($posts)
                ->addColumn('category', function ($row) {
                    return $row->category->title;
                })
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('action', function ($row) {
                    $actionButtons = view('admin.sections.action_buttons', [
                        'route' => 'admin.posts',
                        'item' => $row,
                    ])->render();
                    return $actionButtons;
                })
                ->addColumn('tags', function ($row) {
                    $tags = "";
                    foreach ($row->getTags() as $tagId => $tagTitle) {
                        $tags .= "$tagTitle, ";
                    }
                    $tags = rtrim($tags, ", ");
                    return $tags;
                })->escapeColumns('tags')->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::select(['id', 'title'])->orderBy('title')->get();
        $tags = Tag::select(['id', 'title'])->orderBy('title')->get();
        $users = User::select(['id', 'name'])->orderBy('name')->get();

        return view('admin.post.create', [
            'title' => 'Create post',
            'categories' => $categories,
            'tags' => $tags,
            'users' => $users,
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
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'tags' => 'nullable|array',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = Post::addImage($request);
        }

        Post::add($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post was added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::select(['id', 'title'])->orderBy('title')->get();
        $tags = Tag::select(['id', 'title'])->orderBy('title')->get();
        $users = User::select(['id', 'name'])->orderBy('name')->get();
        $selectedTags = $post->tags->pluck('id')->all();

        return view('admin.post.edit', [
            'title' => 'Edit post',
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'users' => $users,
            'selectedTags' => $selectedTags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'tags' => 'nullable|array',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        $post = Post::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = Post::editImage($request, $post);
        }

        Post::edit($data, $post);

        return redirect()->route('admin.posts.index')->with('success', 'Post was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Post::remove($post);

        return redirect()->route('admin.posts.index')->with('success', 'Post was deleted.');
    }
}
