@extends('main_layout')

@section('main_content')
<form action="{{ route('cars.save_changes') }}" method="post">
    {{ csrf_field() }}

    <div class="box cars-container">
        <div class="columns">
            <div class="column is-4">
                    <figure class="image is-4by3" style="margin-bottom: calc(1em - 1px);">
                        <img src="{{$car->image}}" style="border-radius: 4px;" alt="Placeholder image">
                    </figure>

                    <div class="columns is-mobile">
                        <div class="column">
                            <a class="button is-fullwidth is-primary is-large is-light" onclick='$("#bcTarget").barcode("CAR{{ sprintf("%06d", $car->id) }}", "code39",{barWidth:2, barHeight:30});window.print();   '>
                                <span class="icon">
                                    <i class="fas fa-qrcode"></i>
                                </span>
                            </a>
                        </div>
                        <div class="column">
                            <a class="button is-fullwidth is-primary is-large is-light" onclick='copy_link();''>
                                <span class="icon">
                                    <i class="fas fa-link"></i>
                                </span>
                            </a>
                        </div>
                        <div class="column">
                            <a class="button is-fullwidth is-primary is-large is-light">
                                <span class="icon">
                                    <i class="fas fa-share-square"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="barcode_holder"><div id="bcTarget" class="barcode"></div></div>

                    <div class="field">
                        <label class="label is-medium">Название:</label>
                        
                        <div class="control">
                            <input name="name" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$car->name}}" disabled>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">ВИН:</label>
                        <div class="control">
                            <input name="vin" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$car->vin}}" disabled>
                        </div>
                    </div>

                    <div class="field">
                        <p class="control is-expanded">
                            <a class="button is-primary is-fullwidth" onclick="edit_enable(this);">Редактировать</a>
                        </p>
                    </div>
                
                    <div class="field">
                        <p class="control is-expanded">
                            <a class="button is-danger is-fullwidth">Удалить</a>
                        </p>
                    </div>
                    
                    <div class="field is-grouped is-grouped-left">
                        <div class="field" style="padding: 5px;">
                            <label class="label" style="font-size: 12px; color: #bbb;">Дата создания:</label>
                            <div class="control">
                                <h5 class="subtitle is-5" style="font-size: 12px; color: #bbb;">{{$car->created_at}}</h5>
                            </div>
                        </div>
                        <div class="field" style="padding: 5px;">
                            <label class="label" style="font-size: 12px; color: #bbb;">Дата редактирования:</label>
                            <div class="control">
                                <h5 class="subtitle is-5" style="font-size: 12px; color: #bbb;">{{$car->updated_at}}</h5>
                            </div>
                        </div>
                    </div>

                    <input name="car_id" type="hidden" placeholder="Medium sized input" value="{{$car->id}}">
            </div>

            <div class="column">
                <table class="table is-striped is-fullwidth">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Дата</th>
                        <th>Цена</th>
                        </tr>
                    </thead>
                    @foreach ($parts as $part)
                    <tr>
                        <td>{{$part->id}}</td>
                        <td><a href="/parts/{{$part->id}}">{{$part->name}}</a></td>
                        <td>{{$part->type}}</td>
                        <td>{{$part->cost}}р.</td>
                    </tr>
                    @endforeach
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection