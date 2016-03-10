@extends('layouts.form')

@section('title')
    Редактировать Cобытие
@endsection


@section('form')
    <div class="row">
        <h2>Редактировать Событие</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! Form::model($event, ['action' => ['EventsController@update', $event->id], 'class' => 'form', 'files' => true, 'method' => 'patch']) !!}

                @include('events._eventForm', ['submitButtonText' => 'Сохранить'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection
