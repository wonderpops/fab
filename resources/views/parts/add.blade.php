@extends('main_layout')

@section('main_content')
    <div class="box cars-container">
        <div class="columns">

            <div class="column is-4">

                <figure class="image is-4by3" style="margin-bottom: calc(1em - 1px); border-radius: 6px; border: 2px solid #dbdbdb;">
                    @if (Session::has('path'))
                        <div id="path" style="display: none">{{$path = Session::get('path')}}</div>
                        <script>window.onload = function() {crop_image(document.getElementById('path').innerText);}</script>
                        <img id="img_place" src="" style=" " alt="Part image">
                    @else
                        <img id="car_img" src="{{ asset('/storage/uploads/9lMVK3LPc2w8xgg4LyGynuqRftpiLA2AqOJlhKga.png')}}" style="border-radius: 6px;" alt="Part image">
                    @endif
                </figure>
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
                                Выберете фото
                            @endif
                          </span>
                        </label>
                    </div>
                </form>

                <form action="{{ route('parts.add') }}" method="post">
                    {{ csrf_field() }}

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
                                <select name="type" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете тип детали</option>
                                    @foreach ($items = DB::table('types')->get() as $item)
                                            <option style="color: #363636">{{$item->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>

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
                        <label class="label is-medium">Стоимость:</label>
                        <div class="control">
                            <input name="cost" class="input is-primary is-medium" type="text" placeholder="Введите стоимость детали" value="">
                        </div>
                    </div>
                    
                    @isset($path)
                    <input id="image_name" name="image" class="input is-primary is-medium" type="hidden" placeholder="Medium sized input" value="{{ '/storage/'.$path }}">
                    @endisset
                    <div class="field is-grouped is-grouped-centered">
                        <button type="submit" class="button is-primary is-fullwidth">Добавить</button>
                    </div>
                </form>

            </div>

            <div class="column">

            </div>

        </div>
    </div>
@endsection