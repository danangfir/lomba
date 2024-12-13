@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md">
        <h2 class="text-center text-2xl font-bold mb-6">Reset Password</h2>
        @if (session('status'))
            <div class="mb-4 text-green-500">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded-md">Send Password Reset Link</button>
        </form>
    </div>
</div>
@endsection
