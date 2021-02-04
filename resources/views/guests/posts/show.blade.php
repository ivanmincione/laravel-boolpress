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
                @if($post->cover)
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                @endif
                <div class="box">
                    <h1> {{ $post->title }} </h1>
                    <p> Category :
                        @if ($post->category)
                            <a href="{{ route('categories.show', ['slug' => $post->category->slug]) }}">
                                {{ $post->category->name }}
                            </a>
                        @else
                            <span> n.a.</span>
                        @endif
                    </p>

                    <p> Content : {{ $post->content }}</p>

                    <p> Tags:
                        @forelse ($post->tags as $tag)
                            #{{ $tag->name }}{{ !$loop->last ? ' - ' : '' }}
                        @empty
                            n.a.
                        @endforelse
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
