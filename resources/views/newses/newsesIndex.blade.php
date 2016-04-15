@inject('fileSystem', 'App\Files\FileSystem')

@extends('layouts.app')

@section('title')
    Новости
@endsection

@section('content')

    <h1>Новости</h1>

    @if (!Auth::guest())
        @if (auth()->user()->isAdmin())
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ action('NewsesController@create') }}" class="btn btn-primary">Создать</a>
                </div>
            </div>
            <br>
        @endif
    @endif


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
                <div class="btn-group" role="group" aria-label="">
                    <a href="{{ action('NewsesController@show', $news->id) }}" class="btn btn-default" role="button">Подробней..</a>
                    @if (!Auth::guest())
                        @if (auth()->user()->isAdmin())
                            <a href="{{ action('NewsesController@edit', $news->id) }}" class="btn btn-primary" role="button">редактировать</a>
                            @include('common._deleteFormObj', ['action' => 'NewsesController@destroy', 'id' => $news->id])
                        @endif
                    @endif
                </div>
            </div>
        @endforeach

            <div class="col-sm-12 text-center">
                <div class="">
                    {!! $newses->links() !!}
                </div>
            </div>
    </div>



@endsection
