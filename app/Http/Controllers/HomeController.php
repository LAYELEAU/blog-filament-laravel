<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(9);
         $categories = Category::withCount('posts')
            ->with(['posts' => function ($q) {
                $q->latest()->take(4);
            }])->get();

        // <-- Ajouté pour les derniers 4 posts -->
        $latestPosts = Post::latest()->take(4)->get();

        $latestPost = Post::latest()->first();
        $relatedCategory = null;
    $relatedPosts = collect();

    if ($latestPost && $latestPost->category) {
        $relatedCategory = $latestPost->category;
        // Exclure le dernier post si tu ne veux pas le répéter :
        $relatedPosts = $relatedCategory->posts()
          
            ->latest()
            ->take(4)
            ->get();
        


    // choix de catégorie et afficher 4 article
         $topPost = Post::latest()->first();
        $excludeCategoryId = $topPost ? $topPost->category_id : null;

        // récupérer 3 catégories récentes (ou avec le plus de posts),
        // exclure la catégorie du post principal, et charger 4 articles par catégorie
        $categoriesQuery = Category::withCount('posts')
            ->with(['posts' => function ($q) {
                $q->latest()->take(4);
            }])
            ->whereHas('posts');

        if ($excludeCategoryId) {
            $categoriesQuery->where('id', '!=', $excludeCategoryId);
        }

        $categoryBlocks = $categoriesQuery
            ->orderBy('posts_count', 'desc')
            ->take(3)
            ->get();

        // garder aussi la liste complète pour la sidebar si besoin
        $categories = Category::withCount('posts')->get();

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

        return view('home', compact('posts', 'latestPosts', 'topPost', 'categoryBlocks', 'categories', 'relatedCategory', 'relatedPosts'));
    }
    }
}
