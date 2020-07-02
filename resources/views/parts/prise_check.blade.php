@extends('main_layout')

@section('title')
<title>{{$part->name}}</title>
@endsection

@section('main_content')
    <div class="box cars-container">
        
        <div class="tabs is-toggle is-fullwidth">
            <ul>
              <li>
                <a href="/parts/{{$part->id}}/main">
                  <span class="icon is-small"><i class="fas fa-wrench" aria-hidden="true"></i></span>
                  <span>Характиристики</span>
                </a>
              </li>
              <li class="is-active">
                <a href="/parts/{{$part->id}}/prise_check">
                  <span class="icon is-small"><i class="fas fa-money" aria-hidden="true"></i></span>
                  <span>Расчет цены</span>
                </a>
              </li>
            </ul>
          </div>

        @php
            $search_query = '';
            $car_name = $car -> name;
            $part_name = $part -> name;
            $search_query .= "$part_name $car_name";
        @endphp

        <input id="part_id" type="hidden" value="{{$part->id}}">

        <div class="field has-addons">
            <div class="control is-expanded">
                <input id="search_query" name="search_query" class="input is-primary" type="text" placeholder="Введите запрос для расчета цены" value="{{ $search_query }}">                     
            </div>
            <div class="control">
                <a id="search" class="button is-primary" onclick="$('#search').toggleClass('is-loading'); check_prise('{{$part->id}}', document.getElementById('search_query').value)">
                    Рассчитать
                </a>
            </div>
        </div>

        <div style="columns">
            <section class="hero is-primary" style="border-radius: 4px;">
                <div class="hero-body">
                    <div class="container">
                    <h4 id="mean" class="title is-4">
                    </h4>
                    <h2 id="count" class="subtitle">
                    </h2>
                    </div>
                </div>
            </section>

            <section class="hero is-light" style="border-radius: 4px; margin-top: 10px;">
                <div class="hero-body">
                    <div class="container">
                        <h4 class="title is-4">Все цены:
                        </h4>
                        <h2 id="count" class="subtitle">
                        </h2>
                        <div class="column" style="">
                            <canvas id="myChart" width="600px" height="200px"></canvas> 
                        </div>
                    </div>
                </div>
            </section>

        </div>
          
        <div class="columns">
            <div class="column is-half">
                <h4 class="subtitle is-4">Наименьшая стоимость:</h4>
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <a>
                            <input id="min_prise" class="input is-primary" type="text" value="" disabled>
                        </a>                 
                    </div>
                    <div class="control">
                        <a class="button is-danger" onclick="delete_min();">
                            Удалить из расчета
                        </a>
                    </div>
                </div>
            </div>  

            <div class="column is-half">
                <h4 class="subtitle is-4">Наивысшая стоимость:</h4>
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <a>
                            <input id="max_prise" class="input is-primary" type="text"value="" disabled>
                        </a>                 
                    </div>
                    <div class="control">
                        <a class="button is-danger" onclick="delete_max();">
                            Удалить из расчета
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = check_old_prise(document.getElementById('part_id').value, document.getElementById('search_query').value);
        window.onbeforeunload = function (evt) {save_changes(document.getElementById('part_id').value, document.getElementById('search_query').value);}
    </script>
@endsection