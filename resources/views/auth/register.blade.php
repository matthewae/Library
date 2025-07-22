<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Librarree</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --libraree-orange: #FF8C42;
      --libraree-light-orange: #FFE0B2;
      --primary-color: #FF6B6B;
      --border-color: #EAEAEA;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background-color: var(--libraree-light-orange);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #333;
      overflow: hidden;
      position: relative;
    }

    .register-container {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(14px);
      padding: 45px 35px;
      width: 100%;
      max-width: 420px;
      text-align: center;
      animation: fadeIn 0.8s ease-in-out;
      color: #000;
    }

    .register-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 25px;
      color: var(--libraree-orange);
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
      color: #000;
    }

    .input-wrapper {
      display: flex;
      align-items: center;
      background: rgba(255, 255, 255, 0.6);
      border-radius: 10px;
      padding: 10px 15px;
      border: 1px solid var(--border-color);
      transition: border-color 0.3s ease;
    }

    .input-wrapper:focus-within {
      border-color: var(--libraree-orange);
    }

    .input-icon {
      margin-right: 10px;
      font-size: 1.2em;
      color: #000;
    }

    .input-wrapper input {
      background: transparent;
      border: none;
      outline: none;
      flex: 1;
      font-size: 16px;
      color: #000;
    }

    .input-wrapper input::placeholder {
      color: rgba(0, 0, 0, 0.5);
    }

    .register-button {
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

    .register-button:hover {
      background-color: #E67E30;
      transform: translateY(-2px);
    }

    .login-link {
      margin-top: 25px;
      font-size: 15px;
      color: #000;
    }

    .login-link a {
      color: var(--libraree-orange);
      text-decoration: none;
      font-weight: 600;
    }

    .login-link a:hover {}

    .text-danger {
      color: #dc3545;
      font-size: 0.875em;
      margin-top: 5px;
      text-align: left;
    }

    .input-wrapper {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 15px;
      cursor: pointer;
      color: #000;
    }
      color: var(--primary-color);
    }

    .back-link {
      margin-top: 15px;
      font-size: 15px;
      color: #000;
    }

    .back-link a {
      color: var(--libraree-orange);
      text-decoration: none;
      font-weight: 600;
    }

    .back-link a:hover {
      color: var(--primary-color);
    }

    @keyframes fadeIn {
      from {
        transform: translateY(15px);
        opacity: 0;
      }

      to {
        transform: translateY(0px);
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      .register-container {
        padding: 30px 20px;
        margin: 20px;
      }

      .register-title {
        font-size: 24px;
      }

      label {
        font-size: 14px;
      }

      .input-wrapper {
        padding: 8px 12px;
      }

      .input-wrapper input {
        font-size: 15px;
      }

      .register-button {
        padding: 12px;
        font-size: 16px;
      }

      .login-link,
      .back-link {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <div class="register-container">
    <h2 class="register-title">Register to Librarree</h2>
    @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <div class="input-wrapper">
          <span class="input-icon">👤</span>
          <input type="text" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required autofocus />
        </div>
        @error('name')
        <span class="text-danger" role="alert">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <div class="input-wrapper">
          <span class="input-icon">👤</span>
          <input type="text" id="username" name="username" placeholder="Enter your username" value="{{ old('username') }}" required />
        </div>
        @error('username')
        <span class="text-danger" role="alert">{{ $message }}</span>
        @enderror
      </div>


      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <span class="input-icon">🔒</span>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
          <span class="toggle-password" onclick="togglePasswordVisibility('password')">👁️</span>
        </div>
        @error('password')
        <span class="text-danger" role="alert">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <div class="input-wrapper">
          <span class="input-icon">🔒</span>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required />
          <span class="toggle-password" onclick="togglePasswordVisibility('password_confirmation')">👁️</span>
        </div>
        @error('password_confirmation')
        <span class="text-danger" role="alert">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="register-button">Register</button>
    </form>

    <p class="login-link">
      Already have an account?
      <a href="{{ route('login') }}">Login here</a>
    </p>
    <p class="back-link">
      <a href="{{ route('user.index') }}">Back to Home</a>
    </p>
  </div>
</body>
<script>
  function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    function validatePasswordConfirmation() {
      if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordInput.setCustomValidity('Passwords do not match');
      } else {
        confirmPasswordInput.setCustomValidity('');
      }
    }

    passwordInput.addEventListener('change', validatePasswordConfirmation);
    confirmPasswordInput.addEventListener('keyup', validatePasswordConfirmation);
  });
</script>

</html>
