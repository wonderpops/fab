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

function getPage(name, id){
    //alert(name);
    if (name == 'cars') {
        $.ajax({
            type: "GET",
            url: "get_cars_page.php",
        }).done(function( result )  {
            var results = document.getElementById('results');
            document.getElementById("main_container").innerHTML = result;
            alert('loaded');
            if (result == '') {
                result = '<div class="container has-text-centered"><h1 class="title is-2">Ничего не найдено :c</h1></div>'
                document.getElementById("main_container").innerHTML = result;
            }
        });
    } else if (name == 'add_car'){
        document.getElementById("main_container").innerHTML = '';
    }
}