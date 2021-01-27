@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <h1 class="text-center" >Posts</h1>

                    @foreach ($posts as $post)
                        <div class="box">
                            <h2>
                                 <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                                {{ $post->title }}
                                </a>
                            </h2>
                            <p> {{ $post->slug }}</p>
                        </div>

                    @endforeach
            </div>
        </div>
    </div>

@endsection
