<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::query()->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.contact.index', compact('contacts'));
    }

    public function edit(int $id)
    {
        $contact = Contact::query()->where('id', $id)->firstOrFail();

        return view('backend.pages.contact.edit', compact('contact'));
    }

    public function update(Request $request, int $id)
    {
        $contact = Contact::query()->where('id', $id)->firstOrFail();

        $contact->status = $request->status;
        $contact->save();

        return back()->withSuccess('Status Dəyişdirildi!');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $contact = Contact::query()->where('id', $id)->firstOrFail();

        $contact->delete();

        return response([
            'success' => 'Slayd silindi!',
            'status' => 'ok'
        ]);
    }

    public function statusChange(Request $request)
    {
        $id = $request->id;
        $contact = Contact::query()->where('id', $id)->firstOrFail();

        $contact->status = $contact->status ? 0 : 1;
        $contact->save();

        return response([
            'success' => 'Status dəyişdirildi!',
            'status' => $contact->status
        ]);
    }
}
