<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*User::factory(10)->create();
        Category::factory(20)->create();
        Tag::factory(30)->create();
        Post::factory(5000)->create();*/

        /*$posts = Post::all();
        foreach ($posts as $post) {
            $count = rand(1, 3);
            $tagIds = Tag::pluck('id')->random($count)->all();
            $post->tags()->sync($tagIds);
        }*/

        /*Admin::factory(1)->create();*/
    }
}
