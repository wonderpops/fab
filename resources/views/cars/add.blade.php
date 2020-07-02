@extends('main_layout')

@section('title')
<title>Добавить машину</title>
@endsection

@section('main_content')
    <div class="box cars-container">
        <div class="columns">
            
            
            <div class="column">

                <form id="car_form" action="{{ route('cars.add') }}" method="post">
                    {{ csrf_field() }}

                    <div class="field">
                        <label class="label is-medium">Название:</label>
                        <div class="control">
                            <input name="name" class="input is-primary is-medium" type="text" placeholder="Введите название машины" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Год выпуска:</label>
                        <div class="control">
                            <input name="manufacture_year" class="input is-primary is-medium" type="text" placeholder="Введите год выпуска машины" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Аукционная оценка:</label>
                        <div class="control">
                            <input name="valuation" class="input is-primary is-medium" type="text" placeholder="Введите аукционную оценку" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Код кузова:</label>
                        <div class="control">
                            <input name="body_code" class="input is-primary is-medium" type="text" placeholder="Введите код кузова" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Цвет кузова:</label>
                        <div class="control">
                            <input name="body_color" class="input is-primary is-medium" type="text" placeholder="Введите цвет кузова" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Код отделки:</label>
                        <div class="control">
                            <input name="interior_code" class="input is-primary is-medium" type="text" placeholder="Введите код отделки" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Код двигателя:</label>
                        <div class="control">
                            <input name="engine_code" class="input is-primary is-medium" type="text" placeholder="Введите код двигателя" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Тип коробки передач:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="gearbox_type" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете тип коробки</option>
                                    <option style="color: #363636">Автоматическая</option>
                                    <option style="color: #363636">Ручная</option>
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Код коробки передач:</label>
                        <div class="control">
                            <input name="gearbox_code" class="input is-primary is-medium" type="text" placeholder="Введите код коробки передач" value="">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label is-medium">Статус:</label>
                        <div class="control is-expanded">
                            <div class="select is-primary is-fullwidth is-medium">
                                <select name="status" class="input" type="text" style="color: hsl(0, 0%, 80%)" onchange="this.style.color = '#363636'">
                                    <option value="" disabled selected style="display: none">Выберете статус машины</option>
                                    <option style="color: #363636">Разбирается</option>
                                    <option style="color: #363636">Разобрана</option>
                                </select>
                              </div>
                        </div>
                    </div>
                    
                    @if (Session::has('path'))
                    <input id="image_name" name="image" class="input is-primary is-medium" type="hidden" placeholder="Medium sized input" value="{{ '/storage/'.Session::get('path') }}">
                    @endif
                </form>

            </div>

            <div class="column is-4">
                <figure class="image is-4by3" style="margin-bottom: calc(1em - 1px); border-radius: 6px; border: 2px solid #dbdbdb;">
                    @if (Session::has('path'))
                        <div id="path" style="display: none">{{ $path = Session::get('path') }}</div>
                        <script>window.onload = function() {crop_image(document.getElementById('path').innerText);}</script>
                        <img id="img_place" src="" style=" " alt="Placeholder image">
                    @else
                        <img id="car_img" src="{{ asset('/storage/uploads/9lMVK3LPc2w8xgg4LyGynuqRftpiLA2AqOJlhKga.png')}}" style="border-radius: 6px;" alt="Placeholder image">
                    @endif
                </figure>
                <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input id="last_route" name="last_route" type="hidden" placeholder="Medium sized input" value="cars.add">

                    <div class="file has-name is-fullwidth">
                        <label class="file-label">
                          <input class="file-input" type="file" name="image" onchange="form.submit();">
                          <span class="file-cta">
                            <span class="file-icon">
                              <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                              Choose a file…
                            </span>
                          </span>
                          <span class="file-name">
                            @if(isset($path))
                                {{ $path }}
                            @else
                                Добаьте фото
                            @endif
                          </span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="field is-grouped is-grouped-centered">
            <button type="submit" class="button is-primary is-fullwidth" onclick="document.getElementById('car_form').submit();">Добавить</button>
        </div>
    </div>
@endsection