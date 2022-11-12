@extends('layouts.auth')

@section('title', $title)

@section('content')
    <div class="custom-login-page">
        @include('sections.messages')
        <div class="custom-form">
            <form class="login-form" method="POST" action="{{ route('newPassword', $token) }}">
                @csrf
                <input type="password" placeholder="New password" id="password" name="password" value="{{ old('password') }}"/>
                <input type="password" placeholder="New password confirm" id="password_confirmation" name="password_confirmation"/>
                <button type="submit">Change password</button>
            </form>
        </div>
    </div>
@endsection
