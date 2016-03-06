@inject('organizersRepos', 'App\Models\Repositories\OrganizerRepository')
@inject('volunteersRepos', 'App\Models\Repositories\VolunteerRepository')

@extends('layouts.app')

@section('content')

    <div class="row">
        <table class="table table-stripped">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>описание</th>
                <th>Изображение</th>
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
                    <td>{{ $event->image }}</td>
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
