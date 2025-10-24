@extends('layouts.app')
@section('title', 'Tous les articles')
@section('content')
    <h1 class="mb-6 text-2xl font-bold pt-16">Tous les articles</h1>
    @if ($posts->isEmpty())
        <p class="text-gray-700">Aucun article trouvé.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <article class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
                    @if($post->image)
                        <a href="{{ route('posts.show', $post->slug) }}" class="block">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-40 md:h-44 object-cover">
                        </a>
                    @endif

                    <div class="p-4 flex flex-col flex-1">
                        <h2 class="text-lg font-semibold mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-[#0ea5a1]">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-sm text-gray-500 mb-3">
                            Catégorie :
                            <span class="text-[#203c89] font-medium">{{ $post->category->name ?? 'Non classé' }}</span>
                        </p>

                        <p class="text-gray-700 text-sm mb-4 flex-1">
                            {!! Str::limit($post->content, 100) !!}
                        </p>

                        <a href="{{ route('posts.show', $post->slug) }}" class="mt-auto text-[#203c89] font-semibold hover:underline">
                            Lire la suite
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
@endsection