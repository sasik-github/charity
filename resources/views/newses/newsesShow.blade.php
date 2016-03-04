@extends('layouts.app')

@section('title')
{{ $news->title }}
@endsection

@section('content')
    <img src="{{ $news->image }}" alt="" class="img-responsive">
    <h2>
        {{ $news->title }}
    </h2>
    <p>
        {{$news->text }}
    </p>
@endsection