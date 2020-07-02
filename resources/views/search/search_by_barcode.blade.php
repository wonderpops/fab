@extends('main_layout')

@section('title')
<title>Поиск по штрихкоду</title>
@endsection

@section('main_content')
<div class="box cars-container">
        <div id="container">
            <div class="field">
                <label for="videoSource" class="label">Камера: </label>
                <div class="control is-expanded">
                    <div class="select is-fullwidth">
                        <select id="videoSource" class=""></select>
                    </div>
                </div>
            </div>
        </div>

    <section id="container" class="container">
    <div>
        <form>
            <div class="field">
                <label for="isbn_input" class="label">Штрих-код:</label>
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input id="isbn_input" class="input isbn" type="text" onchange="loadPage();">
                    </div>
                    <div class="control">
                        <a class="button is-primary" href="javascript: loadPage();">Перейти</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="field is-grouped is-grouped-centered">
        <div class="scaner_out">

        </div>
    </div>
</div>

<script src="/public/js/quagga.min.js" type="text/javascript"></script>
<script src="/public/js/barcode_search.js" type="text/javascript"></script>
@endsection