@extends('layouts.app')

@section('title', $post->title)

@section('content')
  @if($post->image)
                         <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded">
                    @endif
<h1>{{ $post->title }}</h1>

<p class="text-muted">
    Publié le {{ $post->published_at->format('d/m/Y') }}
    dans <strong>{{ $post->category->name ?? 'Non classé' }}</strong>
</p>

<div class="mb-4">
    {!! nl2br(e($post->content)) !!}
</div>

<hr>

<h4>Commentaires</h4>

@foreach ($post->comments as $comment)
    @if ($comment->is_approved)
        <div class="border p-2 mb-2">
            <strong>{{ $comment->name }}</strong>
            <p>{{ $comment->content }}</p>
        </div>
    @endif
@endforeach

<hr>

<h4>Laisser un commentaire</h4>
<form action="{{ route('comments.store', $post->slug) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email </label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Commentaire</label>
        <textarea name="content" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Envoyer</button>
</form>
@endsection
