<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model implements Viewable
{
    use HasFactory, Sluggable, InteractsWithViews;

    protected $removeViewsOnDelete = true;

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
        'user_id'
    ];

    /**
     * @param array $data
     * @return Post
     */
    public static function add(array $data)
    {
        $post = static::create($data);

        if (Arr::has($data, 'tags')) {
            $post->tags()->sync($data['tags']);
        }

        return $post;
    }

    public static function remove($post)
    {
        $post->tags()->sync([]);
        static::removeImage($post);
        $post->delete();
    }

    public static function edit(array $data, Post $post)
    {
        $post->update($data);

        if (Arr::has($data, 'tags')) {
            $post->tags()->sync($data['tags']);
        }
        else {
            $post->tags()->sync([]);
        }

        return $post;
    }

    public static function addImage($request)
    {
        $date = date('d.m.Y');
        $dir = "posts/{$date}";
        return Storage::putFile($dir, $request->file('image'));
    }

    public static function removeImage($post)
    {
        if (empty($post->image) || !is_string($post->image)) {
            return;
        }

        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        }
    }

    public static function editImage($request, $post)
    {
        static::removeImage($post);

        return static::addImage($request);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeRecent($query, int $limit = 5)
    {
        return $query->latest()->limit($limit);
    }

    public function scopePopular($query, int $limit = 6)
    {
        return $query->orderByViews('desc')->take($limit);
    }

    public function getDate($format = 'F j, Y')
    {
        return $this->created_at->format($format);
    }

    /**
     * ['id' => 'title', ...]
     */
    public function getTags()
    {
        return $this->tags->pluck('title', 'id')->all();
    }

    public function getPreviewContent($limit = 380, $end = '...')
    {
        return Str::limit($this->content, $limit, $end);
    }
}
