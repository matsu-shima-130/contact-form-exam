<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $data = $request->validated();

        $data['tel'] = $data['tel1'].$data['tel2'].$data['tel3'];

        $gmap = ['1'=>'男性','2'=>'女性','3'=>'その他'];
        $data['gender_label'] = $gmap[(string)$data['gender']] ?? '';

        $cat = Category::find($data['category_id']);
        $data['category_label'] = $cat?->content ?? '';

        session(['contact_input' => $data]);

        return view('confirm', ['input' => $data]);
    }

    public function store(Request $request)
    {
        $data = session('contact_input');
        if (!$data) {
            return redirect('/')->with('error', '入力情報が見つかりません');
        }

        Contact::create([
            'last_name'   => $data['last_name'],
            'first_name'  => $data['first_name'],
            'gender'      => $data['gender'], // 1/2/3
            'email'       => $data['email'],
            'tel'         => $data['tel'],
            'address'     => $data['address'],
            'building'    => $data['building'] ?? null,
            'category_id' => $data['category_id'],
            'content'     => $data['content'],
        ]);

        session()->forget('contact_input');

        return redirect('/thanks');
    }

    public function back(Request $request)
{
    return redirect('/')
        ->withInput(session('contact_input', []));
}

    public function thanks()
    {
        return view('thanks');
    }
}
