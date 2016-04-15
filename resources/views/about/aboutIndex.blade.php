@extends('layouts.app')

@section('title')
    {{--О Компании--}}
@endsection

@section('content')

    @if (!Auth::guest())
        @if (auth()->user()->isAdmin())
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ action('AboutController@getEdit') }}" class="btn btn-primary">Редактировать</a>
                </div>
            </div>
            <br>
        @endif
    @endif

    {!! $about->text !!}

@endsection

