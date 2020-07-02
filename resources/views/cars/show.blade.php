@extends('main_layout')

@section('title')
<title>{{$car->name}}</title>
@endsection

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
                        <p class="control is-expanded">
                            <a class="button is-primary is-fullwidth" onclick="edit_enable(this);">Редактировать</a>
                        </p>
                    </div>
                
                    <div class="field">
                        <p class="control is-expanded">
                            <a class="button is-danger is-fullwidth" onclick="document.getElementById('delete_form').submit();">Удалить</a>
                        </p>
                    </div>

                    <input name="car_id" type="hidden" placeholder="Medium sized input" value="{{$car->id}}">
            </div>



            <div class="column">
                <article class="panel" style="border: 1px #ededed solid; box-shadow: none;">
                    <P class="panel-heading">
                        Характеристики:
                    </P>
                    <div class="columns" style="padding: 10px;">
                        <div class="column">
                            <div class="field">
                                <label class="label is-medium">Название:</label>
                                
                                <div class="control">
                                    <input name="name" class="input is-primary is-medium" type="text" placeholder="Введите название машины" value="{{$car->name}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Год выпуска:</label>
                                <div class="control">
                                    <input name="manufacture_year" class="input is-primary is-medium" type="text" placeholder="Введите год выпуска машины" value="{{$car->manufacture_year}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Аукционная оценка:</label>
                                <div class="control">
                                    <input name="valuation" class="input is-primary is-medium" type="text" placeholder="Введите аукционную оценку" value="{{$car->valuation}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Код кузова:</label>
                                <div class="control">
                                    <input name="body_code" class="input is-primary is-medium" type="text" placeholder="Введите код кузова" value="{{$car->body_code}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Цвет кузова:</label>
                                <div class="control">
                                    <input name="body_color" class="input is-primary is-medium" type="text" placeholder="Введите цвет кузова" value="{{$car->body_color}}" disabled>
                                </div>
                            </div>
                        </div>


                        <div class="column">
                            <div class="field">
                                <label class="label is-medium">Код отделки:</label>
                                <div class="control">
                                    <input name="interior_code" class="input is-primary is-medium" type="text" placeholder="Введите код отделки" value="{{$car->interior_code}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Код двигателя:</label>
                                <div class="control">
                                    <input name="engine_code" class="input is-primary is-medium" type="text" placeholder="Введите код двигателя" value="{{$car->engine_code}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Тип коробки:</label>
                                <div class="control is-expanded">
                                    <div class="select is-primary is-fullwidth is-medium">
                                        <select name="gearbox_type" class="input" type="text" disabled>
                                            <option>{{$car->gearbox_type}}</option>
                                            @if ($car->gearbox_type == 'Автоматическая')
                                                <option>Ручная</option>
                                            @else
                                                <option>Автоматическая</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Код коробки передач:</label>
                                <div class="control">
                                    <input name="gearbox_code" class="input is-primary is-medium" type="text" placeholder="Введите код коробки передач" value="{{$car->gearbox_code}}" disabled>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label is-medium">Статус:</label>
                                <div class="control is-expanded">
                                    <div class="select is-primary is-fullwidth is-medium">
                                        <select name="status" class="input" type="text" disabled>
                                            <option>{{$car->status}}</option>
                                            @if ($car->status == 'Разбирается')
                                                <option>Разобрана</option>
                                            @else
                                                <option>Разбирается</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="panel" style="border: 1px #ededed solid; box-shadow: none;">
                    <P class="panel-heading">
                        Детали:
                    </P>
                    <table class="table is-striped is-fullwidth">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Тип</th>
                            <th>Цена</th>
                            </tr>
                        </thead>
                        @foreach ($parts as $part)
                        <tr>
                            <td>{{$part->id}}</td>
                            <td><a href="/parts/{{$part->id}}/main">{{$part->name}}</a></td>
                            <td>{{$part->type}}</td>
                            <td>{{$part->prise}}р.</td>
                        </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                    <div class="field is-grouped is-grouped-centered" style="margin: 10px;">
                        <p class="control">
                            <a class="button is-primary is-rounded" href="/parts/add/{{$car->id}}">
                                Добавить деталь
                            </a>
                        </p>
                    </div>
                </article>
            </div>
        </div>
        <div class="field is-grouped is-grouped-right">
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
    </div>
</form>

<form id="delete_form" action="{{ route('cars.delete_car') }}" method="post">
    {{ csrf_field() }}
    <input name="car_id" type="hidden" value="{{$car->id}}">
</form>
@endsection