
@extends('layouts.dashboard')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-12">
              <h1>Inserisci nuovo post</h1>
              <form method="POST" action="{{ route('admin.posts.store') }}">
                  @csrf
                  <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" class="form-control">
                  </div>
                  <div class="form-group">
                      <textarea name="description" rows="8" cols="80" placeholder="Descrizione post"></textarea>
                  </div>
                  <div class="form-group">
                      <textarea name="content" rows="8" cols="80" placeholder="Contenuto del post"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option value="">-- select category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
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
