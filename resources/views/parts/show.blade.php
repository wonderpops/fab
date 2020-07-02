@extends('main_layout')

@section('title')
<title>{{$part->name}}</title>
@endsection

@section('main_content')
<form action="{{ route('parts.save_changes') }}" method="post">
    {{ csrf_field() }}
    <input name="part_id" type="hidden" placeholder="Medium sized input" value="{{$part->id}}">

    <div class="box cars-container">
        
        <div class="tabs is-toggle is-fullwidth">
            <ul>
              <li class="is-active">
                <a href="/parts/{{$part->id}}/main">
                  <span class="icon is-small"><i class="fas fa-wrench" aria-hidden="true"></i></span>
                  <span>Характиристики</span>
                </a>
              </li>
              <li>
                <a href="/parts/{{$part->id}}/prise_check">
                  <span class="icon is-small"><i class="fas fa-money" aria-hidden="true"></i></span>
                  <span>Расчет цены</span>
                </a>
              </li>
            </ul>
          </div>
          
        <div class="columns">
            <div class="column is-4">
                    <figure class="image is-4by3" style="margin-bottom: calc(1em - 1px);">
                        <img src="{{$part->image}}" style="border-radius: 4px;" alt="Placeholder image">
                    </figure>

                    <div class="columns is-mobile">
                        <div class="column">
                            <a class="button is-fullwidth is-primary is-large is-light" onclick='$("#bcTarget").barcode("PART{{ sprintf("%06d", $part->id) }}", "code39",{barWidth:2, barHeight:30});window.print();   '>
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
                
            </div>
            
            <div class="column">
                <article class="panel" style="border: 1px #ededed solid; box-shadow: none;">
                    <P class="panel-heading">
                        Общие:
                    </P>
                    <div style="padding: 10px">
                        <div class="field">
                            <label class="label is-medium">Название:</label>
                            
                            <div class="control">
                                <input name="name" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$part->name}}" disabled>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label is-medium">Машина:</label>
                            <div class="control is-expanded">
                                <div class="select is-primary is-fullwidth is-medium">
                                    <select name="car_id" class="input" type="text" onchange="this.style.color = '#363636'" disabled>
                                        <option value="{{$car->id}}" style="color: #363636">{{$car->name}}</option>
                                        @foreach ($items = DB::table('cars')->get() as $item)
                                            @if ($item->id != $car->id)
                                                <option value="{{$item->id}}" style="color: #363636">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>  

                        <div class="field">
                            <label class="label is-medium">Статус:</label>
                            <div class="control is-expanded">
                                <div class="select is-primary is-fullwidth is-medium">
                                    <select name="status" class="input" type="text" disabled>
                                        <option>{{$part->status}}</option>
                                        @if ($part->status == 'На складе')
                                            <option>Продана</option>
                                        @else
                                            <option>На складе</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="field">
                            <label class="label is-medium">Состояние:</label>
                            <div class="control is-expanded">
                                <div class="select is-primary is-fullwidth is-medium">
                                    <select name="condition" class="input" type="text" disabled>
                                        <option>{{$part->condition}}</option>
                                        @if ($part->condition == 'Новая')
                                            <option>Б/У</option>
                                        @else
                                            <option>Новая</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label is-medium">Оригинальность:</label>
                            <div class="control is-expanded">
                                <div class="select is-primary is-fullwidth is-medium">
                                    <select name="originality" class="input" type="text" disabled>
                                        <option>{{$part->originality}}</option>
                                        @if ($part->originality == 'Оригинал')
                                            <option>Копия</option>
                                        @else
                                            <option>Оригинал</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label is-medium">Цена:</label>
                            <div class="control">
                                <input name="prise" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$part->prise}}" disabled>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="column">
                <article class="panel" style="border: 1px #ededed solid; box-shadow: none;">
                    <P class="panel-heading">
                        Детальные:
                    </P>
                    <div style="padding: 10px">
                        <div class="field">
                            <label class="label is-medium">Тип:</label>
                            <div class="control is-expanded">
                                <div class="select is-primary is-fullwidth is-medium">
                                    <select name="type" class="input" type="text" disabled>
                                        <option>{{$part->type}}</option>
                                        @foreach ($items = DB::table('types')->get() as $item)
                                            @if ($item->name != $part->type)
                                                <option>{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                            
                            @php
                                $type = $part->type;
                                $id = $part->id;
                                $items = DB::table($type)->where('part_id', '=', $id)->get();
                                $fields = DB::table('information_schema.columns') -> select('column_name','column_comment') -> whereRaw("table_schema = 'fab' and table_name = '$type'")->get();
                            @endphp

                            @foreach ( $items as $item)
                                @foreach ($fields as $it)
                                    @foreach ($item as $key => $object)
                                        @if (($it->column_name == $key) and ($it->column_comment != ''))
                                            <div class="field">
                                                <label class="label is-medium">{{$it->column_comment}}:</label>
                                                <div class="control">
                                                    <input name="type_data['{{$it->column_name}}']" class="input is-primary is-medium" type="text" placeholder="Введите ' + element['column_comment'].toLowerCase() + '" value="{{$object}}" disabled>
                                                </div>
                                            </div>                                 
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </article>
            </div>
        <div class="field is-grouped is-grouped-right">
            <div class="field" style="padding: 5px;">
                <label class="label" style="font-size: 12px; color: #bbb;">Дата создания:</label>
                <div class="control">
                    <h5 class="subtitle is-5" style="font-size: 12px; color: #bbb;">{{$part->created_at}}</h5>
                </div>
            </div>
            <div class="field" style="padding: 5px;">
                <label class="label" style="font-size: 12px; color: #bbb;">Дата редактирования:</label>
                <div class="control">
                    <h5 class="subtitle is-5" style="font-size: 12px; color: #bbb;">{{$part->updated_at}}</h5>
                </div>
            </div>
        </div>  
    </div>
</form>

<form id="delete_form" action="{{ route('parts.delete_part') }}" method="post">
    {{ csrf_field() }}
    <input name="part_id" type="hidden" value="{{$part->id}}">
    <input name="part_type" type="hidden" value="{{$part->type}}">
</form>
@endsection