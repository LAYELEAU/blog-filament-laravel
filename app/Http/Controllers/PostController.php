<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
            $posts = Post::latest()->paginate(9);
            return view('posts.index', compact('posts'));
    

        // 4 derniers posts pour la section "Derniers articles"
        $latestPosts = Post::latest()->take(4)->get();

        // post principal (celui affiché en haut)
        $topPost = Post::latest()->first();

        // catégorie liée au dernier post + ses 4 derniers articles
        $relatedCategory = null;
        $relatedPosts = collect();
        if ($topPost && $topPost->category) {
            $relatedCategory = $topPost->category;
            $relatedPosts = $relatedCategory->posts()->latest()->take(4)->get();
        }

        // blocs de catégories : 3 catégories (excluant la catégorie du topPost) avec 4 articles chacune
        $excludeCategoryId = $topPost ? $topPost->category_id : null;

        $categoriesQuery = Category::withCount('posts')
            ->with(['posts' => function ($q) {
                $q->latest()->take(4);
            }])
            ->whereHas('posts');

        if ($excludeCategoryId) {
            $categoriesQuery->where('id', '!=', $excludeCategoryId);
        }

        $categoryBlocks = $categoriesQuery->orderBy('posts_count', 'desc')->take(3)->get();

        // liste complète des catégories (pour sidebar ou autres)
        $categories = Category::withCount('posts')->get();

        // tags (si la vue les attend)
        $tags = Tag::withCount('posts')->get();

        return view('home', compact(
            'posts',
            'latestPosts',
            'topPost',
            'relatedCategory',
            'relatedPosts',
            'categoryBlocks',
            'categories',
            'tags'
        ));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'comments'])->where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    
}
