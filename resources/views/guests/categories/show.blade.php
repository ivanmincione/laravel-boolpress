@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Category: {{ $category->name }}</h1>

                @foreach ($category->posts as $post)
                    <div class="box">
                        <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                            {{ $post->title }}
                        </a>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
@endsection
