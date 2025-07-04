@extends('admin.index')

@section('content')
<div class="container">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">User Management</h1>

    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Users (Role: User)</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="text-gray-400">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.165-1.294-.472-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.165-1.294.472-1.857m0 0A5.002 5.002 0 0112 8a5.002 5.002 0 014.528 2.143M17 16v-2a3 3 0 00-5.356-1.857M17 16H7m10 0v-2c0-.653-.165-1.294-.472-1.857M7 16H2v-2a3 3 0 015.356-1.857M7 16v-2c0-.653.165-1.294.472-1.857m0 0A5.002 5.002 0 0112 8a5.002 5.002 0 014.528 2.143"></path></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">All Users</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @if($loggedInUser)
                    <tr class="bg-blue-100 hover:bg-blue-200 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 font-bold">{{ ++$counter }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 font-bold">{{ $loggedInUser->name }} (You)</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 font-bold">{{ $loggedInUser->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 font-bold">{{ $loggedInUser->isAdmin() ? 'Admin' : 'User' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 font-bold"></td>
                    </tr>
                    @endif
                    @foreach($users as $user)
                    @if($loggedInUser && $loggedInUser->id === $user->id)
                        @continue
                    @endif
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ ++$counter }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $user->isAdmin() ? 'Admin' : 'User' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.827-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm6 0a1 1 0 11-2 0v6a1 1 0 112 0V8z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection