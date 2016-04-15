@inject('fileSystem', 'App\Files\FileSystem')

@extends('layouts.app')

@section('title')
{{ $news->title }}
@endsection

@section('content')
    <img src="{{ $fileSystem->path($news->image) }}" alt="" class="img-responsive">
    <h2>
        {{ $news->title }}
    </h2>
    <p>
        {{$news->text }}
    </p>
@endsection