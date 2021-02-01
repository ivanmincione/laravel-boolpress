<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Add Model Post to use it
use App\Post;


class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }
}
