@extends('main_layout')

@section('main_content')
    <div class="cars-container">
        <div class="columns is-multiline">
            @foreach ($cars as $car)
            <div class="column is-4">
                <div class="car-card">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="/images/car_id_{{$car->id}}_4by3.jpg" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <p class="title is-4">{{$car->name}}</p>
                            <p class="subtitle is-6">ВИН: {{$car->vin}}</p>
                            <div class="content">
                                
                                <time datetime="2016-1-1">{{$car->created_at}}</time>
                                <div class="field is-grouped is-grouped-right">
                                    <p class="control">
                                    <a class="button is-primary is-rounded" href="/cars/{{$car->id}}">Подробнее</a>
                                    </p>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            @endforeach
        </div>
    </div>
@endsection