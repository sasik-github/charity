@extends('layouts.app')

@section('title')
    Редактирование раздела "О Компании"
@endsection

@section('content')

    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    @include('common.errors')
    <h1>Редакитрование раздела "О Компании"</h1>

    {!! Form::model($about, ['action' => 'AboutController@postEdit']) !!}
        <div class="row">
            {{Form::textarea('text', null, ['rows' => 10, 'cols' => 80, 'id' => 'editor1'])}}
            <script>
                CKEDITOR.replace( 'editor1' );
            </script>
        </div>
        <div class="row">
            {!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}
        </div>N
    {!! Form::close() !!}


@endsection

