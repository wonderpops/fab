@extends('main_layout')

@section('main_content')
    <div class="cars-container">
        <table class="table is-fullwidth is-striped">
            <thead>
              <tr>
                <th>id</th>
                <th>name</th>
                <th>type</th>
                <th>car</th>
                <th>date</th>
                <th>cost</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($parts as $part)
                <tr>
                    <td>{{$part->id}}</td>
                <td><a href="parts/{{$part->id}}">{{$part->name}}</a></td>
                    <td>{{$part->type}}</td>
                    <td><a href="cars/{{$part->car_id}}">{{DB::table('cars')->where('id', $part->car_id)->value('name')}}</td>
                    <td>{{$part->created_at}}</td>
                    <td>{{$part->cost}}р.</td>
                </tr>
            @endforeach
            </tbody>
          </table>
    </div>
@endsection