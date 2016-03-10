<div class="form-group">
    <label for="title">Фамилия</label>
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Имя</label>
    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Отчество</label>
    {!! Form::text('middlename', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Телефон</label>
    {!! Form::tel('telephone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Пароль</label>
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">День рождения</label>
    {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Место работы/учебы</label>
    {!! Form::text('workplace', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Фото</label>
    @include('common.fileUploader', ['obj' => isset($volunteer) ? $volunteer : null])
</div>

<div class="form-group">
    <label for="title">Балы</label>
    {!! Form::number('points', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
