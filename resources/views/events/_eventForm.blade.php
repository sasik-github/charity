<div class="form-group">
    <label for="title">Название</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Описание</label>
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Балы</label>
    {!! Form::number('points', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="title">Балы</label>
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Фото</label>
    {!! Form::file('image', ['class' => '']) !!}
</div>

<div class="form-group">
    <label for="text">Организатор</label>
    {!! Form::select('organizer_id', $organizers, null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
