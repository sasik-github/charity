@extends('layouts.form')

@section('title')
    Создать Cобытие
@endsection


@section('form')
    <div class="row">
        <h2>Создать Событие</h2>
    </div>

    <div class="row">
        {!! Form::open(['action' => 'EventsController@store', 'class' => 'form', 'files' => true]) !!}

            @include('events._eventForm', ['submitButtonText' => 'Создать'])

        {!! Form::close() !!}
    </div>
@endsection
