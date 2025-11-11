@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 border rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Admin Login</h2>

    @if(session('success'))
        <p class="mb-4 text-green-600">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="w-full p-2 border rounded" autofocus>
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block font-medium">Password</label>
            <input id="password" type="password" name="password"
                   class="w-full p-2 border rounded">
            @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-700">
            Login as Admin
        </button>
    </form>
</div>
@endsection
