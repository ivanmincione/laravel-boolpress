@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dati utente</div>

                <div class="card-body">
                    <dl>
                        <dt>Nome</dt>
                        <dd>{{ Auth::user()->name }}</dd>
                        <dt>Email</dt>
                        <dd>{{ Auth::user()->email }}</dd>
                        <dt>API token</dt>
                        {{-- se l'utente loggato ha generato già il suo token stampa il token altrimenti stampa il button per generare il token --}}
                        @if (Auth::user()->api_token)
                            <dd>{{ Auth::user()->api_token }}</dd>
                        @else
                            <form action="{{ route('admin.generate_token') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    Genera API token
                                </button>
                            </form>
                        @endif

                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
