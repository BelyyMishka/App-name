<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Tag extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
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
        $key = 'tags';
        $time = 900; // 15 minutes

        if (Cache::has($key)) {
            return Cache::get($key);
        }
        else {
            $tags = self::select('id', 'title', 'slug')->orderBy('title')->get();
            Cache::put($key, $tags, $time);
            return Cache::get($key);
        }
    }
}
