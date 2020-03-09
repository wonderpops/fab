function saveCar(){
    $.ajax({
        type: "POST",
        url: "get_cars_page.php",
    }).done(function( result )  {
        var results = document.getElementById('results');
        document.getElementById("main_container").innerHTML = result;
    });
}