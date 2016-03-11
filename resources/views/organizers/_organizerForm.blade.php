<div class="form-group">
    <label for="title">Название</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Описание деятельности</label>
    {!! Form::tel('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Руководитель</label>
    {!! Form::text('manager', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    <label for="title">Контактные данные</label>
    {!! Form::text('contacts', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Логотип</label>
    @include('common.fileUploader', ['obj' => isset($organizer) ? $organizer : null])
</div>

<div class="form-group">
    <label for="title">Адрес</label>
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
