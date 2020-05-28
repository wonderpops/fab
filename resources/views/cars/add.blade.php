@extends('main_layout')

@section('main_content')
    <div class="box cars-container">
        <div class="columns">
            <div class="column is-4">
                <figure class="image is-4by3" style="margin-bottom: calc(1em - 1px);">
                    @isset($path)
                    <img id="car_img" src="{{ asset('/storage/'. $path)}}" style="border-radius: 6px;" alt="Placeholder image">
                    @endisset
                </figure>

                <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="file has-name">
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
                            @isset($path)
                            {{ $path }}
                            @endisset
                          </span>
                        </label>
                    </div>
                </form>

                <form action="{{ route('cars.add') }}" method="post">
                    {{ csrf_field() }}

                    <div class="field">
                        <label class="label is-medium">Название:</label>
                        <div class="control">
                            <input name="name" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label is-medium">ВИН:</label>
                        <div class="control">
                            <input name="vin" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="">
                        </div>
                    </div>
                    
                    @isset($path)
                    <input id="image_name" name="image" class="input is-primary is-medium" type="text" placeholder="Medium sized input" value="{{ asset('/storage/'. $path)}}">
                    @endisset
                    <div class="field is-grouped is-grouped-centered">
                        <button type="submit" class="button is-primary is-inverted">
                            Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="column">

            </div>
        </div>
    </div>
@endsection