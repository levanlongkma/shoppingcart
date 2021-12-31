<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactValidator;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        $active = "contacts";
        $contacts = Contact::paginate(3);
        return view('backend.contacts.index', compact('active', 'contacts'));
    }

    public function store(ContactValidator $request)
    {
        $params = $request->all();

        $newContact = Contact::create([
                'name' => $params['name'],
                'phonenumber' => $params['phonenumber'],
                'fax' => $params['fax'],
                'address' => $params['address'],
                'email' => $params['email'],
            ]);

        if ($newContact) {
            Session::flash('messages_success', 'A new contact was set! Great job!');
            return ['status' => true];
        }

        return ['status' => false];
    }

    public function update(ContactValidator $request, $id)
    {
        $params = $request->validated();

        $isUpdated =
            Contact::where('id', $id)
            ->update([
                'name' => $params['name'],
                'phonenumber' => $params['name'],
                'fax' => $params['fax'],
                'address' => $params['address'],
                'email' => $params['email'],
                'updated_at' => now()
            ]);

        if ($isUpdated) {
            Session::flash('messages_success', 'Your company contacts are updated!');
            return ['status' => true];
        }

        return ['status' => false];
    }

    public function delete($id) 
    {
        $isDeleted = Contact::where('id', $id)->delete();
        
        if ($isDeleted) {
            return ['status' => true];
        }

        return ['status' => false];
    }
}
