@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 border rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Customer Registration</h2>

    <form method="POST" action="{{ route('register.customer') }}">
        @csrf

        <!-- First Name -->
        <div class="mb-4">
            <label for="first_name" class="block font-medium">First Name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}"
                   class="w-full p-2 border rounded" autofocus>
            @error('first_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="last_name" class="block font-medium">Last Name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}"
                   class="w-full p-2 border rounded">
            @error('last_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="w-full p-2 border rounded">
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

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
            Register as Customer
        </button>
    </form>
</div>
@endsection
