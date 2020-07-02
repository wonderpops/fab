@extends('main_layout')

@section('title')
<title>Машины</title>
@endsection

@section('main_content')
    <div class="cars-container">
        <div class="box">
            <form action="{{ route('cars.search') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="field has-addons">
                    <div class="control is-expanded">
                        @if (@isset($search_query))
                            <input name="search_query" class="input is-primary is-rounded" type="text" placeholder="Поиск машины" value="{{ $search_query }}">                     
                        @else
                            <input name="search_query" class="input is-primary is-rounded" type="text" placeholder="Поиск машины" value="">
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
                        <a class="button is-primary is-rounded" href="/cars/add">
                            Добавить машину
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="box" style="margin: 10px;">
            <div class="columns is-multiline">
                @foreach ($cars as $car)
                <div class="column is-4" style="min-width: 300px;">
                    <div class="car-card">
                        <div class="card">
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
    </div>
@endsection