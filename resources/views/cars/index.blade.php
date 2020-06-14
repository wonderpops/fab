@extends('main_layout')

@section('search_block')
<div class="search_block">
    <article class="panel is-primary">
        <p class="panel-heading">
        Поиск
        </p>
        <p class="panel-tabs">
        <a class="is-active">All</a>
        <a class="hide_text">Разбираются</a>
        <a class="hide_text">Разобраны</a>
        </p>
        <div class="panel-block">
        <p class="control has-icons-left">
            <input class="input is-primary" type="text" placeholder="Search">
            <span class="icon is-left">
            <i class="fas fa-search" aria-hidden="true"></i>
            </span>
        </p>
        </div>
        <a class="panel-block is-active">
        <span class="panel-icon">
            <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
        </a>
        <a class="panel-block">
        <span class="panel-icon">
            <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        marksheet
        </a>
        <div class="panel-block">
            <a class="button is-primary is-fullwidth" href="/cars/add">
              Добавить машину
            </a>
        </div>
    </article>
</div>
@endsection

@section('main_content')
    <div class="cars-container">
        {{-- <div class="box">
                <p class="control is-expanded">
                  <input class="input is-primary is-rounded" type="text" placeholder="Поиск машины">
                </p>
                <br>
              <div class="field is-grouped is-grouped-centered">
                <p class="control">
                  <a class="button is-primary is-rounded" href="/cars/add">
                    Добавить машину
                  </a>
                </p>
              </div>
        </div> --}}
        <div class="columns is-multiline">
            @foreach ($cars as $car)
            <div class="column is-4">
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
                            <p class="subtitle is-6 hide_text">ВИН: {{$car->vin}}</p>
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
@endsection