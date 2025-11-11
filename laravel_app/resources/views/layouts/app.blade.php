<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Project') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">My Project</a>
            <div class="space-x-4">
                <a href="{{ route('register.customer') }}" class="text-gray-700 hover:text-gray-900">Customer Register</a>
                <a href="{{ route('register.admin') }}" class="text-gray-700 hover:text-gray-900">Admin Register</a>
                <a href="{{ route('admin.login') }}" class="text-gray-700 hover:text-gray-900">Admin Login</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow p-4 mt-auto text-center text-gray-600">
        &copy; {{ date('Y') }} My Project. All rights reserved.
    </footer>

</body>
</html>
