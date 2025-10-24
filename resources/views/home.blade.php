@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
{{--
<section class="relative w-screen left-1/2 -translate-x-1/2 flex flex-col lg:flex-row items-center lg:items-start gap-4  py-20 px-6 lg:px-16 shadow-md min-h-[320px] bg-cover bg-center" style="background-image: url('{{ asset('images/bg-home.jpg') }}');">
    <!-- overlay pour rendre le texte lisible -->
    <div class="absolute inset-0 bg-black/50 pointer-events-none"></div>

    <div class="relative z-10 w-full lg:w-1/2 p-6 mb-8">
        <h2 class="text-2xl md:text-3xl font-bold mb-2 text-white">Bienvenue sur Notre Blog</h2>
        <p class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-tight py-4">
            Meilleur magazine <br> de formation
        </p>
        <p class="text-white/90 mt-4 max-w-xl">
            Découvrez des articles passionnants sur divers sujets, rédigés par des experts et des passionnés. Restez informé des dernières tendances, astuces et conseils pour enrichir vos connaissances.
        </p>

        <button class="text-2xl mt-6 px-8 py-3 bg-[#007aff] text-white font-bold rounded-lg hover:bg-[#172d63]">Lire la suite</button>
    </div>

    <div class="relative z-10 hidden lg:flex w-1/2 justify-center items-center">
        <img src="{{ asset('images/home-blog.png') }}" alt="Logo" class=" object-contain  h-[500px]">
        <div class="absolute -bottom-1 left-28 w-[430px] h-[8px] backdrop-blur-lg bg-gradient-to-t from-white/20 to-transparent rounded-full"></div>
        
        
    </div>
</section>

<section class=" pt-16">
  <div class="max-w-7xl mx-auto ">
    
    <h2 class="text-2xl font-bold text-gray-800 mb-10 ">
      Articles récents
    </h2>

    <div class="flex flex-col lg:flex-row gap-8">
      <!-- Article principal -->
      <div class="lg:w-2/3 bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-lg transition">
        <img 
          src="{{ asset('storage/' . $posts->first()->image) }}" 
          alt="{{ $posts->first()->title }}" 
          class="w-full h-[400px] object-cover"
        >

        <div class="p-6">
          <h4 class="text-sm uppercase tracking-wide text-[#007aff] font-medium mb-2">
            {{ $posts->first()->category->name ?? 'Non classé' }}
          </h4>

          <h3 class="text-2xl font-semibold text-gray-900 hover:text-[#007aff] transition mb-3">
            <a href="{{ route('posts.show', $posts->first()->slug) }}">
              {{ $posts->first()->title }}
            </a>
          </h3>
          <p>Par NOM DE LAUTEUR  ,le {{ $posts->first()->published_at->format('d/m/Y') }}</p>

          <p class="text-gray-700 leading-relaxed text-sm mb-5">
            {{!! Str::limit(strip_tags($posts->first()->content), 250) !!}}
          </p>

          <a href="{{ route('posts.show', $posts->first()->slug) }}" 
             class="inline-block bg-[#203c89] hover:bg-[#172d63] text-white px-5 py-2 rounded-md text-sm font-medium transition">
            Lire la suite →
          </a>
        </div>
      </div>

      <!-- Carte auteur -->
      <div class="lg:w-1/3 flex flex-col items-center text-center bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
        <div class="w-60 h-60 rounded-full overflow-hidden border-4 border-[#203c89] shadow-sm mb-4">
          <img 
            src="{{ asset('images/default-category.jpg') }}" 
            alt="Photo de l’auteur" 
            class="w-full h-full object-cover"
          >
        </div>

        <h4 class="text-2xl font-semibold text-[#203c89]">Nom Auteur</h4>
        <p class="text-sm text-gray-500 mt-2 max-w-xs">
          Description de l’auteur avec quelques lignes pour le présenter, son expertise ou son rôle.
        </p>

        <div class="mt-4 flex gap-3">
          <a href="#" class="text-[#203c89] hover:text-[#007aff] text-4xl ">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-[#203c89] hover:text-[#007aff] text-4xl ">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-[#203c89] hover:text-[#007aff] text-4xl ">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>
    </div>

  </div>
</section>
<section class="max-w-7xl mx-auto py-8">
  <div class="w-2/3 ">
     <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
    @foreach ($posts as $post)
      <article class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col h-full">
        @if($post->image)
          <a href="{{ route('posts.show', $post->slug) }}" class="block">
            <img src="{{ asset('storage/' . $post->image) ?? asset('images/default-category.jpg') }}" alt="{{ $post->title }}" class="w-full h-40 md:h-44 object-cover">
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
            {{ Str::limit(strip_tags($post->content), 120) }}
          </p>

          <div class="mt-2">
            <a href="{{ route('posts.show', $post->slug) }}" class="inline-block bg-[#203c89] hover:bg-[#172d63] text-white px-4 py-2 rounded">
              Lire la suite
            </a>
          </div>
        </div>
      </article>
    @endforeach
  </div>
  </div>

 
 
</section>
<section class=" relative w-screen left-1/2 -translate-x-1/2 bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 ">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Explorez nos catégories</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="flex flex-col items-center text-center bg-[#203c89] border border-gray-100 shadow-sm rounded-2xl p-4 hover:shadow-lg hover:-translate-y-1 transition">
                   
                    <div class="w-16 h-16 mb-3 rounded-full overflow-hidden bg-gray-100 border border-gray-200">
                        <img src="{{ $category->image ?? asset('images/default-category.jpg') }}"
                             alt="{{ $category->name }}"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="font-semibold text-white">{{ $category->name }}</h3>

                    <p class="text-sm text-white mt-1">
                        {{ $category->posts_count ?? 0 }}
                        {{ ($category->posts_count ?? 0) > 1 ? 'posts' : 'post' }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>



<section class="max-w-7xl mx-auto py-16">
<h1 class="mb-6 text-2xl font-bold">Derniers articles</h1>

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
                    {{ Str::limit(strip_tags($post->content), 120) }}
                </p>

                <div class="mt-2">
                    <a href="{{ route('posts.show', $post->slug) }}" class="inline-block bg-[#203c89] hover:bg-[#172d63] text-white px-4 py-2 rounded">
                        Lire la suite
                    </a>
                </div>
            </div>
        </article>
    @endforeach
</div>
</section>
--}}




<section class="relative w-screen left-1/2 -translate-x-1/2 flex flex-col items-center text-center py-20 px-6 lg:px-16 bg-cover bg-center shadow-md min-h-[320px]" 
    style="background-image: url('{{ asset('images/bg-home.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Contenu -->
    <div class="relative z-10 max-w-4xl">
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight py-4">
            Meilleur magazine <br> de formation
        </h1>

        <p class="text-white font-medium mt-4 text-base md:text-lg">
            Découvrez des articles passionnants sur divers sujets, rédigés par des experts et des passionnés. 
            Restez informé des dernières tendances, astuces et conseils pour enrichir vos connaissances.
        </p>

        <button class="mt-6 px-8 py-3 bg-[#007aff] text-white font-bold rounded-lg hover:bg-[#172d63] transition">
            Lire la suite
        </button>
    </div>
</section>

<!-- Section principale -->
<section class="max-w-7xl mx-auto  md:px-6 lg:px-8 py-16 flex flex-col lg:flex-row gap-12">

    <!-- 📰 Colonne Articles -->
    <div class="flex-1">
        <h2 class="text-2xl font-bold mb-2">Derniers articles</h2>
        <div class="w-24 h-1 bg-[#007aff] rounded-full mb-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($latestPosts as $post)
                <article class="bg-white rounded-lg shadow hover:shadow-lg transition flex flex-col overflow-hidden">
                    @if($post->image)
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        </a>
                    @endif

                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-[#007aff]">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-sm text-gray-500 mb-2">
                            Catégorie :
                            <span class="text-[#203c89] font-medium">{{ $post->category->name ?? 'Non classé' }}</span>
                        </p>

                        <p class="text-gray-700 text-sm flex-1 mb-4">
                            {!!Str::limit(strip_tags($post->content), 120)!!}
                        </p>

                        <a href="{{ route('posts.show', $post->slug) }}" class="self-start bg-[#203c89] hover:bg-[#172d63] text-white px-4 py-2 rounded transition">
                            Lire la suite
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
      
 @if($relatedCategory && $relatedPosts->count())
<section class="max-w-7xl mx-auto py-12 ">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Articles dans « {{ $relatedCategory->name }} »</h2>
        <a href="{{ route('categories.show', $relatedCategory->slug) }}" class="text-sm text-[#203c89] hover:underline">Voir la catégorie →</a>
    </div>

    <div class="flex flex-col gap-6">
        @foreach($relatedPosts as $post)
            <article class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row">
                @if($post->image)
                    <a href="{{ route('posts.show', $post->slug) }}" class="block md:flex-shrink-0">
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="{{ $post->title }}"
                             class="w-full md:w-56 h-48 md:h-40 object-cover">
                    </a>
                @endif

                <div class="p-4 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-[#007aff]">
                                {{ Str::limit($post->title, 70) }}
                            </a>
                        </h3>

                        <p class="text-sm text-gray-500 mb-3">
                            {!! Str::limit(strip_tags($post->content), 120) !!}
                        </p>
                    </div>

                    <div class="mt-4 flex items-center justify-between text-end text-xs text-gray-500">
                        <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('d/m/Y') }}</time>
                        
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endif

    </div>
    

    <!-- 🧑‍💼 Colonne Sidebar -->
    <aside class="w-full lg:w-1/3 flex flex-col gap-12">

        <!-- À propos -->
        <div>
            <div class="flex items-center justify-center gap-2 mb-6">
                <div class="flex-1 h-[2px] bg-[#007aff]"></div>
                <h2 class="text-2xl font-bold">À propos</h2>
                <div class="flex-1 h-[2px] bg-[#007aff]"></div>
            </div>

            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6 flex flex-col items-center text-center">
                <div class="w-48 h-48 md:w-60 md:h-60 rounded-full overflow-hidden border-4 border-[#203c89] mb-4">
                    <img src="{{ asset('images/default-category.jpg') }}" alt="Photo de l’auteur" class="w-full h-full object-cover">
                </div>

                <h3 class="text-2xl font-semibold text-[#203c89]">ITTE Consulting</h3>
                <p class="text-sm text-gray-500 mt-2 max-w-xs">
                    Description de l’auteur avec quelques lignes pour le présenter, son expertise ou son rôle.
                </p>

                <div class="mt-4 flex gap-4">
                    <a href="#" class="text-[#203c89] hover:text-[#007aff] text-2xl">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-[#203c89] hover:text-[#007aff] text-2xl">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-[#203c89] hover:text-[#007aff] text-2xl">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Articles populaires -->
        <div>
            <div class="flex items-center justify-center gap-2 mb-6">
                <div class="flex-1 h-[2px] bg-[#007aff]"></div>
                <h2 class="text-2xl font-bold">Articles populaires</h2>
                <div class="flex-1 h-[2px] bg-[#007aff]"></div>
            </div>

            <div class="space-y-4">
                @foreach ($posts as $post)
                    <div class="flex items-start gap-4">
                        @if($post->image)
                            <a href="{{ route('posts.show', $post->slug) }}" class="w-20 h-20 flex-shrink-0">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-full">
                            </a>
                        @endif
                        <div>
                            <h3 class="text-md font-semibold">
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-[#007aff]">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500">
                                Publié le {{ $post->published_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Catégories -->
        <div>
            <div class="flex items-center justify-center gap-2 mb-6">
                <div class="flex-1 h-[2px] bg-[#007aff]"></div>
                <h2 class="text-2xl font-bold">Catégories</h2>
                <div class="flex-1 h-[2px] bg-[#007aff]"></div>
            </div>

            <div class="flex flex-col gap-4">
                @foreach ($tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}" 
                       class="relative bg-blue-100 flex justify-between items-center rounded-lg shadow-md p-4 transition duration-300 group overflow-hidden">

                        <h3 class="text-lg font-semibold text-[#203c89] w-2/3 relative z-10">{{ $tag->name }}</h3>
                        <p class="text-sm text-gray-500 w-1/3 text-right relative z-10">{{ $tag->posts_count }} articles</p>

                        <!-- Fond image au hover -->
                        <div class="absolute inset-0 bg-center bg-cover opacity-0 group-hover:opacity-100 transition duration-500"
                             style="background-image: url('{{ asset('images/home-bloga.png') }}');">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </aside>
</section>


@if(isset($categoryBlocks) && $categoryBlocks->count())
<section class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-16 px-4">
    @foreach($categoryBlocks as $category)
    <div class="w-full">
        <h2 class="text-2xl font-bold mb-2 truncate">{{ $category->name }} </h2>
        <div class="w-24 h-1 bg-[#007aff] rounded-full mb-6"></div>

        <div class="space-y-4 ">
            @foreach($category->posts->take(4) as $post)
                <div class="flex items-start gap-4">
                    @if($post->image)
                        <a href="{{ route('posts.show', $post->slug) }}" class="w-28 h-28 flex-shrink-0">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-lg">
                        </a>
                    @endif
                    <div class="flex-1">
                        <h3 class="text-md font-semibold">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-gray-900 hover:text-[#007aff]">
                                {{ Str::limit($post->title, 70) }}
                            </a>
                        </h3>
                        <p class="text-xs text-gray-500">
                            Publié le {{ $post->published_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach
</section>
@endif



<section class="category-section relative w-screen left-1/2 -translate-x-1/2   bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold mb-4">Explorez nos catégories</h2>
        <p class="text-gray-700 mb-6">Découvrez une variété de sujets passionnants à travers nos différentes catégories.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="flex flex-col items-center text-center bg-[#f9fafb] border border-gray-200 shadow-sm rounded-2xl p-4 hover:shadow-lg transition">
                   
                    <div class="w-16 h-16 mb-3 rounded-full overflow-hidden bg-gray-100 border border-gray-300">
                        <img src="{{ $category->image ?? asset('images/default-category.jpg') }}"
                             alt="{{ $category->name }}"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="font-semibold text-gray-800">{{ $category->name }}</h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $category->posts_count ?? 0 }}
                        {{ ($category->posts_count ?? 0) > 1 ? 'posts' : 'post' }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>

</section>


<section class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold mb-4">Abonnez-vous à notre newsletter</h2>
        <p class="text-gray-700 mb-6">Recevez les dernières nouvelles et mises à jour directement dans votre boîte de réception.</p>
        <form action="" method="POST" class="flex flex-col sm:flex-row justify-center gap-4">
            @csrf
            <input type="email" name="email" placeholder="Votre adresse e-mail" required
                   class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#007aff]">
            <button type="submit"
                    class="px-6 py-2 bg-[#007aff] text-white font-bold rounded-lg hover:bg-[#172d63] transition">
                S'abonner
            </button>
        </form>
    </div>

</section>

@endsection