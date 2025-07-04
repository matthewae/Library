@extends('admin.index')

@section('content')
<div class="container mx-auto mt-8 p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Book Management</h1>
        <a href="{{ route('admin.books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
            Add New Book
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Existing Books</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th scope="col" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                        <th scope="col" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Author</th>
                        <th scope="col" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Publisher</th>
                        <th scope="col" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Publication Year</th>
                        <th scope="col" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $book->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $book->author }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $book->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $book->publisher }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $book->publication_year }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-right text-sm font-medium">
                            <a href="{{ route('admin.books.show', $book->id) }}" class="text-blue-600 hover:text-blue-800 mr-2 transition duration-150 ease-in-out">View</a>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 mr-2 transition duration-150 ease-in-out">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection