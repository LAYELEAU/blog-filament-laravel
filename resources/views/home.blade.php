@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<h1 class="mb-4">Derniers articles</h1>

<div class="row">
    @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    @if($post->image)
                         <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-100 rounded">
                    @endif
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="text-muted">
                        Catégorie : {{ $post->category->name ?? 'Non classé' }}
                    </p>
                    <p>{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">
                        Lire la suite
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $posts->links() }}
</div>
@endsection
