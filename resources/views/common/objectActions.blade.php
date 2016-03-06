<div>
    <a href="{{ route($objectType . '.edit', [$objectId]) }}" class="btn btn-default">редактировать</a>
    {!! Form::open(['route' => [$objectType . '.destroy', $objectId], 'method' => 'delete', 'class' => 'form-inline delete-action-form']) !!}
        <input type="submit" class="btn btn-danger" value="удалить">
    {!! Form::close() !!}
</div>
