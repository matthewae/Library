<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Librarree</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-light: #F8F8F8;
            --bg-dark: #E0E0E0;
            --primary-color: #FF6B6B; /* Merah */
            --secondary-color: #FFD166; /* Kuning */
            --text-dark: #333333;
            --text-light: #666666;
            --border-color: #EAEAEA;
            --shelf-color: #F0EAD6;
            --sidebar-bg: rgb(74, 74, 74);
            --card-bg: #FFFFFF;
            --active-link-bg: #FFF8E1;
            --active-link-text: #E69500;
            --libraree-orange: #FF8C42; /* Warna oranye dari logo Librarree */
            --libraree-light-orange: #FFE0B2; /* Warna oranye muda untuk background */
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--libraree-light-orange); /* Menggunakan warna oranye muda */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-dark);
            overflow: hidden; /* Untuk menyembunyikan scrollbar jika ada gambar */
            position: relative;
        }

        .bg-element {
            position: absolute;
            opacity: 0.7;
            z-index: 0;
        }

        .bg-plant {
            top: 5%;
            left: 5%;
            width: 100px;
        }

        .bg-red-book {
            top: 10%;
            right: 10%;
            width: 80px;
        }

        .bg-yellow-book {
            top: 18%;
            right: 8%;
            width: 70px;
        }

        .bg-sticky-notes {
            bottom: 10%;
            left: 8%;
            width: 90px;
        }

        .bg-purple-pencil {
            bottom: 15%;
            right: 12%;
            width: 60px;
        }

        .bg-blue-pencil {
            bottom: 8%;
            right: 10%;
            width: 70px;
        }

        .login-container {
            background-color: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .login-container h2 {
            font-size: 32px;
            font-weight: 700;
            color: var(--libraree-orange);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: calc(100% - 24px); /* Adjust for padding */
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            outline: none;
            border-color: var(--libraree-orange);
            box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.2);
        }

        .form-group .invalid-feedback {
            display: block;
            color: var(--primary-color); /* Merah untuk error */
            font-size: 13px;
            margin-top: 5px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .remember-me label {
            display: flex;
            align-items: center;
            color: var(--text-dark);
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 8px;
            width: 18px;
            height: 18px;
            accent-color: var(--libraree-orange); /* Warna checkbox */
        }

        .forgot-password {
            color: var(--libraree-orange);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: var(--primary-color);
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: var(--libraree-orange);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .login-button:hover {
            background-color: #E67E30; /* Sedikit lebih gelap */
            transform: translateY(-2px);
        }

        .register-link {
            margin-top: 25px;
            font-size: 15px;
            color: var(--text-dark);
        }

        .register-link a {
            color: var(--libraree-orange);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: var(--primary-color);
        }


        @media (max-width: 768px) {
            .login-container {
                margin: 20px;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login to Librarree</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">{{ __('Username') }}</label>
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>



            <button type="submit" class="login-button">
                {{ __('Login') }}
            </button>

            <p class="register-link">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </form>
    </div>
</body>
</html>
