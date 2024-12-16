@extends('layouts.app')

@section('content')
    <x-auth.container>
        <x-auth.card>
            <x-auth.card-header>
                <h2 class="text-center text-2xl font-bold">Sign In</h2>
            </x-auth.card-header>

            <x-auth.card-content>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <x-auth.form-group>
                        <x-auth.label for="email">Email address</x-auth.label>
                        <x-shadcn.input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            :error="$errors->has('email')"
                        />
                        <x-auth.error field="email" />
                    </x-auth.form-group>

                    <x-auth.form-group>
                        <x-auth.label for="password">Password</x-auth.label>
                        <x-shadcn.input
                            type="password"
                            name="password"
                            id="password"
                            :error="$errors->has('password')"
                        />
                        <x-auth.error field="password" />
                    </x-auth.form-group>

                    <x-shadcn.button type="submit" class="w-full">
                        Sign in
                    </x-shadcn.button>
                </form>
            </x-auth.card-content>

            <x-auth.card-footer>
                <x-auth.forgot-password-link />
            </x-auth.card-footer>
        </x-auth.card>
    </x-auth.container>
@endsection
