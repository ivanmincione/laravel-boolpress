
@extends('layouts.dashboard')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-12">
                <h1>Inserisci nuovo post</h1>
                {{-- se sono presenti errori di inserimento dei dati nel form  --}}
                <div>
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

                <form method="POST" action="{{ route('admin.posts.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="Inserisci il titolo del post">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="8" cols="80" placeholder="Descrizione post">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="content" rows="8" cols="80" required placeholder="Contenuto del post">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            <option value="">-- select category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }} {{ old('category_id') == $category->id ? 'selected=selected' : '' }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                {{-- aggiungere checkbox per i tags  --}}
                <div class="form-group">
                    <p>Seleziona i tag:</p>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked=checked' : '' }}>
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
                          Salva post
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>

@endsection
