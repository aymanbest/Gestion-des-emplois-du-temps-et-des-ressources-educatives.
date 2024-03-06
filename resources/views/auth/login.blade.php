@extends('layouts.app')

@section('content')
<div class="ui justified container">
    <div class="ui fluid centered card">
        <div class="content">
            <div class="header">{{ __('Login') }}</div>
        </div>
        <div class="content">
            <form class="ui form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input class="ui input" id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                    <div class="ui red message">
                        <div class="header">Error!</div>
                        <p>{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="field">
                    <label for="password">{{ __('Password') }}</label>
                    <input class="ui input" id="password" type="password" name="password" autocomplete="current-password">
                    @error('password')
                    <div class="ui red message">
                        <div class="header">Error!</div>
                        <p>{{ $message }}</p>
                    </div>
                    @enderror
                </div>
                <div class="inline field">
                    <div class="ui toggle checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} tabindex="0" class="hidden">
                        <label for="remember"> {{ __('Remember Me') }}</label>
                    </div>
                </div>
                <button class="ui button blue fluid" type="submit">{{ __('Login') }}</button>
            </form>
        </div>
        <div class="extra content">
            @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </div>
</div>
@endsection

@push('login-scripts')
<script>
    $('.ui.checkbox').checkbox();
</script>
@endpush
