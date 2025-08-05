<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Librarree</title>
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

    .header-logo {
      position: fixed;
      top: 20px;
      left: 30px;
      z-index: 100;
      display: flex;
      align-items: center;
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo {
      width: 45px;
      height: 45px;
    }

    .logo-text {
      font-size: 22px;
      font-weight: 600;
      color: #333;
    }

    .main-layout {
      display: flex;
      width: 100%;
      height: 100vh;
    }

    .left-section {
      flex: 1;
      background-color: #8B7355;
      padding: 100px 50px 50px;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .left-section h1 {
      font-size: 3.5em;
      font-weight: 800;
      margin: 0 0 10px 0;
    }

    .left-section p {
      font-size: 1em;
      line-height: 1.6;
      max-width: 600px;
      margin-bottom: 30px;
    }

    .search-bar {
      display: flex;
      max-width: 500px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .search-bar input {
      flex-grow: 1;
      padding: 15px 20px;
      border: none;
      font-size: 1em;
      outline: none;
    }

    .search-bar button {
      background-color: var(--libraree-orange);
      color: white;
      border: none;
      padding: 15px 25px;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .search-bar button:hover {
      background-color: #E67E30;
    }

    .right-section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: var(--libraree-light-orange);
    }

    .login-container {
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

    .login-title {
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

    .password-toggle {
      cursor: pointer;
      margin-left: auto; /* Pushes the icon to the right */
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      border: 1px solid #c3e6cb;
      text-align: center;
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
      background-color: #E67E30;
      transform: translateY(-2px);
    }

    .register-link {
      margin-top: 25px;
      font-size: 15px;
      color: #000;
    }

    .register-link a {
      color: var(--libraree-orange);
      text-decoration: none;
      font-weight: 600;
    }

    .register-link a:hover {
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

    .book-image {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 200px; /* Adjust size as needed */
      opacity: 0.5; /* Make it subtle */
      z-index: 0;
    }

    @media (max-width: 768px) {
      .book-image {
        display: none; /* Hide on smaller screens if it obstructs content */
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
      .main-layout {
        flex-direction: column;
        height: auto;
      }

      .left-section,
      .right-section {
        width: 100%;
        padding: 30px 20px;
        text-align: center;
      }

      .login-container {
        margin: 20px;
      }

      .search-bar {
        max-width: 100%;
        flex-direction: column;
      }

      .search-bar input,
      .search-bar button {
        width: 100%;
        border-radius: 0;
      }

      .search-bar button {
        border-radius: 0 0 10px 10px;
      }

      .header-logo {
        position: static;
        justify-content: center;
        margin: 20px 0;
      }
    }
  </style>
</head>

<body>
  <img src="{{ asset('images/book.png') }}" alt="Book Image" class="book-image">
  <!-- LOGO -->
  <div class="header-logo">
    <div class="logo-container">
      <img src="{{ asset('images/logo fix2.png') }}" alt="Libraree Logo" class="logo" />
      <span class="logo-text">Librarree</span>
    </div>
  </div>

  <!-- LAYOUT -->
  <div class="main-layout">
    <div class="left-section">
      <h1>Online Library</h1>
      <p>Welcome to Librarree — the official e-Library of PT. Mandajaya Rekayasa Konstruksi. This platform provides open access to a wide range of documents, technical references, and learning resources for anyone seeking knowledge in the fields of construction, engineering, and innovation.</p>
      <form action="/search-books" method="GET" class="search-bar">
        <input type="text" name="title" placeholder="Find your book here" />
        <button type="submit">Search Book</button>
      </form>
    </div>

    <div class="right-section">
      <div class="login-container">
        <h2 class="login-title">Login to Librarree</h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="username">Username</label>
            <div class="input-wrapper">
              <span class="input-icon">👤</span>
              <input type="text" id="username" name="username" placeholder="Enter your username" required />
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
              <span class="input-icon password-toggle" onclick="togglePasswordVisibility()">👁️</span>
            </div>
            @error('password')
            <span class="text-danger" role="alert">{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="login-button">Login</button>
        </form>

        <p class="register-link">
          Don't have an account?
          <a href="{{ route('register') }}">Register here</a>
        </p>
        <p class="back-link">
          <a href="{{ route('user.index') }}">Back to Home</a>
        </p>
      </div>
    </div>
  </div>
<script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const passwordToggle = document.querySelector('.password-toggle');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.textContent = '🙈';
      } else {
        passwordInput.type = 'password';
        passwordToggle.textContent = '👁️';
      }
    }
  </script>
</body>

</html>
            </div>
          </div>
