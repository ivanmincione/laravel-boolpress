<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageFromWebsite;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('guests.home');
    }
    public function contacts()
    {
        return view('guests.contacts');
    }

    public function contattiSent(Request $request) {
        $form_data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($form_data);
        $new_lead->save();
        Mail::to('commerciale@boolpress.com')->send(new MessageFromWebsite($new_lead));
        return redirect()->route('contatti.thank-you');
    }

    public function thankYou() {
        return view('guest.thank-you');
    }


    public function about()
    {
        return view('guests.about');
    }


}
