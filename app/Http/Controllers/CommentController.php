<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'content' => $validated['content'],
            'is_approved' => false, // à approuver dans Filament
        ]);

        return redirect()->back()->with('success', 'Commentaire envoyé, en attente de validation.');
    }
}
