<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        Category::factory(10)->create();
        Post::factory(50)->create();
        Comment::factory(200)->create();
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@blogmakings.local',
            'role' => 'admin',
            'password' => Hash::make('admin')
        ]);
	    User::create([
            'name' => 'Author',
            'email' => 'athor@blogmakings.local',
            'role' => 'author',
            'password' => Hash::make('author')
        ]);
    }
}
