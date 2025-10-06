@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header-actions')
    <a href="{{ url('/register') }}" class="header__btn">register</a>
@endsection

@section('content')
    <div class="auth-page">
        <h2 class="auth__title">Login</h2>

        <div class="auth-card">
            <form class="auth-form" action="{{ url('/login') }}" method="POST" novalidate>
            @csrf
                <div class="form-row">
                    <label class="form-label" for="email">メールアドレス</label>
                    <input id="email"
                    class="input @error('email') is-invalid @enderror"
                    type="email"
                    name="email"
                    placeholder="例: test@example.com">
                @error('email')    <p class="form__error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <label class="form-label" for="password">パスワード</label>
                    <input id="password"
                    class="input @error('password') is-invalid @enderror"
                    type="password"
                    name="password"
                    placeholder="例: coachtech1106">
                    @error('password')    <p class="form__error">{{ $message }}</p> @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-auth">ログイン</button>
                </div>
            </form>
        </div>
    </div>
@endsection