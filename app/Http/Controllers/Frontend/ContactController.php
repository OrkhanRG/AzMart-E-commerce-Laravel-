<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact');
    }

    public function store(ContactFormRequest $request)
    {
        $data = [
            'name' => $request->fname.' '.$request->lname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => $request->ip()
        ];

        Contact::query()->create($data);

        return back()->with('success', 'Mesajınız göndərilmişdir');
    }
}
