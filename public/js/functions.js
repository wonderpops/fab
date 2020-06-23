function edit_enable(element){
    var x = Array.from(document.getElementsByClassName('input')); 
    console.log(x); 
    x.forEach(function(item){item.removeAttribute('disabled');}); 
    console.log(element.parentNode); 
    element.parentNode.innerHTML = '<button class="button is-primary is-fullwidth">Сохранить</button>';
}

function copy_link(){
    var $tmp = $("<textarea>");
    $("body").append($tmp);
    $tmp.val(document.location.href).select();
    document.execCommand("copy");
    $tmp.remove();
}

function crop_image(path){
    $.ajax({
        type: "POST",
        url: "https://wonderpop.ru/crop_image.php",
        data:  {path: path}
    }).done(function( result )  {
        console.log(result);
        document.getElementById('img_place').src = '/storage/'+path;
    });
}