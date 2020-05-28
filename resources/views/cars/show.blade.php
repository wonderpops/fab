@extends('main_layout')

@section('main_content')
    <div class="box cars-container">
        <div class="columns">
            <div class="column is-4">
                <figure class="image is-4by3" style="margin-bottom: calc(1em - 1px);">
                    <img src="{{$car->image}}" style="border-radius: 4px;" alt="Placeholder image">
                </figure>
                <div class="field">
                    <label class="label is-medium">Название:</label>
                    <div class="control">
                        <input name="field" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$car->name}}" disabled>
                    </div>
                </div>
                <div class="field">
                    <label class="label is-medium">ВИН:</label>
                    <div class="control">
                        <input name="field" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$car->vin}}" disabled>
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #7a7a7a;">Дата создания:</label>
                    <div class="control">
                        <h5 class="subtitle is-5" style="color: #7a7a7a;">{{$car->created_at}}</h5>
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #7a7a7a;">Дата редактирования:</label>
                    <div class="control">
                        <h5 class="subtitle is-5" style="color: #7a7a7a;">{{$car->updated_at}}</h5>
                    </div>
                </div>
            </div>
            <div class="column">
                <table class="table is-striped is-fullwidth">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Тип</th>
                        <th>Дата</th>
                        <th>Цена</th>
                        </tr>
                    </thead>
                    @foreach ($parts as $part)
                    <tr>
                        <td>{{$part->id}}</td>
                        <td><a href="/parts/{{$part->id}}">{{$part->name}}</a></td>
                        <td>{{$part->type_id}}</td>
                        <td>{{$part->created_at}}</td>
                        <td>{{$part->cost}}р.</td>
                    </tr>
                    @endforeach
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection