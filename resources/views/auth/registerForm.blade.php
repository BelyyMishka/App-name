@extends('layouts.auth')

@section('title', $title)

@section('content')
    <div class="custom-login-page">
        @include('sections.messages')
        <div class="custom-form">
            <form class="login-form" method="POST" action="{{ route('auth.register') }}">
                @csrf
                <input type="text" placeholder="Name" id="name" name="name" value="{{ old('name') }}"/>
                <input type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}"/>
                <input type="password" placeholder="Password" id="password" name="password"/>
                <input type="password" placeholder="Password confirm" id="password_confirmation" name="password_confirmation"/>
                <button type="submit">Register</button>
                <p class="message">Already registered? <a href="{{ route('auth.loginForm') }}">Login</a></p>
                <p class="message">Did not get the verification link? <a href="{{ route('verify.resendForm') }}">Resend</a></p>
            </form>
        </div>
    </div>
@endsection
