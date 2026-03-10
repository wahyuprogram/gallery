<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gallery')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #EDE7F6; color: #311B92; }
        
        nav { background-color: #512DA8; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 10px rgba(81, 45, 168, 0.2); }
        .nav-brand { color: #FFFFFF; font-size: 24px; font-weight: bold; text-decoration: none; letter-spacing: 1px; }
        .nav-links { display: flex; gap: 25px; align-items: center; }
        .nav-links a { color: #D1C4E9; text-decoration: none; font-size: 16px; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: #FFFFFF; }
        
        .btn-logout { background-color: #311B92; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background 0.3s; }
        .btn-logout:hover { background-color: #1A0E4F; }
        
        .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        .card { background-color: #FFFFFF; border-radius: 12px; padding: 30px; box-shadow: 0 4px 15px rgba(81, 45, 168, 0.08); }
        .card-title { color: #512DA8; margin-bottom: 15px; border-bottom: 2px solid #EDE7F6; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;}
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="nav-brand">Gallery</a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>
            
            @if(auth()->user()->Role == 'admin')
                <a href="{{ route('album.index') }}">Kelola Album</a>
                <a href="{{ route('foto.index') }}">Kelola Foto</a>
            @endif
            
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Logout ({{ auth()->user()->Username }})</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('error'))
            <div style="background-color: #FFCDD2; color: #B71C1C; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-weight: bold; text-align: center; border: 1px solid #EF9A9A;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>