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
                    <div class="">
                        @if($post->cover)
                            <img src="{{ asset('storage/' . $post->cover) }}" alt="n.a.">
                        @else
                            <p>copertina non presente</p>
                        @endif
                    </div>
                    <p>Description : {{ $post->description }}</p>
                    <p>Content : {{ $post->content }}</p>
                    <p>Category : {{ $post->category ? $post->category->name : 'n.a.' }}</p>
                    <p>Tags :
                        @forelse ($post->tags as $tag)
                            {{ $tag->name }}{{ !$loop->last ? ',' : '' }}
                        @empty
                            <span>n.a.</span>
                        @endforelse
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
