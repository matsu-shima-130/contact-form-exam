@extends('layouts.app')

@section('header-actions')
    <a href="{{ url('/login') }}" class="header__btn">logout</a>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin">

    {{-- タイトル --}}
    <h2 class="admin__title">Admin</h2>

    {{-- フィルタフォーム（あとでGET絞り込みに差し替えやすい name 設計） --}}
    <form class="filters" action="{{ url('/admin') }}" method="GET">
        {{-- 1. 名前・メール --}}
        <input class="filters__kw filters__kw--wide"
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="名前やメールアドレスを入力してください">

        {{-- 3. 性別（デフォルト「性別」） --}}
        <label class="select">
            <select class="filters__sel filters__sel--sm" name="gender">
                <option value="">性別</option>
                <option value="all"   {{ request('gender')==='all'?'selected':'' }}>全て</option>
                <option value="male"  {{ request('gender')==='male'?'selected':'' }}>男性</option>
                <option value="female"{{ request('gender')==='female'?'selected':'' }}>女性</option>
                <option value="other" {{ request('gender')==='other'?'selected':'' }}>その他</option>
            </select>
        </label>

        {{-- 4. お問い合わせの種類 --}}
        <label class="select">
            <select class="filters__sel filters__sel--md" name="category">
                <option value="">お問い合わせの種類</option>
                <option>商品のお届けについて</option>
                <option>商品の交換について</option>
                <option>商品トラブル</option>
                <option>ショップへのお問い合わせ</option>
                <option>その他</option>
            </select>
        </label>

        {{-- 5. 年/月/日（ネイティブカレンダー） --}}
        <label class="select select--date">
            <input class="filters__date" type="date" name="date" value="{{ request('date') }}">
        </label>

        {{-- 6. 検索/リセット --}}
        <button class="btn btn--primary btn--search" type="submit">検索</button>
        <button class="btn btn--reset" type="reset">リセット</button>
    </form>

    {{-- 検索・リセットの直下：エクスポート＆ページネーションを同じ行に --}}
<div class="subbar">
    <div class="admin__actions">
        <button class="btn btn--export" type="button">エクスポート</button>
    </div>

    <nav class="pager" aria-label="ページ移動">
        <button class="pager__btn" disabled>‹</button>
        <button class="pager__num is-current">1</button>
        <button class="pager__num">2</button>
        <button class="pager__num">3</button>
        <button class="pager__btn">›</button>
    </nav>
</div>

    {{-- 一覧（7件/ページ想定。今はダミー） --}}
    <div class="tablewrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0; $i<7; $i++)
                    @php
                        $nameLast='山田'; $nameFirst='太郎';
                        $gender=['男性','女性','その他'][$i%3];
                        $email='test@example.com';
                        $category=['商品の交換について','商品トラブル','ショップへのお問い合わせ','その他','商品のお届けについて'][$i%5];
                    @endphp
                    <tr>
                        <td>{{ $nameLast }}　{{ $nameFirst }}</td>
                        <td>{{ $gender }}</td>
                        <td>{{ $email }}</td>
                        <td>{{ $category }}</td>
                        <td class="tbl__act"><button type="button" class="btn btn--link">詳細</button></td>
                        </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- （必要になったときに差し込む）モーダル土台：JSなしで非表示のまま --}}
    <div class="modal" id="detailModal" aria-hidden="true">
        <div class="modal__overlay"></div>
            <div class="modal__dialog" role="dialog" aria-modal="true" aria-labelledby="mdTitle">
            <button class="modal__close" aria-label="閉じる">×</button>
            <h3 class="modal__title" id="mdTitle">お問い合わせ詳細</h3>
            <dl class="md-list">
                <div><dt>お名前</dt><dd>山田　太郎</dd></div>
                <div><dt>性別</dt><dd>男性</dd></div>
                <div><dt>メールアドレス</dt><dd>test@example.com</dd></div>
                <div><dt>電話番号</dt><dd>08012345678</dd></div>
                <div><dt>住所</dt><dd>東京都渋谷区千駄ヶ谷1-2-3</dd></div>
                <div><dt>建物名</dt><dd>千駄ヶ谷マンション101</dd></div>
                <div><dt>お問い合わせの種類</dt><dd>商品の交換について</dd></div>
                <div><dt>お問い合わせ内容</dt><dd>……</dd></div>
            </dl>
            <div class="modal__actions">
                <button class="btn btn--danger" type="button">削除</button>
            </div>
        </div>
    </div>
</div>
@endsection