@extends('layouts.form')

@section('title')
    Редактировать Организатора
@endsection


@section('form')
    <div class="row">
        <h2>Редактировать Организатора</h2>
    </div>

    <div class="row">
        {!! Form::model($organizer, ['action' => ['OrganizersController@update', $organizer->id], 'class' => 'form', 'files' => true, 'method' => 'patch']) !!}

            @include('organizers._organizerForm', ['submitButtonText' => 'Сохранить'])

        {!! Form::close() !!}
    </div>
@endsection
