<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function sluggable(): array
    {
        return [
          'slug' => [
              'source' => 'title'
          ]
        ];
    }

    public static function getFromCache()
    {
        $key = 'categories';
        $time = 3600; // 1 hour

        if (Cache::has($key)) {
            return Cache::get($key);
        }
        else {
            $categories = self::select('id', 'title', 'slug')->orderBy('title')->get();
            Cache::put($key, $categories, $time);
            return Cache::get($key);
        }
    }
}
