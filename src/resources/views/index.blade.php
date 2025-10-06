@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" method="POST" action="{{ url('/confirm') }}" novalidate>
    @csrf
        {{-- お名前 --}}
        <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
            <div class="form__group-content">
                <div class="name-fields">
                    {{-- 姓 --}}
                    <div class="name-item">
                        <input class="input-text @error('last_name') is-invalid @enderror" type="text" name="last_name"
                        placeholder="例: 山田"
                        value="{{ old('last_name') }}">
                        <div class="form__error">@error('last_name') <p>{{ $message }}</p> @enderror</div>
                    </div>

                    {{-- 名 --}}
                    <div class="name-item">
                        <input class="input-text @error('first_name') is-invalid @enderror" type="text" name="first_name" placeholder="例: 太郎"
                        value="{{ old('first_name') }}">
                        <div class="form__error">@error('first_name') <p>{{ $message }}</p> @enderror</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
                <fieldset class="gender">
                    <legend class="sr-only">性別</legend>

                    <label class="gender__item">
                        <input type="radio" name="gender" value="1"
                        {{ old('gender', '1')==='1' ? 'checked' : '' }}>
                        <span>男性</span>
                    </label>

                    <label class="gender__item">
                        <input type="radio" name="gender" value="2"
                        {{ old('gender')==='2' ? 'checked' : '' }}>
                        <span>女性</span>
                    </label>

                    <label class="gender__item">
                        <input type="radio" name="gender" value="3"
                        {{ old('gender')==='3' ? 'checked' : '' }}>
                        <span>その他</span>
                    </label>
                </fieldset>

                <div class="form__error">
                    @error('gender') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>


        {{-- メールアドレス --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
            <input class="input-text input-text--full @error('email') is-invalid @enderror"
                type="email"
                name="email"
                placeholder="例: test@example.com"
                value="{{ old('email') }}"
                required>
                <div class="form__error">
                    @error('email') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
                <div class="tel-fields">
                    {{-- 080 --}}
                    <div class="tel-item">
                        <input class="input-text input-text--xs @error('tel1') is-invalid @enderror"
                        name="tel1"
                        placeholder="080"
                        value="{{ old('tel1') }}">
                        <div class="form__error">@error('tel1') <p>{{ $message }}</p> @enderror</div>
                    </div>

                    <span class="tel-sep">-</span>

                    {{-- 1234 --}}
                    <div class="tel-item">
                        <input class="input-text input-text--xs @error('tel2') is-invalid @enderror"
                        name="tel2"
                        placeholder="1234"
                        value="{{ old('tel2') }}">
                        <div class="form__error">@error('tel2') <p>{{ $message }}</p> @enderror</div>
                    </div>

                    <span class="tel-sep">-</span>

                    {{-- 5678 --}}
                    <div class="tel-item">
                    <input class="input-text input-text--xs @error('tel3') is-invalid @enderror"
                        name="tel3"
                        placeholder="5678"
                        value="{{ old('tel3') }}">
                        <div class="form__error">@error('tel3') <p>{{ $message }}</p> @enderror</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
            <input class="input-text input-text--full @error('address') is-invalid @enderror"
                type="text"
                name="address"
                placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                value="{{ old('address') }}"
                autocomplete="street-address"
                required>
                <div class="form__error">
                    @error('address') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- 建物名（任意） --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
            <input class="input-text input-text--full"
                type="text"
                name="building"
                placeholder="例: 千駄ヶ谷マンション101"
                value="{{ old('building') }}"
                autocomplete="address-line2">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
                <div class="select-box select-box--sm">
                    <select class="input-select
                        @error('category_id')
                        is-invalid
                        @enderror"
                        name="category_id"
                        required>
                        {{-- プレースホルダ（未選択） --}}
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>

                        @isset($categories)
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ (string)old('category_id') === (string)$category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                        @endisset
                    </select>
                    <span class="select-arrow" aria-hidden="true"></span>
                </div>
                <div class="form__error">
                    @error('category_id') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form__group form__group--top">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
                <textarea class="input-textarea @error('content') is-invalid @enderror"
                name="content"
                rows="6"
                placeholder="お問い合わせ内容をご記載ください"
                required>{{ old('content') }}</textarea>
                <div class="form__error">
                    @error('content') <p>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- 送信アクション --}}
        <div class="form__actions">
            <button type="submit" class="btn btn-confirm">確認画面</button>
        </div>

    </form>
</div>
@endsection