
@extends('layouts.app')

@section('title', $post->title)

@section('content')
<article class="max-w-3xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden mb-12 mt-8">
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 md:h-80 object-cover">
    @endif

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-2 text-gray-900">{{ $post->title }}</h1>

        <p class="text-sm text-gray-500 mb-4">
            Publié le <span class="text-gray-600">{{ $post->published_at->format('d/m/Y') }}</span>
            — dans
            <strong class="text-[#203c89] font-semibold">{{ $post->category->name ?? 'Non classé' }}</strong>
        </p>

        <div class="text-gray-800 mb-6 leading-relaxed">
            {!! $post->content !!}
        </div>

        <hr class="my-6">

        <h2 class="text-lg font-semibold mb-3">Commentaires</h2>

        <div class="space-y-4 mb-6">
            @foreach ($post->comments as $comment)
                @if ($comment->is_approved)
                    <div class="border rounded p-4">
                        <div class="flex items-center justify-between mb-2">
                            <strong class="text-gray-800">{{ $comment->name }}</strong>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <hr class="my-6">

        <h3 class="text-lg font-semibold mb-3">Laisser un commentaire</h3>

        <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="name" required
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#203c89]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#203c89]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Commentaire</label>
                <textarea name="content" rows="4" required
                          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#203c89]"></textarea>
            </div>

            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#203c89] hover:bg-[#172d63] text-white rounded">
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</article>
@endsection
