@extends('main_layout')

@section('main_content')
<form action="{{ route('parts.save_changes') }}" method="post">
    {{ csrf_field() }}
    <input name="part_id" type="hidden" placeholder="Medium sized input" value="{{$part->id}}">

    <div class="box cars-container">
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
                        <label class="label is-medium">Название:</label>
                        
                        <div class="control">
                            <input name="name" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$part->name}}" disabled>
                        </div>
                    </div>

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
                        <label class="label is-medium">Цена:</label>
                        <div class="control">
                            <input name="cost" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{$part->cost}}" disabled>
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

                    <input name="car_id" type="hidden" placeholder="Medium sized input" value="{{$part->id}}">
            </div>

            <div class="column">
            </div>
        </div>
    </div>
</form>
@endsection