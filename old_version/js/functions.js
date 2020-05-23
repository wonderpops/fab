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
            //todo ok sign
            setTimeout(function(){document.location.href='?page=cars'}, 1000);
        }
    });
}

function editOnClick(){
    var fields = document.getElementsByName('field');
    var button = document.getElementById('editBtn');

    if (button.textContent == "Редактировать"){
        
        fields.forEach(function(item){
            item.removeAttribute('disabled');
        });
    
        button.textContent = "Сохранить";
    } else if (button.textContent == "Сохранить") {
        
        alert('Сохранено!');

        fields.forEach(function(item){
            item.setAttribute('disabled', '');
        });

        button.textContent = "Редактировать";
    }
}