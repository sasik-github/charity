@inject('fileSystem', 'App\Files\FileSystem')

@extends('layouts.app')

@section('title')
    Новости
@endsection

@section('content')

    {{--<div class="row">--}}
        <h1>Новости</h1>
    {{--</div>--}}

    <div class="row">
        @foreach($newses as $news)
            <div class="col-md-4">
                <img src="{{ $fileSystem->path($news->image) }}" alt="" class="img-responsive">
                <h2>
                    {{ $news->title }}
                </h2>
                <p>
                    {{$news->text }}
                </p>
                <p>
                    <a href="{{action('NewsesController@show', $news->id)}}" class="btn btn-default">Подробней..</a>
                </p>
            </div>
        @endforeach
    </div>

    <div class="row text-center">
        <div class="">
            {!! $newses->links() !!}
        </div>
    </div>

@endsection
