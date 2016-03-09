@extends('layouts.app')

@section('title')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>{{ $volunteer->name }}</h2>
            <p>{{ $volunteer->telephone}}</p>
            <p>{{ $volunteer->points }}</p>
            <p>{{ $volunteer->birthday }}</p>
        </div>
    </div>
    @if(count($events) > 0)
        <div class="row">
            <h3>Принял участие</h3>
            <div class="col-md-12">
                @foreach($events as $event)
                    <a href="{{ route('events.show', [$event->id]) }}">{{ $event->name }}</a>
                @endforeach
            </div>
        </div>
    @endif


@endsection
