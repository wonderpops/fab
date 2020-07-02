@extends('main_layout')
@section('title')
<title>Детали</title>
@endsection

@section('main_content')
    <div class="" style="margin: 70px 10px 10px 10px;">
        <div class="box">
            <form action="{{ route('parts.search') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="field has-addons">
                    <div class="control is-expanded">
                        @if (@isset($search_query))
                            <input name="search_query" class="input is-primary is-rounded" type="text" placeholder="Поиск запчасти" value="{{ $search_query }}">                     
                        @else
                            <input name="search_query" class="input is-primary is-rounded" type="text" placeholder="Поиск запчасти" value="">
                        @endif
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-primary is-rounded">
                        Поиск
                        </button>
                    </div>
                </div>
                <div class="field is-grouped is-grouped-centered">
                    <p class="control">
                        <a class="button is-primary is-rounded" href="/parts/add">
                            Добавить запчасть
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="box" style="margin: 20px 10px 10px 10px;">
            <div class="table-container">
                <table class="table is-fullwidth is-narrow is-hoverable is-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Дата</th>
                        <th>Машина</th>
                        <th>Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($parts as $part)
                        <tr>
                            <td>{{$part->id}}</td>
                            <td><a class="hide_text" href="parts/{{$part->id}}/main">{{$part->name}}</a></td>
                            <td>{{$part->type}}</td>
                            <td nowrap>{{$part->created_at}}</td>
                            <td nowrap><a href="cars/{{$part->car_id}}">{{DB::table('cars')->where('id', $part->car_id)->value('name')}}</td>
                            <td>{{$part->prise}}р.</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection