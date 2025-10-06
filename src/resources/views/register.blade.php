{{-- resources/views/register.blade.php --}}
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header-actions')
    <a href="{{ url('/login') }}" class="header__btn">login</a>
@endsection

@section('content')
    <div class="auth-page">
        <h2 class="auth__title">Register</h2>

        <div class="auth-card">
            <form class="auth-form" action="{{ url('/register') }}" method="POST" novalidate>
                @csrf

                <div class="form-row">
                    <label class="form-label" for="name">お名前</label>
                    <input id="name"
                    class="input @error('name') is-invalid @enderror"
                    type="text"
                    name="name"
                    placeholder="例: 山田　太郎"
                    value="{{ old('name') }}">
                    @error('name') <p class="form__error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <label class="form-label" for="email">メールアドレス</label>
                    <input id="email"
                    class="input @error('email') is-invalid @enderror"
                    type="email"
                    name="email"
                    placeholder="例: test@example.com"
                    value="{{ old('email') }}">
                    @error('email') <p class="form__error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <label class="form-label" for="password">パスワード</label>
                    <input id="password"
                    class="input @error('password') is-invalid @enderror"
                    type="password"
                    name="password"
                    placeholder="例: coachtech1106">
                    @error('password') <p class="form__error">{{ $message }}</p> @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-auth">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection
