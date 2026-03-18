<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CguTrue');
        $this->middleware('profilUncomplet');
    }

    public function show(): View
    {
        return view('contact');
    }

    public function send(ContactFormRequest $contactFormRequest): RedirectResponse
    {
        Mail::to('contact@curiositiz.com')->send(new Contact($contactFormRequest));

        return redirect()->back()->with('message', 'Message envoyé avec succès !');
    }
}
