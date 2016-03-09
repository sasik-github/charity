@extends('layouts.app')

@section('title')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>{{ $event->name }}</h2>
            <p>{{ $event->description}}</p>
            <p>{{ $event->points }}</p>
            <p>{{ $event->date }}</p>
            <p>{{ $event->place }}</p>
        </div>
    </div>
    @if(count($event->volunteers) > 0)
        <div class="row">
            <h3>Участники</h3>
            <div class="col-md-12">
                @foreach($event->volunteers as $volunteer)
                    <a href="{{ route('volunteers.show', [ $volunteer->id ]) }}">{{ $volunteer->name }}</a>
                @endforeach
            </div>
        </div>
    @endif

@endsection
