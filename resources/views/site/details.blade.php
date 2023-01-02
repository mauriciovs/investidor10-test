@extends('layouts.site')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">{{ $news->title }}</h1>
            @if ($news->image)
                <img src="/images/{{ $news->image }}" class="img-fluid img-thumbnail" alt="{{ $news->title }}" width="600px">
            @endif
            <p class="col-md-8 fs-4">{{ $news->content }}</p>
            <div class="btn-group">
                <a href="{{ route('site.index') }}" class="btn btn-primary" role="button">Voltar ao início</a>
            </div>
        </div>
    </div>
@endsection
