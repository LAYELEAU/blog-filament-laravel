<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(6);
        return view('home', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'comments'])->where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
