@inject('fileSystem', 'App\Files\FileSystem')

@extends('layouts.app')

@section('title')
    Новости
@endsection

@section('content')

    <h1>Новости</h1>

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

            <div class="col-sm-12 text-center">
                <div class="">
                    {!! $newses->links() !!}
                </div>
            </div>
    </div>



@endsection
