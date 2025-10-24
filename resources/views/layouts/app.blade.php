<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">

</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-[#203c89] py-4 ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo-therarh.png') }}" alt="Logo"
                     class="h-10 w-10 md:h-12 md:w-12 lg:h-16 lg:w-16 object-contain bg-white rounded-lg p-1">
            </a>

            <!-- desktop links -->
            <div class="hidden lg:flex lg:items-center lg:space-x-2">
                <a href="{{ route('home') }}" class="text-white px-3 py-2 rounded hover:bg-white/10">Accueil</a>
                <a href="{{ route('posts.index') }}" class="text-white px-3 py-2 rounded hover:bg-white/10">Articles</a>
                <a href="{{ route('categories.index') }}" class="text-white px-3 py-2 rounded hover:bg-white/10">Catégories</a>
            </div>
        </div>

        <!-- desktop search -->
        <div class="hidden lg:flex lg:items-center">
            <form class="flex items-center" action="" method="GET">
                <input
                    class="px-3 py-2 rounded bg-white text-black placeholder:text-black focus:outline-none focus:ring-2 focus:ring-white/30"
                    type="search" name="query" placeholder="Rechercher..." aria-label="Search">
                <button class="ml-2 px-3 py-2 rounded bg-white/10 text-white hover:bg-white/20" type="submit">Rechercher</button>
            </form>
        </div>

        <!-- mobile menu button -->
        <div class="lg:hidden">
            <button type="button" aria-label="Ouvrir le menu"
                    class="text-white p-2 rounded-md hover:bg-white/10"
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- mobile menu -->
    <div id="mobile-menu" class="lg:hidden hidden px-4 pb-4">
        <ul class="flex flex-col space-y-2 mt-2">
            <li><a href="{{ route('home') }}" class="block px-3 py-2 rounded text-white hover:bg-white/10">Accueil</a></li>
            <li><a href="{{ route('posts.index') }}" class="block px-3 py-2 rounded text-white hover:bg-white/10">Articles</a></li>
            <li><a href="{{ route('categories.index') }}" class="block px-3 py-2 rounded text-white hover:bg-white/10">Catégories</a></li>
        </ul>

        <form class="mt-3 flex" action="" method="GET">
            <input
                class="flex-1 px-3 py-2 rounded-l bg-white text-black placeholder:text-black focus:outline-none"
                type="search" name="query" placeholder="Rechercher..." aria-label="Search">
            <button class="px-3 py-2 rounded-r bg-white/10 text-white hover:bg-white/20" type="submit">OK</button>
        </form>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 ">
    @yield('content')
</main>

<footer class="bg-gray-900 text-white py-4 text-center">
    <small>&copy; {{ date('Y') }} Mon Blog - Tous droits réservés</small>
</footer>

</body>
</html>
