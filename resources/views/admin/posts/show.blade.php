@extends('layouts.dashboard')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <h1 class="text-center" >ID Post {{ $post->id }}</h1>
                    <ul>
                        <li>
                            {{ $post->title }}
                        </li>
                        <li>
                            {{ $post->slug }}
                        </li>
                    </ul>

                        

            </div>
        </div>
    </div>

@endsection
