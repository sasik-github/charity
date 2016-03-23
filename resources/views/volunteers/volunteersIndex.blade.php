@extends('layouts.app')

@section('title')
    Список волонтеров
@endsection

@section('content')

    <h1>Список волонтеров</h1>

    <div class="row">
        <a href="{{ route('volunteers.create') }}" class="btn btn-primary">Создать</a>
    </div>

    <div class="row">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Балы</th>
                    <th>Уровень</th>
                    <th>День рождения</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($volunteers as $volunteer)
                <tr>
                    <th>{{ $volunteer->id }}</th>
                    <td><a href="{{route('volunteers.show', [$volunteer->id])}}">{{ $volunteer->name }}</a></td>
                    <td>{{ $volunteer->telephone}}</td>
                    <td>{{ $volunteer->points }}</td>
                    <td>{{ new \App\Models\Helpers\Level($volunteer) }}</td>
                    <td>{{ $volunteer->birthday }}</td>
                    <td>
                        @include('common.objectActions', ['objectType' => 'volunteers', 'objectId' => $volunteer->id, ])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="row text-center">
        <div class="">
            {!! $volunteers->links() !!}
        </div>
    </div>

@endsection
