@extends('main_layout')

@section('title')
<title>Добавить деталь</title>
@endsection

@section('main_content')
    <div class="box cars-container">
        <div style="width: 100%;height: 400px;overflow: hidden;margin-bottom: 10px; border-radius: 10px;">
            @if (Session::has('path'))
                <div id="path" style="display: none">{{$path = Session::get('path')}}</div>
                <script>window.onload = function() {crop_image(document.getElementById('path').innerText);}</script>
                <img id="img_place" src="" style="object-fit: cover;height: 100%;width: 100%;" alt="Part image">
            @else
                <img id="car_img" src="{{ asset('/storage/uploads/9lMVK3LPc2w8xgg4LyGynuqRftpiLA2AqOJlhKga.png')}}" style="object-fit: cover;height: 100%;width: 100%;" alt="Part image">
            @endif
        </div>
        <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input id="view_name" name="view_name" type="hidden" placeholder="Medium sized input" value="parts.add">

            <div class="file has-name is-fullwidth">
                <label class="file-label">
                  <input class="file-input" type="file" name="image" onchange="form.submit();">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">Выберете файл</span>
                  </span>
                  <span class="file-name">
                    @if(isset($path))
                        {{ $path }}
                    @else
                        Добавьте фото
                    @endif
                  </span>
                </label>
            </div>
        </form>
        <form id='main_form' action="{{ route('parts.add') }}" method="post">
            {{ csrf_field() }}
        <div class="columns">
            <div class="column is-4">
                    <div class="field">
                        <label class="label is-medium">Название:</label>
                        <div class="control">
                            <input name="name" class="input is-primary is-medium" type="text" placeholder="Введите название детали" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Тип:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="type" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'; load_fields(this.value);">
                                    <option value="" disabled selected style="display: none">Выберете тип детали</option>
                                    @foreach ($items = DB::table('types')->get() as $item)
                                            <option style="color: #363636">{{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>
                    @if (isset($car))
                        <input name="car_id" type="hidden" value="{{$car->id}}">
                        <div class="field">
                            <label class="label is-medium">Машина:</label>
                            <div class="control is-expanded">
                                <div class="select is-primary is-fullwidth is-medium">
                                    <select name="car_id" class="input" type="text" onchange="this.style.color = '#363636'" disabled>
                                        <option value="{{$car->id}}" style="color: #363636" selected>{{$car->name}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>    
                    @else

                    <div class="field">
                        <label class="label is-medium">Машина:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="car_id" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете от какой машины деталь</option>
                                    @foreach ($items = DB::table('cars')->get() as $item)
                                            <option value="{{$item->id}}" style="color: #363636">{{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>
                        
                    @endif        

                    <div class="field">
                        <label class="label is-medium">Статус:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="status" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете статус детали</option>
                                    <option style="color: #363636">На складе</option>
                                    <option style="color: #363636">Продана</option>
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Состояние:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="condition" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете состояние детали</option>
                                    <option style="color: #363636">Новая</option>
                                    <option style="color: #363636">Б/У</option>
                                </select>
                              </div>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label class="label is-medium">Оригинальность:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="originality" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете оригинальность детали</option>
                                    <option style="color: #363636">Оригинал</option>
                                    <option style="color: #363636">Копия</option>
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Стоимость:</label>
                        <div class="control">
                            <input name="prise" class="input is-primary is-medium" type="text" placeholder="Введите стоимость детали" value="">
                        </div>
                    </div>
                    
                    @isset($path)
                    <input id="image_name" name="image" class="input is-primary is-medium" type="hidden" placeholder="Medium sized input" value="{{ '/storage/'.$path }}">
                    @endisset


            </div>

            <div class="column">
                <div id="fields">

                </div>
            </div>
        

        </div>
        <div class="field is-grouped is-grouped-centered">
            <button type="submit" class="button is-primary is-fullwidth">Добавить</button>
        </div>
    </form>
    </div>
@endsection