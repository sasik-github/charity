@extends('layouts.app')

@section('content')

    <div class="row">
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
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="row text-center">
        <div class="">
            {!! $organizers->links() !!}
        </div>
    </div>

@endsection
