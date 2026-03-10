<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gallery</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #EDE7F6; display: flex; justify-content: center; align-items: center; height: 100vh; color: #311B92; }
        .card { background-color: #FFFFFF; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(81, 45, 168, 0.1); width: 100%; max-width: 400px; border-top: 4px solid #7E57C2; }
        .card h2 { text-align: center; margin-bottom: 20px; color: #512DA8; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px; color: #311B92; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #D1C4E9; border-radius: 6px; outline: none; font-size: 14px; transition: 0.3s; }
        .form-group input:focus { border-color: #7E57C2; box-shadow: 0 0 5px rgba(126, 87, 194, 0.3); }
        .btn { width: 100%; padding: 12px; background-color: #7E57C2; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s; }
        .btn:hover { background-color: #512DA8; box-shadow: 0 4px 8px rgba(81, 45, 168, 0.2); }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 6px; font-size: 14px; text-align: center; font-weight: 500; }
        .alert-success { background-color: #D1C4E9; color: #311B92; border: 1px solid #B39DDB; }
        .alert-danger { background-color: #FFCDD2; color: #B71C1C; border: 1px solid #EF9A9A; }
        .link { text-align: center; margin-top: 15px; font-size: 14px; }
        .link a { color: #7E57C2; text-decoration: none; font-weight: bold; }
        .link a:hover { text-decoration: underline; color: #512DA8; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Gallery</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" id="Username" name="Username" required autofocus>
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" id="Password" name="Password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>
</body>
</html>