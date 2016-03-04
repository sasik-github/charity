@extends('layouts.form')

@section('title')
    Создать Волонтера
@endsection


@section('form')
    <div class="row">
        <h2>Создать Волонтера</h2>
    </div>

    <div class="row">
        {!! Form::open(['action' => 'VolunteersController@store', 'class' => 'form', 'files' => true]) !!}

            @include('volunteers._volunteerForm', ['submitButtonText' => 'Создать'])

        {!! Form::close() !!}
    </div>
@endsection
