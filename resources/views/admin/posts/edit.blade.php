@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Modifica post {{ $post->id }}</h1>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                    Return to posts
                </a>
            </div>
            {{-- se sono presenti errori nei dati inseriti nel form --}}
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    @if($post->cover)
                        <p>Immagine di copertina presente:</p>
                        <img class="d-block" src="{{ asset('storage/' . $post->cover) }}">
                    @else
                        <p>Immagine di copertina non post presente</p>
                    @endif
                    <label>Carica una nuova immagine di copertina</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name="title" class="form-control" placeholder="Inserisci il titolo del post" value="{{ old('title', $post->title) }}" required>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Contenuto</label>
                    <textarea name="content" class="form-control" rows="8" cols="80" placeholder="Contenuto del post" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">-- select category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == old('category_id', $post->category_id) ? 'selected=selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- checkbox per i tags --}}
                <div class="form-group">
                    <p>Select Tags:</p>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            {{-- se il post da modificare contiene il tag aggiungi checked --}}
                            {{-- divido le due casistiche con una if --}}
                            @if($errors->any())
                                <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', [])) ? 'checked=checked' : '' }}>
                            @else
                                <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                {{ $post->tags->contains($tag) ? 'checked=checked' : '' }}>
                            @endif
                            <label class="form-check-label">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Salva post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
