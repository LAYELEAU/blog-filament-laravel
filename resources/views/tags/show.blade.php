
@extends('layouts.app')

@section('title', $tag->name)

@section('content')
    <h1 class="text-3xl font-bold mb-4">{{ $tag->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($posts as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-600">{{ Str::limit(strip_tags($post->content), 100) }}</p>

                    <div class="mt-4">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500 hover:underline">Lire la suite</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

@endsection

