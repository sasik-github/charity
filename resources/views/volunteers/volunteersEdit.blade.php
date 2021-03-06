@extends('layouts.form')

@section('title')
    Редактировать Волонтера
@endsection


@section('form')
    <div class="row">
        <h2>Редактировать Волонтера</h2>
    </div>

    <div class="row">
        {!! Form::model($volunteer, ['action' => ['VolunteersController@update', $volunteer->id], 'class' => 'form', 'files' => true, 'method' => 'patch']) !!}

            @include('volunteers._volunteerForm', ['submitButtonText' => 'Сохранить'])

        {!! Form::close() !!}
    </div>
@endsection
