<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use Illuminate\Http\Request;

use App\Models\Lead;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guests.home');
    }

    public function createContactForm()
    {
        return view('guests.contact');
    }

    public function contactFormHandler(Request $request)
    {
        $data = $request->all();
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('account@email.it')->send(new SendNewMail($newLead));

        return redirect()->route('guests.thanks')->with("lead", $newLead->name);;
    }

    public function contactFormEnder()
    {
        return view('guests.thanks');
    }
}
