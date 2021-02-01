<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function profile() {
        return view('admin.profile'); //ritorna la view del profilo utente loggato
    }

    // aggiungere funzione per generare il codice token casualmente

    public function generateToken() {
        $api_token = Str::random(80);
        $user = Auth::user(); // Auth::user -> utente loggato
        $user->api_token = $api_token; // assegno il codice token generato all'utente
        $user->save();
        return redirect()->route('admin.profile');
    }

}
