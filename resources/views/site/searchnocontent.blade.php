@extends('layouts.site')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3  text-center">
        <div class="container-fluid py-5">
            <h4 class="display-8 fw-bold">Nenhuma notícia encontrada com o termo <strong>"{{ $search }}"</strong>!</h4>
        </div>

        <div class="btn-group">
            <a href="{{ route('site.index') }}" class="btn btn-primary" role="button">Voltar ao início</a>
        </div>
    </div>
@endsection
