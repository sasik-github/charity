@extends('layouts.form')

@section('title')
Создать Новость
@endsection


@section('form')
    <div class="row">
        <h2>Создать Новость</h2>
    </div>

    <div class="row">
        {!! Form::open(['action' => 'NewsesController@store', 'class' => 'form', 'files' => true]) !!}

            @include('newses._newsesForm', ['submitButtonText' => 'Создать'])

        {!! Form::close() !!}
    </div>
@endsection
