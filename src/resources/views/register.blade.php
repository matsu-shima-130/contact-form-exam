{{-- resources/views/register.blade.php --}}
@extends('layouts.app')

@section('css')
    {{-- login.css をそのまま使ってサイズ/余白を統一 --}}
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

{{-- この画面だけヘッダーに login ボタンを表示 --}}
@section('header-actions')
    <a href="{{ url('/login') }}" class="header__btn">login</a>
@endsection

@section('content')
    <div class="auth-page">
        <h2 class="auth__title">Register</h2>

        <div class="auth-card">
            <form class="auth-form" action="{{ url('/register') }}" method="POST">
                @csrf

                <div class="form-row">
                    <label class="form-label" for="name">お名前</label>
                    <input id="name" class="input" type="text" name="name" placeholder="例: 山田　太郎">
                </div>

                <div class="form-row">
                    <label class="form-label" for="email">メールアドレス</label>
                    <input id="email" class="input" type="email" name="email" placeholder="例: test@example.com">
                </div>

                <div class="form-row">
                    <label class="form-label" for="password">パスワード</label>
                    <input id="password" class="input" type="password" name="password" placeholder="例: coachtech1106">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-auth">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection
