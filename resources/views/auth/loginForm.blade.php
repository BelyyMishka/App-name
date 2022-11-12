@extends('layouts.auth')

@section('title', $title)

@section('content')
    <div class="custom-login-page">
        @include('sections.messages')
        <div class="custom-form">
            <form class="login-form" method="POST" action="{{ route('auth.login') }}">
                @csrf
                <input type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}"/>
                <input type="password" placeholder="Password" id="password" name="password"/>
                <button type="submit">Login</button>
                <p class="message">Not registered? <a href="{{ route('auth.registerForm') }}">Create an account</a></p>
                <p class="message">Forgot password? <a href="{{ route('forgotForm') }}">Change password</a></p>
            </form>
        </div>
    </div>
@endsection
