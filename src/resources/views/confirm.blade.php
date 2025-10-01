@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Confirm</h2>
    </div>


    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>
                <span class="confirm__name">山田</span>
                <span class="confirm__name">太郎</span>
            </td>
        </tr>
        <tr>
            <th>性別</th>
            <td>男性</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>test@example.com</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>08012345678</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>東京都渋谷区千駄ヶ谷1-2-3</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>千駄ヶ谷マンション101</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>商品の交換について</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>届いた商品が注文した商品ではありませんでした。</td>
        </tr>
</table>

<div class="confirm-actions">
    <button type="button" class="btn btn--primary">送信</button>
    <button type="button" class="btn btn--link">修正</button>
</div>
</div>
</div>
@endsection
