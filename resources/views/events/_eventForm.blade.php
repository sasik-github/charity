@inject('organizersRepos', 'App\Models\Repositories\OrganizerRepository')
@inject('volunteersRepos', 'App\Models\Repositories\VolunteerRepository')


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
    <label for="title">Дата</label>
    <div class='input-group date' id='datetimepicker2'>
        {!! Form::text('date', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>

<div class="form-group">
    <label for="title">Место</label>
    {!! Form::text('place', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Фото</label>
    {!! Form::file('image', ['class' => '']) !!}
</div>

<div class="form-group">
    <label for="text">Организатор</label>
    {!! Form::select('organizer_id', $organizersRepos->getOrganizersForSelectbox(), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="text">Администратор события</label>
    {!! Form::select('volunteer_id', $volunteersRepos->getVolunteersForSelectbox(), null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}

<script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker({
            locale: 'ru'
        });
    });
</script>
