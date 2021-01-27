@extends('layouts.dashboard')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                    Return to posts
                </a>
                <h1 class="text-center" >ID Post {{ $post->id }}</h1>
                <div class="box">
                    <h2> {{ $post->title }} </h2>
                    <p>Slug: {{ $post->slug }}</p>
                    <p>Type : {{ $post->type }} </p>
                    <p>Description : {{ $post->description }}</p>
                    <p>Content : {{ $post->content }}</p>
                    <p>Category : {{ $post->category ? $post->category->name : 'n.a.' }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
