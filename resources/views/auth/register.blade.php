@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Регистрация</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        @include('auth._registerFormElement', ['name' => 'lastname', 'label' => 'Фамилия', 'type' => 'text'])
                        @include('auth._registerFormElement', ['name' => 'firstname','label' => 'Имя', 'type' => 'text'])
                        @include('auth._registerFormElement', ['name' => 'middlename', 'label' => 'Отчество', 'type' => 'text'])
                        @include('auth._registerFormElement', ['name' => 'telephone', 'label' => 'Телефон', 'type' => 'text'])
                        @include('auth._registerFormElement', ['name' => 'password', 'label' => 'Пароль', 'type' => 'password'])
                        @include('auth._registerFormElement', ['name' => 'password_confirmation', 'label' => 'Потверждение пароля', 'type' => 'password'])

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
