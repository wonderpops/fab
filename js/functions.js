function insertInTable(){
    var inp = document.getElementById("car_name");
    var text = document.getElementById("car_comment");
    var carname = inp.value;
    var carcom = text.value;

    $.ajax({
        type: "POST",
        url: "add_car.php",
        data:  {name:carname,
                comment:carcom}
    }).done(function( result )  {
        if (result == 'ok') {
            setTimeout(function(){document.location.href='?page=cars'}, 1000);
        }
    });
}
