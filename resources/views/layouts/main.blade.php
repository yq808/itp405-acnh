<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/png" href="{{url('img/website-icon.png')}}">
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet">
    @yield("unique-css")

    <title>Crossing Builds | @yield("title")</title>
</head>
<body>
    <header>
        <div class="nav-links">
            <a href="{{ route('build.search') }}">Search</a>
            @if (Auth::check())
                <a href="{{ route('build.create') }}">Add</a>
            @endif
            @if (Auth::check())
                <a href="{{ route('favorite.index') }}">Favorites</a>
            @endif
        </div>
        <div id="logo">
            <h1>
                <a href="{{ route('build.index') }}">Crossing Builds</a>
            </h1>
        </div>
        <div class="nav-links">
            @if (Auth::check())
                <a href="{{ route('profile.index') }}">{{ Auth::user()->username }}</a>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="btn button-link">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register.create') }}">Register</a>
            @endif
        </div>
    </header>

    <div class="content">
        {{-- @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif --}}

        @yield("content")
    </div>

    <div class="bottom-nav">
        <div>
            <h3>Crossing Builds</h3>
        </div>
        <div>
            <a href="{{ route('build.search') }}">Search</a>
            @if (Auth::check())
                <a href="{{ route('build.create') }}">Add</a>
            @endif
            @if (Auth::check())
                <a href="{{ route('favorite.index') }}">Favorites</a>
            @endif
        </div>
        @if (Auth::check())
        <div>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit" class="btn button-link">Logout</button>
            </form>
        </div>
            
        @else
            <div>
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register.create') }}">Register</a>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Copyright © 2022 Crossing Builds. All Rights Reserved.</p>
        <p>ITP 405 Final Project</p>
    </div>

    <script src="https://kit.fontawesome.com/263c3a4efc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @yield("optional-js")
</body>
</html>