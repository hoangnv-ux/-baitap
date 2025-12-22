<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Bài viết 1',
            'content' => 'Nội dung bài viết 1'
        ]);

        Post::create([
            'title' => 'Bài viết 2',
            'content' => 'Nội dung bài viết 2'
        ]);
    }
}
