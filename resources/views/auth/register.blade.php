<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Gallery</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #EDE7F6; display: flex; justify-content: center; align-items: center; min-height: 100vh; color: #311B92; padding: 20px; }
        .card { background-color: #FFFFFF; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(81, 45, 168, 0.1); width: 100%; max-width: 500px; border-top: 4px solid #7E57C2; }
        .card h2 { text-align: center; margin-bottom: 20px; color: #512DA8; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px; color: #311B92; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #D1C4E9; border-radius: 6px; outline: none; font-size: 14px; transition: 0.3s; }
        .form-group textarea { resize: vertical; min-height: 80px; }
        .form-group input:focus, .form-group textarea:focus { border-color: #7E57C2; box-shadow: 0 0 5px rgba(126, 87, 194, 0.3); }
        .btn { width: 100%; padding: 12px; background-color: #7E57C2; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s; margin-top: 10px; }
        .btn:hover { background-color: #512DA8; box-shadow: 0 4px 8px rgba(81, 45, 168, 0.2); }
        .error { color: #E53935; font-size: 12px; margin-top: 5px; }
        .link { text-align: center; margin-top: 15px; font-size: 14px; }
        .link a { color: #7E57C2; text-decoration: none; font-weight: bold; }
        .link a:hover { text-decoration: underline; color: #512DA8; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Buat Akun</h2>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" id="Username" name="Username" value="{{ old('Username') }}" required autofocus>
                @error('Username') <div class="error">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" value="{{ old('Email') }}" required>
                @error('Email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" id="Password" name="Password" required>
                @error('Password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="NamaLengkap">Nama Lengkap</label>
                <input type="text" id="NamaLengkap" name="NamaLengkap" value="{{ old('NamaLengkap') }}" required>
                @error('NamaLengkap') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="Alamat">Alamat</label>
                <textarea id="Alamat" name="Alamat" required>{{ old('Alamat') }}</textarea>
                @error('Alamat') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn">Daftar</button>
        </form>
        <div class="link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>