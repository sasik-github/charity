@extends('layouts.app')

@section('title')
    Список волонтеров
@endsection

@section('content')

    <h1>Список волонтеров</h1>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <a href="{{ route('volunteers.create') }}" class="btn btn-primary">Создать</a>
            </div>
        </div>

        <div class="col-sm-8 col-sm-push-3">
            <form action="{{ route('volunteers.index') }}" method="get" class="form-inline">
                <div class="col-sm-12">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-search"></span>
                        </div>
                        <input type="text" name="search" class="form-control" value="{{ $searchWord }}">
                        <div class="input-group-btn">
                            <input type="submit" class="btn btn-default" value="Искать">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
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

        <div class="col-sm-12 text-center">
            <div class="">
                {!! $volunteers->links() !!}
            </div>
        </div>
    </div>
@endsection
