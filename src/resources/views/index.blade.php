@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form">
        {{-- お名前 --}}
        <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
            <div class="form__group-content">
                <div class="name-fields">
                    <input class="input-text" type="text" name="last_name"  placeholder="例: 山田">
                    <input class="input-text" type="text" name="first_name" placeholder="例: 太郎">
                </div>
                <div class="form__error"><!-- バリデーション時に表示 --></div>
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
                        <input type="radio" name="gender" value="1" checked>
                        <span>男性</span>
                    </label>

                    <label class="gender__item">
                        <input type="radio" name="gender" value="2">
                        <span>女性</span>
                    </label>

                    <label class="gender__item">
                        <input type="radio" name="gender" value="3">
                        <span>その他</span>
                    </label>
                </fieldset>

                <div class="form__error"></div>
            </div>
        </div>


        {{-- メールアドレス --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
            <input class="input-text input-text--full"
                type="email"
                name="email"
                placeholder="例: test@example.com"
                value="{{ old('email') }}"
                required>
            </div>
            {{-- バリデーションメッセージ表示（あとで実装したときに出ます）--}}
            @error('email')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        {{-- 電話番号 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
                <div class="tel-fields">
                    <input class="input-text input-text--xs"
                        type="tel"
                        name="tel1"
                        placeholder="080"
                        value="{{ old('tel1') }}"
                        maxlength="4"
                        required>

                    <span class="tel-sep">-</span>

                    <input class="input-text input-text--xs"
                        type="tel"
                        name="tel2"
                        placeholder="1234"
                        value="{{ old('tel2') }}"
                        maxlength="4"
                        required>

                    <span class="tel-sep">-</span>

                    <input class="input-text input-text--xs"
                        type="tel"
                        name="tel3"
                        placeholder="5678"
                        value="{{ old('tel3') }}"
                        maxlength="4"
                        required>
                </div>
            </div>

            {{-- ここは後でバリデーション実装時に出ます（個別でもOK） --}}
            @error('tel1') <div class="form__error">{{ $message }}</div> @enderror
            @error('tel2') <div class="form__error">{{ $message }}</div> @enderror
            @error('tel3') <div class="form__error">{{ $message }}</div> @enderror
        </div>

        {{-- 住所 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
            <input class="input-text input-text--full"
                type="text"
                name="address"
                placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                value="{{ old('address') }}"
                autocomplete="street-address"
                required>
            </div>
            @error('address')
            <div class="form__error">{{ $message }}</div>
            @enderror
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
            @error('building')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
                <div class="select-box select-box--sm">
                    <select class="input-select"
                        name="category_id"
                        required
                        aria-label="お問い合わせの種類">
                        {{-- プレースホルダ（未選択） --}}
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>選択してください</option>

                        {{-- ★DBを使う場合 --}}
                        @isset($categories)
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ (string)old('category_id') === (string)$category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                        @endisset

                        {{-- ★まだDBが無いなら一旦固定でもOK
                        <option value="1" {{ old('category_id')=='1' ? 'selected' : '' }}>商品の交換について</option>
                        <option value="2" {{ old('category_id')=='2' ? 'selected' : '' }}>お届けについて</option>
                        <option value="3" {{ old('category_id')=='3' ? 'selected' : '' }}>トラブル</option>
                        --}}
                    </select>
                    <span class="select-arrow" aria-hidden="true"></span>
                </div>
            </div>

            @error('category_id')
                <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form__group form__group--top">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>

            <div class="form__group-content">
            <textarea class="input-textarea"
            name="detail"
            rows="6"
            placeholder="お問い合わせ内容をご記載ください"
            required>{{ old('detail') }}</textarea>
            </div>

            @error('detail')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>

        {{-- 送信アクション --}}
        <div class="form__actions">
            <button type="submit" class="btn btn-confirm">確認画面</button>
        </div>

    </form>
</div>
@endsection