<div class="form-group">
    <label for="title">Загаловок</label>
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Текст</label>
    {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Картинка</label>
    {!! Form::file('image', ['class' => '']) !!}
</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
