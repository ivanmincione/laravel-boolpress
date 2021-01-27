<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //creo la stessa struttura ma per la view pubblica
        //recupero tutti i Post
        $data = [
            "posts" => Post::all()
        ];
        return view("guests.posts.index", $data);
    }
}
