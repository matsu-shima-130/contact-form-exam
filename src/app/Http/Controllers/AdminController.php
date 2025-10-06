<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        $contacts = $this->buildFilteredQuery($req)
            ->with('category')
            ->paginate(7)
            ->withQueryString();

        $categories = \App\Models\Category::query()
        ->select('content')
        ->distinct()
        ->orderBy('content')
        ->get();

        return view('admin', compact('contacts', 'categories'));
    }

    // 削除
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('status', '削除しました');
    }

    //エクスポート
    public function export(Request $req): StreamedResponse
{
    $base = $this->buildFilteredQuery($req);

    $filename = 'contacts_'.now()->format('Ymd_His').'.csv';

    return response()->streamDownload(function () use ($base) {
        $out = fopen('php://output', 'w');

        fwrite($out, "\xEF\xBB\xBF");

        // ヘッダー
        fputcsv($out, ['お名前','性別','メール','電話','住所','建物名','種類','内容','日付']);

        $mapGender = [1=>'男性',2=>'女性',3=>'その他'];

        $base->chunk(500, function($rows) use ($out, $mapGender) {
            foreach ($rows as $c) {
                fputcsv($out, [
                    $c->last_name.' '.$c->first_name,
                    $mapGender[$c->gender] ?? '',
                    $c->email,
                    $c->tel,
                    $c->address,
                    $c->building,
                    optional($c->category)->content,
                    $c->content,
                    optional($c->created_at)->format('Y-m-d'),
                ]);
            }
        });

        fclose($out);
    }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
}

    private function buildFilteredQuery(Request $req)
{
    $q        = $req->input('q');
    $gender   = $req->input('gender');
    $category = $req->input('category');
    $date     = $req->input('date');

    return Contact::query()
        // ①キーワード検索（部分一致）
        ->when($q, function ($query) use ($q) {
            $kw = trim($q);

            $query->where(function ($qq) use ($kw) {

                $parts = preg_split('/\s+/u', $kw);

                if (count($parts) >= 2) {
                    [$last, $first] = array_pad($parts, 2, '');
                    $qq->where('last_name',  'like', "%{$last}%")
                        ->where('first_name', 'like', "%{$first}%");
                } else {
                    $qq->where('last_name',  'like', "%{$kw}%")
                        ->orWhere('first_name', 'like', "%{$kw}%")
                        ->orWhere('email',      'like', "%{$kw}%")
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$kw}%"])
                        ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$kw}%"]);
                }
            });
        })
        // ②性別
        ->when($gender && $gender !== 'all', function ($query) use ($gender) {
            $map = ['male' => 1, 'female' => 2, 'other' => 3];
            if (isset($map[$gender])) $query->where('gender', $map[$gender]);
        })
        // ③カテゴリ
        ->when($category, function ($query) use ($category) {
            $query->whereHas('category', fn($qq) => $qq->where('content', $category));
        })
        // ④日付（その日）
        ->when($date, fn($query) => $query->whereDate('created_at', $date))
        ->orderByDesc('id');
    }
}
