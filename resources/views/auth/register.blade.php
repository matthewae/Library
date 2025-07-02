<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Librarree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --orange: #FF8C42;
            --light-orange: #FFE0B2;
            --primary-text: #333;
            --white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.25);
            --border-color: #e0e0e0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5af19 0%, #f12711 100%); /* More modern gradient */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            background: var(--glass-bg);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); /* Enhanced shadow */
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            padding: 40px 30px;
            color: var(--primary-text);
            animation: fadeIn 0.8s ease-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            color: #000; /* Changed to black */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Added text shadow */
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 6px;
            color: var(--primary-text);
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px; /* Slightly smaller border-radius for inputs */
            border: 1px solid var(--border-color);
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Added box-shadow transition */
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            border-radius: 8px; /* Consistent border-radius */
            border: 1px solid var(--border-color);
            transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Added box-shadow transition */
            padding-right: 10px; /* Add some padding for the icon */
        }

        .input-wrapper input {
            flex-grow: 1;
            border: none;
            padding: 12px 0px 12px 14px; /* Adjust padding for input inside wrapper */
        }

        .input-icon {
            cursor: pointer;
            color: var(--primary-text);
            font-size: 1.2em;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.3);
        }

        .input-wrapper:focus-within {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.3);
        }

        small.text-danger {
            color: red;
            font-size: 12px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--orange);
            border: none;
            border-radius: 8px; /* Slightly smaller border-radius for button */
            font-size: 16px;
            color: var(--white);
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .btn-submit:hover {
            background-color: #e6762f;
            transform: translateY(-2px);
        }

        .footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.95em;
            color: var(--primary-text);
        }

        .footer-link a {
            color: #000; /* Changed to black */
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-link a:hover {
            color: #ff5a00;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .register-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Your Librarree Account</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>



            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" required>
                    <span class="input-icon password-toggle" onclick="togglePasswordVisibility('password')"><i class="fa-solid fa-eye"></i></span>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password-confirm" name="password_confirmation" required>
                    <span class="input-icon password-toggle" onclick="togglePasswordVisibility('password-confirm')"><i class="fa-solid fa-eye"></i></span>
                </div>
            </div>

            <button type="submit" class="btn-submit">Register</button>
        </form>

        <div class="footer-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            const passwordToggle = passwordInput.nextElementSibling.querySelector('i'); // Get the <i> element
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
