<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
                --card-bg: #FFFFFF;
            --active-link-bg: #FFF8E1;
            --active-link-text: #E69500;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6; /* Improve readability */
        }

        .main-content {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
            max-width: 1200px;
            margin: 0 auto;
            background-color: var(--bg-light); /* Ensure background consistency */
            border-radius: 15px; /* Slightly rounded corners for the main content area */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px; /* Increase space below header */
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color); /* Add a subtle separator */
        }

        .search-bar {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        .search-bar input {
            width: 100%;
            padding: 15px 25px 15px 55px; /* Adjust padding */
            border: 1px solid var(--border-color);
            border-radius: 25px; /* More rounded search bar */
            font-size: 17px; /* Slightly larger font */
            background-color: var(--card-bg);
            box-shadow: 0 5px 20px var(--shadow-light); /* Enhanced shadow */
            transition: all 0.3s ease; /* Smooth transition for all properties */
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(90, 103, 216, 0.3); /* More prominent focus shadow */
            transform: translateY(-2px); /* Slight lift on focus */
        }

        .search-bar svg {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px; /* Slightly larger icon */
            height: 24px;
            fill: var(--text-light);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 25px; /* Increase gap */
        }

        .user-info h5 {
            margin: 0;
            font-size: 17px; /* Slightly larger font */
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-info p {
            margin: 0;
            font-size: 14px; /* Slightly larger font */
            color: var(--text-light);
        }

        .logout-button-container .btn,
        .login-button-container .btn {
            padding: 12px 25px; /* Adjust padding */
            font-size: 16px; /* Slightly larger font */
            border-radius: 25px; /* More rounded buttons */
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; /* Add box-shadow transition */
            box-shadow: 0 4px 15px rgba(90, 103, 216, 0.2); /* Add initial shadow */
        }

        .logout-button-container .btn:hover,
        .login-button-container .btn:hover {
            background-color: #4C51BF;
            transform: translateY(-3px); /* More pronounced lift on hover */
            box-shadow: 0 8px 25px rgba(90, 103, 216, 0.3); /* Stronger shadow on hover */
        }

        .shelf-section {
            margin-bottom: 60px; /* Increase margin */
        }

        .shelf-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px; /* Increase margin */
        }

        .shelf-header h3 {
            font-size: 24px; /* Larger heading */
            font-weight: 700; /* Bolder heading */
            margin: 0;
            color: var(--text-dark);
        }

        .shelf-header a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600; /* Bolder link */
            display: flex;
            align-items: center;
            transition: color 0.3s ease; /* Smooth transition for color */
        }

        .shelf-header a:hover {
            color: #4C51BF;
        }

        .shelf-header a svg {
            margin-left: 8px; /* Increase margin */
            width: 18px; /* Slightly larger icon */
            height: 18px;
            fill: currentColor;
        }

        .shelf {
            background-color: var(--shelf-color);
            border-radius: 20px; /* More rounded shelf */
            padding: 35px 30px; /* Adjust padding */
            display: flex;
            flex-wrap: wrap;
            gap: 35px; /* Increase gap */
            box-shadow: 0 10px 30px var(--shadow-light); /* Stronger shadow */
            position: relative;
            min-height: 250px; /* Increase min-height */
            align-items: flex-start;
        }

        .book-item {
            background-color: var(--card-bg);
            border-radius: 20px; /* More rounded book item */
            padding: 30px; /* Adjust padding */
            text-align: center;
            box-shadow: 0 8px 25px var(--shadow-light); /* Stronger shadow */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smooth transition */
            text-decoration: none;
            color: inherit;
            display: block;
            flex-shrink: 0;
            width: 200px; /* Slightly larger book item */
        }

        .book-item img {
            width: 100%;
            height: 250px; /* Adjust height */
            object-fit: cover;
            border-radius: 15px; /* More rounded image corners */
            margin-bottom: 25px; /* Increase margin */
            box-shadow: 0 10px 30px var(--shadow-medium); /* Stronger shadow */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 20px;
            }

            .search-bar {
                width: 100%;
                max-width: none;
                margin-top: 15px;
            }

            .header-right {
                width: 100%;
                justify-content: space-between;
                margin-top: 15px;
            }

            .shelf {
                flex-direction: column;
                align-items: center;
            }

            .book-item {
                width: 100%;
                max-width: 250px;
            }
        }
        }

        .book-item:hover {
            transform: translateY(-12px); /* More pronounced lift on hover */
            box-shadow: 0 15px 40px var(--shadow-strong); /* Even stronger shadow on hover */
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            height: 10px;
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4C51BF;
        }

    </style>
</head>
<body>
    <div class="main-content">
        <div class="header">
            <form action="{{ route('search.books') }}" method="GET" class="search-bar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <input type="text" name="title" placeholder="Search books..." value="{{ $query ?? '' }}">
            </form>
            <div class="header-right">
                <div class="user-info">
                    @auth
                        <h5>{{ Auth::user()->name }}</h5>
                        <p>Welcome!</p>
                    @else
                        <h5>Guest</h5>
                        <p>Please log in</p>
                    @endauth
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

        <div class="shelf-section">
            <div class="shelf-header">
                <h3>Search Results for "{{ $query }}"</h3>
            </div>
            <div class="shelf">
                @if ($books->isEmpty())
                    <p>No books found matching your query.</p>
                @else
                    @foreach ($books as $book)
                        <a href="{{ route('user.show', ['id' => $book->id]) }}" class="book-item">
                            <img src="{{ route('books.cover', $book->id) }}" alt="{{ $book->title }} Cover">
                            <p>{{ $book->title }}</p>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>