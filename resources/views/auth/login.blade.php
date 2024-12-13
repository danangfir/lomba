@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold mb-6">Sign In</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('email') border-red-500 @enderror" value="{{ old('email') }}" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md @error('password') border-red-500 @enderror" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded-md hover:bg-orange-600 transition duration-200">Sign in</button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot your password?</a>
        </div>
    </div>
</div>
@endsection
