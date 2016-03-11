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
    @include('common.fileUploader', ['obj' => isset($news) ? $news : null])

</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
