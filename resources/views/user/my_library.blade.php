<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readowl - My Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-light: #F8F8F8;
            --bg-dark: #E0E0E0;
            --primary-color: #FF6B6B;
            --secondary-color: #FFD166;
            --text-dark: #333333;
            --text-light: #666666;
            --border-color: #EAEAEA;
            --shelf-color: #F0EAD6;
            --sidebar-bg:rgb(109, 109, 109); /* Light gray for better logo visibility */
            --card-bg: #FFFFFF;
            --active-link-bg: #FFF8E1;
            --active-link-text: #E69500;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-light);
            display: flex;
            min-height: 100vh;
            color: var(--text-dark);
            position: relative; /* Needed for fixed sidebar */
        }

        .sidebar {
            width: 250px;
            background-color:rgb(74, 74, 74); /* Darker gray */
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            height: 100vh; /* Use 100vh for full viewport height */
            overflow-y: auto;
            z-index: 1000; /* Ensure sidebar is on top */
            top: 0;
            left: 0;
        }

        .logo {
            display: flex;
            flex-direction: column; /* Stack logo and title vertically */
            align-items: center;
            margin-bottom: 40px;
            padding-left: 0; /* Remove padding-left */
        }

        .logo img {
            max-width: 120px; /* Increased size */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 0; /* Adjusted margin */
        }

        .logo h1 {
            font-size: 28px; /* Adjusted font size */
            font-weight: 700;
            color: var(--primary-color);
            margin-top: 10px; /* Add margin to separate from logo image */
        }

        .nav-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-menu li {
            margin-bottom: 15px;
        }

        .nav-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px; /* Increased horizontal padding */
            border-radius: 10px;
            color: #FFFFFF; /* White color for non-active links */
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s, transform 0.2s; /* Added transform for hover effect */
        }

        .nav-menu a:hover {
            background-color: var(--active-link-bg);
            color: var(--primary-color); /* Use primary color on hover */
            transform: translateX(5px); /* Slight move on hover */
        }

        .nav-menu a.active {
            background-color: var(--active-link-bg);
            color: var(--primary-color); /* Primary color for active link */
        }

        .nav-menu a svg {
            margin-right: 15px;
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .reading-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            margin-top: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .reading-card img {
            width: 80px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .reading-card p {
            font-size: 14px;
            color: var(--text-light);
            margin: 0 0 5px;
        }

        .reading-card h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 15px;
            color: var(--text-dark);
        }

        .user-profile {
            display: flex;
            align-items: center;
            padding: 0;
            border-top: none;
            margin-top: 0;
        }

        .user-profile img {
            display: none; /* Hide the user profile image */
        }

        .user-profile .user-info h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark); /* Changed to dark text */
        }

        .user-profile .user-info p {
            margin: 0;
            font-size: 13px;
            color: var(--text-light); /* Changed to light text */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            width: 100%; /* Ensure header takes full width */
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px; /* Space between elements in header right */
        }

        .logout-button-container form {
            margin-top: 0; /* Remove top margin */
            padding-bottom: 0; /* Remove bottom padding */
        }

        .logout-button-container .btn {
            padding: 8px 15px; /* Adjust padding for a smaller button */
            font-size: 14px; /* Adjust font size */
            border-radius: 5px; /* Adjust border radius */
            background-color: var(--primary-color); /* Use primary color */
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        .logout-button-container .btn:hover {
            background-color: #E65A5A; /* Slightly darker primary color on hover */
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
                padding: 15px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 20px;
            }

            .header-right {
                margin-top: 15px;
                width: 100%;
                justify-content: space-between;
            }

            .search-bar {
                width: 100%;
                margin-bottom: 15px;
            }

            .book-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .book-card {
                width: 100%;
            }
        }

        .main-content {
            flex-grow: 1;
            margin-left: 250px; /* Offset for fixed sidebar */
            padding: 50px; /* Increased left padding */
            overflow-y: auto;
            width: calc(100% - 250px); /* Ensure content takes remaining width */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-bar {
            position: relative;
            width: 400px;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px 12px 50px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 16px;
            background-color: var(--card-bg);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: border-color 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .search-bar svg {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            fill: var(--text-light);
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .tabs button {
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            background-color: var(--bg-dark);
            color: var(--text-dark);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .tabs button.active {
            background-color: var(--primary-color);
            color: white;
        }

        .shelf-section {
            margin-bottom: 50px;
        }

        .shelf-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .shelf-header h3 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            color: var(--text-dark);
        }

        .shelf-header a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .shelf-header a svg {
            margin-left: 5px;
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .shelf {
            background-color: var(--shelf-color);
            border-radius: 10px;
            padding: 30px 20px;
            display: flex;
            gap: 25px;
            overflow-x: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            min-height: 200px; /* Ensure shelf has height */
            align-items: flex-end; /* Align books to the bottom of the shelf */
        }

        .book-item {
            background-color: var(--card-bg);
            border-radius: 12px; /* Slightly larger border-radius */
            padding: 20px; /* Increased padding */
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); /* Stronger shadow */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out; /* Added box-shadow transition */
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .book-item img {
            width: 100%;
            height: 200px; /* Increased height for book covers */
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px; /* Increased margin */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); /* Stronger shadow */
        }

        .book-item:hover {
            transform: translateY(-8px); /* More pronounced lift on hover */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); /* Stronger shadow on hover */
        }

        .book-item p {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-light);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-light);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <div class="logo">
                <img src="{{ asset('images/logo fix2.png') }}" alt="Readowl Logo">
                <h1>Readowl</h1>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li>
                        <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.my_library') }}" class="{{ Request::is('my-library') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 12h-4V4h-2v8h-4V4H8v8H6V4H4v8H2v2h2v8h2v-8h2v8h2v-8h4v8h2v-8h4v-2z"/></svg>
                            My library
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.books') }}" class="{{ Request::is('books') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H8V4h12v12z"/></svg>
                            All Books
                        </a>
                    </li>
                </ul>
            </nav>
            @if(Auth::check())
            <div class="reading-card">
                <p>Continue reading</p>
                <img src="https://covers.openlibrary.org/b/id/8235012-L.jpg" alt="Book Cover">
                <h4>The Design of Everyday Things</h4>
            </div>
            @endif
        </div>
    </div>
    <div class="main-content">
        <div class="header">
            <div class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <input type="text" placeholder="Search in My library">
            </div>
            <div class="header-right">
                <div class="user-profile">
                    <img src="https://via.placeholder.com/45" alt="User Avatar">
                    <div class="user-info">
                        @auth
                            <h5>{{ Auth::user()->name }}</h5>
                            <p>Welcome!r</p>
                        @else
                            <h5>Guest</h5>
                            <p>Please log in</p>
                        @endauth
                    </div>
                </div>
                @guest
                    <div class="login-button-container">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                @else
                    <div class="logout-button-container">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>

        <div class="tabs">
            <button class="active">My Saved Books</button>
        </div>

        <div class="shelf-section">
            <div class="shelf-header">
                <h3>My Saved Books</h3>
            </div>
            <div class="shelf">
                @forelse($savedBooks as $book)
                    <a href="{{ route('user.show', $book) }}" class="book-item">
                        <img src="{{ route('books.cover', $book->id) }}" alt="{{ $book->title }} Cover">
                        <p>{{ $book->title }}</p>
                    </a>
                @empty
                    <p>You haven't saved any books yet.</p>
                @endforelse
            </div>
        </div>

        </div>
    </div>
</body>
</html>