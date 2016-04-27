@extends('layouts.form')

@section('title')
    Смена пароля
@endsection


@section('form')
    <div class="row">
        <h2>Смена пароля</h2>
    </div>

    <div class="row">
        {!! Form::open( ['action' => ['UsersController@postChangePassword'], 'class' => 'form', 'method' => 'post']) !!}

            <div class="form-group">
                <label for="title">Старый пароль</label>
                {!! Form::password('old_password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="title">Новый пароль</label>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="title">Потверждение нового пароля</label>
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit("Сохранить", ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
    </div>
@endsection
