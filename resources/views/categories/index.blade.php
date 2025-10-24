@extends('layouts.app')

@section('title', 'Catégories')
@section('content')
    <h1 class="mb-6 text-2xl font-bold pt-16">Toutes les catégories</h1>

    @if ($categories->isEmpty())
        <p class="text-gray-700">Aucune catégorie trouvée.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            @foreach ($categories as $category)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold mb-2">
                        <a href="{{ route('categories.show', $category->slug) }}" class="text-gray-900 hover:text-[#0ea5a1]">
                            {{ $category->name }}
                        </a>
                    </h2>
                    <p class="text-gray-700 text-sm">
                        {{ $category->posts_count }} {{ Str::plural('article', $category->posts_count) }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
   
@endsection