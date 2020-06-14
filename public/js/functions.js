function edit_enable(element){
    var x = Array.from(document.getElementsByClassName('input')); 
    console.log(x); 
    x.forEach(function(item){item.removeAttribute('disabled');}); 
    console.log(element.parentNode); 
    element.parentNode.innerHTML = '<button class="button is-primary is-fullwidth">Сохранить</button>';
}