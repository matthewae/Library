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
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ ++$counter }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $user->isAdmin() ? 'Admin' : 'User' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{-- Add action buttons here (edit, delete) --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection