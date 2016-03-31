@extends('layouts.app')

@section('title')
    Список организаций
@endsection

@section('content')

    <h1>Список организаций</h1>


    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <a href="{{ route('organizers.create') }}" class="btn btn-primary">Создать</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Описание деятельности</th>
                        <th>Имя руководителя</th>
                        <th>Контактные данные</th>
                        <th>Логотип</th>
                        <th>Адрес</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($organizers as $organizer)
                    <tr>
                        <th>{{ $organizer->id }}</th>
                        <td>{{ $organizer->name }}</td>
                        <td>{{ $organizer->description}}</td>
                        <td>{{ $organizer->manager }}</td>
                        <td>{{ $organizer->contacts }}</td>
                        <td>{{ $organizer->image }}</td>
                        <td>{{ $organizer->address }}</td>
                        <td>@include('common.objectActions', ['objectType' => 'organizers', 'objectId' => $organizer->id, ])</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-sm-12 text-center">
            <div class="">
                {!! $organizers->links() !!}
            </div>
        </div>
    </div>
@endsection
