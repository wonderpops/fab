// $(document).ready(function(){

//     $(window).bind('hashchange', function() {
//         alert(location.hash);
//         showPage(location.hash)
//     });
//     showPage(location.hash)
// });

// function showPage(name){
//     if (name == '#cars') {
//         $.ajax({
//             type: "GET",
//             url: "get_cars_page.php",
//         }).done(function( result )  {
//             var results = document.getElementById('results');
//             document.getElementById("main_container").innerHTML = result;
//             if (result == '') {
//                 result = '<div class="container has-text-centered"><h1 class="title is-2">Ничего не найдено :c</h1></div>'
//                 document.getElementById("main_container").innerHTML = result;
//             }
//         });
//     } else if (name == '#add_car'){
//         document.getElementById("main_container").innerHTML = '';
//     }
// }
window.addEventListener('popstate', function(e) {
    // var search = location.search.substr(1)
    // .split('&') // разбиваем на параметры
    // .reduce(function (res, a) { // разбираем пары ключ-значение
    //     var t = a.split('=');

    //     // нужно декодировать и ключ и значение, значения может не быть
    //     res[decodeURIComponent(t[0])] = t.length == 1 ? null : decodeURIComponent(t[1]);
    //     return res;
    // }, {});
    if (e.state['id'] == undefined) {
        if ($('#modal_container').hasClass('is-active')){
            document.querySelector('#modal_container').classList.toggle('is-active');
        }
    } else {
        if (!$('#modal_container').hasClass('is-active')){
            document.querySelector('#modal_container').classList.toggle('is-active');
        }
    }
    // console.log(e.state['page']);
    // console.log(e.state['id']);
    // console.log(e.state['type']);

    getPage(e.state['page']);
    getItem(e.state['type'], e.state['id']);
    //$("body").removeClass("fixed");
    //rgb(241, 241, 241);
});

function getItem(type,id){
    // console.log(id);
    // console.log(type);

    if (id != undefined){
        if (type == 'car'){
            $.ajax({
                type: "POST",
                url: "car.php",
                data:  {type: type, id:id}
            }).done(function( result )  {
                document.getElementById("modal_container").classList.add('is-active');
                document.getElementById("modal_content").innerHTML = result;
                document.querySelector('div#modal_content.modal-container').scrollTop = 0;
                //alert('loaded');
            });
        } else if (type == 'part'){
            $.ajax({
                type: "POST",
                url: "part.php",
                data:  {type: type, id:id}
            }).done(function( result )  {
                document.getElementById("modal_container").classList.add('is-active');
                document.getElementById("modal_content").innerHTML = result;
                document.querySelector('div#modal_content.modal-container').scrollTop = 0;
                //alert('loaded');
            });
        }
    }
}

function getPage(name){
    //alert(name);
    if (name == 'cars') {
        $.ajax({
            type: "GET",
            url: "get_cars_page.php",
        }).done(function( result )  {
            var results = document.getElementById('results');
            document.getElementById("main_container").innerHTML = result;
            //alert('loaded');
            if (result == '') {
                result = '<div class="container has-text-centered"><h1 class="title is-2">Ничего не найдено :c</h1></div>'
                document.getElementById("main_container").innerHTML = result;
            }
        });
    } else if (name == 'add_car'){
        document.getElementById("main_container").innerHTML = "<div class='column'></div><div class='column is-7'><div class='card'><div class='card-image'><figure class='button car_image image is-3by1'><img class='fup' src='res/fup.svg' border='80' alt='Placeholder image'></figure></div><div class='card-content'><div class='media'><div class='media-content'><p class='title is-4'>О машине</p><input id='car_name' class='input is-rounded' type='text' placeholder='Имя'><p class='subtitle is-6'></p><textarea id='car_comment' class='textarea' placeholder='Описание'></textarea><p class='subtitle is-6'></p><div class='field is-grouped is-grouped-centered'><p class='control'><a onclick='insertInTable()' class='button is-link'>Сохранить</a></p></div></div></div></div></div></div><div class='column'></div>";
    } else if (name == 'parts'){
        $.ajax({
            type: "GET",
            url: "get_parts_page.php",
        }).done(function( result )  {
            var results = document.getElementById('results');
            document.getElementById("main_container").innerHTML = result;
            //alert('loaded');
            if (result == '') {
                result = '<div class="container has-text-centered"><h1 class="title is-2">Ничего не найдено :c</h1></div>'
                document.getElementById("main_container").innerHTML = result;
            }
        });
    }
}