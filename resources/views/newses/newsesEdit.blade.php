@extends('layouts.form')

@section('title')
    Редактировать новость
@endsection


@section('form')
    <div class="row">
        {!! Form::model($news, ['action' => ['NewsesController@update', $news->id], 'class' => 'form', 'files' => true, 'method' => 'patch']) !!}

            @include('newses._newsesForm', ['submitButtonText' => 'Сохранить'])

        {!! Form::close() !!}
    </div>
@endsection
