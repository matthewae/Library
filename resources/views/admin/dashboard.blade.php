@extends('admin.index')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome, {{ $adminName }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Users</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="text-blue-500">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.165-1.294-.472-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.165-1.294.472-1.857m0 0A5.002 5.002 0 0112 8a5.002 5.002 0 014.528 2.143M17 16v-2a3 3 0 00-5.356-1.857M17 16H7m10 0v-2c0-.653-.165-1.294-.472-1.857M7 16H2v-2a3 3 0 015.356-1.857M7 16v-2c0-.653.165-1.294.472-1.857m0 0A5.002 5.002 0 0112 8a5.002 5.002 0 014.528 2.143"></path></svg>
            </div>
        </div>

        <!-- Total Books Card -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Books</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalBooks }}</p>
            </div>
            <div class="text-green-500">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="bg-white rounded-lg shadow-md p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase">Total Categories</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalCategories }}</p>
            </div>
            <div class="text-purple-500">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5.5c.582 0 1.144.236 1.554.659l4.006 4.006c.423.423.659.985.659 1.554V21a1 1 0 01-1 1H7a1 1 0 011-1zm0 0h-.01"></path></svg>
            </div>
        </div>
    </div>

    <!-- Latest Downloads Table -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Latest Downloads</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Book</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Downloaded At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestDownloads as $download)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $download->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $download->book->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">{{ $download->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Book Downloads Chart</h2>
            <canvas id="bookDownloadsChart"></canvas>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Top Downloaded Books</h2>
            <ul class="list-disc pl-5">
                @foreach($bookDownloads as $bookDownload)
                    <li>{{ $bookDownload->book->title }} ({{ $bookDownload->total_downloads }} downloads)</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div id="chart-labels" style="display:none;">{!! json_encode($chartLabels) !!}</div>
    <div id="chart-data" style="display:none;">{!! json_encode($chartData) !!}</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/admin_dashboard.js') }}"></script>
@endsection
