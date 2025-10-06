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
                {{ $input['last_name'] }}　{{ $input['first_name'] }}
            </td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $input['gender_label'] }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $input['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $input['tel'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $input['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $input['building'] ?? '—' }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $input['category_label'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $input['content'] }}</td>
        </tr>
</table>

<div class="confirm-actions" style="display:flex; gap:12px;">
    <form method="POST" action="{{ url('/contacts') }}">
            @csrf
            <button type="submit" class="btn btn--primary">送信</button>
        </form>
    <form method="POST" action="{{ route('contact.back') }}">
        @csrf
        <button type="submit" class="btn btn--link">修正</button>
    </form>
</div>
</div>
</div>
@endsection
