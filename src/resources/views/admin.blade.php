@extends('layouts.app')

@section('header-actions')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="header__btn">logout</button>
    </form>
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
                <option value="" disabled {{ request('category') ? '' : 'selected' }}>
                    お問い合わせの種類
                </option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->content }}" {{ request('category')===$cat->content?'selected':'' }}>
                        {{ $cat->content }}
                    </option>
                @endforeach
            </select>
        </label>

        {{-- 5. 年/月/日（ネイティブカレンダー） --}}
        <label class="select select--date">
            <input class="filters__date" type="date" name="date" value="{{ request('date') }}">
        </label>

        {{-- 6. 検索/リセット --}}
        <button class="btn btn--primary btn--search" type="submit">検索</button>
        <button class="btn btn--reset" type="button" onclick="location.href='{{ route('admin.index') }}'">リセット</button>
    </form>

    {{-- エクスポート＆ページネーション --}}
    <div class="subbar">
        <div class="admin__actions">
            <a class="btn btn--export" href="{{ route('admin.export', request()->query()) }}">エクスポート</a>
        </div>

        {{ $contacts->onEachSide(1)->links('pagination.admin') }}
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
@forelse ($contacts as $c)
    <tr>
        <td>{{ $c->full_name }}</td>
        <td>{{ $c->gender_text }}</td>
        <td>{{ $c->email }}</td>
        <td>{{ optional($c->category)->content }}</td>
        <td class="tbl__act">
        <button
        type="button"
        class="btn btn--link"
        data-name="{{ $c->full_name }}"
        data-gender="{{ $c->gender_text }}"
        data-email="{{ $c->email }}"
        data-tel="{{ $c->tel }}"
        data-address="{{ $c->address }}"
        data-building="{{ $c->building }}"
        data-category="{{ optional($c->category)->content }}"
        data-detail="{{ $c->content }}"
        data-delete-url="{{ route('admin.destroy', $c) }}"
        onclick="openDetail(this)">
        詳細
        </button>
    </td>
    </tr>
    @empty
        <tr><td colspan="5">該当するデータはありません</td></tr>
    @endforelse
</tbody>
</table>
</div>

    {{-- モーダル --}}
    <div class="modal" id="detailModal" aria-hidden="true">
        <div class="modal__overlay" onclick="closeDetail()"></div>
        <div class="modal__dialog" role="dialog" aria-modal="true" aria-labelledby="mdTitle">
            <button class="modal__close" aria-label="閉じる" onclick="closeDetail()">×</button>
            <dl class="md-list" id="mdList">
                <!-- JSで埋める -->
            </dl>
            <div class="modal__actions">
                <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                    <button class="btn btn--danger" type="submit" onclick="return confirm('削除しますか？')">削除</button>
                </form>
            </div>
        </div>
    </div>

    <script>
function openDetail(btn){
    const d = btn.dataset;   // ← 個別属性を取得
    const m = document.getElementById('detailModal');
    const list = document.getElementById('mdList');
    const nl2br = (s) => (s || '').replace(/\n/g, '<br>');

    list.innerHTML = `
    <div><dt>お名前</dt><dd>${d.name || ''}</dd></div>
    <div><dt>性別</dt><dd>${d.gender || ''}</dd></div>
    <div><dt>メールアドレス</dt><dd>${d.email || ''}</dd></div>
    <div><dt>電話番号</dt><dd>${d.tel || ''}</dd></div>
    <div><dt>住所</dt><dd>${d.address || ''}</dd></div>
    <div><dt>建物名</dt><dd>${d.building || ''}</dd></div>
    <div><dt>お問い合わせの種類</dt><dd>${d.category || ''}</dd></div>
    <div><dt>お問い合わせ内容</dt><dd>${nl2br(d.detail)}</dd></div>
    `;

    document.getElementById('deleteForm').action = d.deleteUrl;
    m.setAttribute('aria-hidden', 'false');
}
function closeDetail(){
    document.getElementById('detailModal').setAttribute('aria-hidden','true');
}
</script>
</div>
@endsection