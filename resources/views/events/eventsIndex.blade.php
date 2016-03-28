@inject('organizersRepos', 'App\Models\Repositories\OrganizerRepository')
@inject('volunteersRepos', 'App\Models\Repositories\VolunteerRepository')
@inject('fileSystem', 'App\Files\FileSystem')

@extends('layouts.app')

@section('title')
    Список событий
@endsection

@section('content')

    <h1>Список событий</h1>

    <div class="row">
        <a href="{{ route('events.create') }}" class="btn btn-primary">Создать</a>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <select onChange="window.location.href=this.value">
                <option value="{{ url('/events') }}">Группировать по...</option>
                @foreach($organizersRepos->getOrganizersForSelectbox() as $id => $organizer)
                    <option {{ $id == $organizerId ? 'selected' : '' }} value="?organizer={{ $id }}">{{ $organizer }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <table class="table table-stripped">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>описание</th>
                <th>Изображение</th>
                <th>Место</th>
                <th>Балы</th>
                <th>Дата</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <th>{{ $event->id }}</th>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->description }}</td>
                    <td><img src="{{ $fileSystem->path($event->image) }}" alt="{{ $event->image }}" class="img-responsive"></td>
                    <td>{{ $event->place }}</td>
                    <td>{{ $event->points }}</td>
                    <td>{{ $event->date }}</td>
                    <td>@include('common.objectActions', ['objectType' => 'events', 'objectId' => $event->id, ])</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="row text-center">
        <div class="">
            {!! $events->links() !!}
        </div>
    </div>

@endsection
