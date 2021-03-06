@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row ">
            <div class="col-12">
                    <h1 class="text-center" >Posts</h1>

                    @foreach ($posts as $post)
                        <div class="box">
                            <h2>
                                {{ $post->title }}
                            </h2>
                            <p> {{ $post->slug }}</p>
                            <a class="" href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                                See post
                            </a>
                        </div>

                    @endforeach
            </div>
        </div>
    </div>

@endsection
