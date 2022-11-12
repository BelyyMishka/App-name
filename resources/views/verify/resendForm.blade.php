@extends('layouts.auth')

@section('title', $title)

@section('content')
    <div class="custom-login-page">
        @include('sections.messages')
        <div class="custom-form">
            <form class="login-form" method="POST" action="{{ route('verify.resend') }}">
                @csrf
                <input type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}"/>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
@endsection
