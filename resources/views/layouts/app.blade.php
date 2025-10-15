<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Blog')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Mon Blog</a>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<footer class="text-center mt-5 py-4 bg-dark text-white">
    <small>&copy; {{ date('Y') }} Mon Blog - Tous droits réservés</small>
</footer>

</body>
</html>
