@extends('layouts.auth')

@section('title', $title)

@section('content')
    <div class="custom-login-page">
        <div class="custom-form">
            Your email was verified. You can login now. You will automatically redirect after 5 seconds.
        </div>
    </div>
@endsection

@if (\Illuminate\Support\Facades\Session::get('autoredirect') === true)
    @push('js-scripts')
        <script>
            setTimeout(function () {
                window.location.href = "{{ route('auth.loginForm') }}";
            }, 5000); // 5 seconds
        </script>
    @endpush
@endif
