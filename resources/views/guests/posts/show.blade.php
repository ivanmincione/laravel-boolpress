@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">
                        All posts
                    </a>
                </div>
                <div class="box">
                    <h1> {{ $post->title }} </h1>
                    <p>Content : {{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
