@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Nenhuma notícia cadastrada!') }}
        </div>

        <div class="card-body">
            <a href="{{ route('news.create') }}" class="btn btn-primary" role="button">Cadastrar notícia</a>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
