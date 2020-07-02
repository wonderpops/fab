@extends('main_layout')

@section('title')
<title>Главная</title>
@endsection

@section('main_content')
<article class="panel is-primary" style="border: 1px #00d1b2 solid; box-shadow: none; margin: 70px 10px 10px 10px; background-color: white;">
    <P class="panel-heading">
        Последние машины:
    </P>
    <div style="padding: 20px 10px 20px 10px">
            @php
                $cars = DB::table('cars')->orderBy('created_at', 'desc')->limit(3)->get(); 
            @endphp
            <div class="columns is-multiline">
                @foreach ($cars as $car)
                <div class="column is-4" style="min-width: 300px;">
                    <div class="car-card">
                        <div class="card" style="">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <a href="/cars/{{ $car->id }}">
                                        <img src="{{$car->image}}">
                                    </a>
                                </figure>
                            </div>
                            <div class="card-content">
                                <p class="title is-4 hide_text">{{$car->name}}</p>
                                <p class="subtitle is-6 hide_text">Код кузова: {{$car->body_code}}</p>
                                <p>  
                                    @if ($car->status == 'Разбирается')
                                        <span class="tag is-warning is-light">{{$car->status}}</span>
                                    @else
                                        <span class="tag is-acces is-light">{{$car->status}}</span>
                                    @endif          
                                </p>
                                <div class="content">
                                    <div class="field is-grouped is-grouped-right">
                                        <p class="control">
                                            <a class="button is-primary is-rounded" href="/cars/{{$car->id}}">Подробнее</a>
                                        </p>
                                    </div>
                                    <time datetime="2016-1-1" style="font-size: 12px; color: #bbb;">{{$car->created_at}}</time>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                @endforeach
            </div>
    </div>
</article>

<article class="panel is-primary" style="border: 1px #00d1b2 solid; box-shadow: none; margin: 10px 10px 10px 10px; background-color: white;">
    <P class="panel-heading">
        Последние детали:
    </P>
    <div style="padding: 20px 10px 20px 10px">
        @php
            $parts = DB::table('parts')->orderBy('created_at', 'desc')->limit(10)->get(); 
        @endphp
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
</article>
@endsection