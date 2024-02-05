<?php

namespace App\Http\Controllers;

use App\Models\ContactSMS;
use Illuminate\Http\Request;

class ContactSMSController extends Controller
{

    public function list()
    {
        $conSMS = ContactSMS::latest()->get();
        return view('BackEnd.contact.contact_sms',compact('conSMS'));
    }

    public function conSMS(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'subject' => 'required',
            'sms' => 'required',
        ]);
        ContactSMS::create($request->all());

        return redirect()->back()->with('sms','Thanks For Your Openion. We will get back to you soon.');
    }

    public function destroy($id)
    {
        $sms = ContactSMS::findOrFail($id);
        $sms->delete();
        return redirect()->back()->with('sms','Message Deleted Successfully');
    }
}
