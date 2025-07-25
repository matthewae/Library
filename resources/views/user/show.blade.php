<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
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
            --sidebar-bg: #FFFFFF;
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
            justify-content: center;
            align-items: center;
        }

        .book-detail-container {
            background-color: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            padding: 40px;
            max-width: 900px;
            width: 100%;
            gap: 40px;
        }

        .book-cover-large {
            flex-shrink: 0;
            width: 250px;
            height: 375px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .book-info {
            flex-grow: 1;
        }

        .book-info h1 {
            font-size: 36px;
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 10px;
        }

        .book-info h2 {
            font-size: 24px;
            color: var(--text-dark);
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .book-info p {
            font-size: 16px;
            line-height: 1.6;
            color: var(--text-light);
            margin-bottom: 15px;
        }

        .book-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .meta-item {
            display: flex;
            flex-direction: column;
        }

        .meta-item strong {
            font-size: 14px;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .meta-item span {
            font-size: 16px;
            color: var(--primary-color);
            font-weight: 600;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #E65100;
        }

        .back-button svg {
            margin-right: 8px;
            width: 20px;
            height: 20px;
            fill: white;
        }

        .read-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green color for read button */
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .read-button:hover {
            background-color: #45a049;
        }

        .read-button svg {
            margin-right: 8px;
            width: 20px;
            height: 20px;
            fill: white;
        }
    </style>
</head>
<body>
    <div class="book-detail-container" id="bookDetailContainer">
        <img src="{{ $book->cover_image_url }}" alt="Book Cover" class="book-cover-large">
        <div class="book-info">
            <h1>{{ $book->title }}</h1>
            <h2>{{ $book->author }}</h2>
            <p>{{ $book->description }}</p>
            <div class="book-meta">
                <div class="meta-item">
                    <strong>Category</strong>
                    <span>{{ $book->category->name }}</span>
                </div>
                <div class="meta-item">
                    <strong>Published</strong>
                    <span>{{ $book->publication_year }}</span>
                </div>
                <div class="meta-item">
                    <strong>Pages</strong>
                    <span>{{ $book->pages['count'] ?? 'N/A' }}</span>

                </div>
            </div>
            <div style="display: flex; gap: 15px; margin-top: 30px;">
                <a href="/" class="back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z"/></svg>
                    Back to Library
                </a>
                <a href="{{ route('books.pdf', ['book' => $book->id]) }}" target="_blank" class="read-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"><path d="M12 4.5C7.58 4.5 4 8.08 4 12.5c0 3.81 2.97 6.95 6.79 7.44L12 22l1.21-2.06c3.82-.49 6.79-3.63 6.79-7.44 0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zM11 9h2v5h-2z"/></svg>
                    Read Book
                </a>
            </div>

        </div>
    </div>
    </div>


</body>
</html>