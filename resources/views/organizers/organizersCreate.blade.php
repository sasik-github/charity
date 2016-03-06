@extends('layouts.form')

@section('title')
    Создать Организатора
@endsection


@section('form')
    <div class="row">
        <h2>Создать Организатора</h2>
    </div>

    <div class="row">
        {!! Form::open(['action' => 'OrganizersController@store', 'class' => 'form', 'files' => true]) !!}

            @include('organizers._organizerForm', ['submitButtonText' => 'Создать'])

        {!! Form::close() !!}
    </div>
@endsection
