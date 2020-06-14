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

function load_image(type, id){ 
    var loader = new Image();

    loader.src = 'res/loader.gif';

    loader.onload = function(){
        var image = new Image();
        image.src = 'res/'+ type + '_id_' + id + '_4by3.jpg';
        image.onload = function(){
                $('#img-'+id)
                .attr('src', this.src)
                .fadeIn(600);
        }
    }
}

function editOnClick(table, id){
    
    var fields = document.getElementsByName('field');
    var button = document.getElementById('editBtn');

    if (button.textContent == "Редактировать"){
        
        fields.forEach(function(item){
            item.removeAttribute('disabled');
        });
    
        button.textContent = "Сохранить";
    } else if (button.textContent == "Сохранить") {

        var json = {};

        fields.forEach(function(item){
            item.setAttribute('disabled', '');
            json[item.id] = item.value;
        });

        //console.log(id);
        //console.log(table);
        console.log(json);
        $.ajax({
            type: "POST",
            url: "save_changes.php",
            data:  {table:table,
                    id:id,
                    fields: json
                    }
        }).done(function( result )  {
            console.log(result);
            alert('saved');
        });

        button.textContent = "Редактировать";
    }
}