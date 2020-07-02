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

function load_fields(type){
    console.log(type);
    $.ajax({
        type: "POST",
        url: "https://wonderpop.ru/get_fields.php",
        data:  {type: type}
    }).done(function( result )  {
        document.getElementById('fields').innerHTML = '';
        result =  JSON.parse(result);
        result.forEach(element => {
            if (element['column_comment'] != ''){
                console.log(document.getElementById('main_form').innerHTML);
                document.getElementById('fields').innerHTML += '<div class="field"><label class="label is-medium">' + element['column_comment'] + ':</label><div class="control"><input name="type_data[' + element['column_name'] + ']" class="input is-primary is-medium" type="text" placeholder="Введите ' + element['column_comment'].toLowerCase() + '" value=""></div></div>';
            }
        });
        console.log(result);
    });
}

function check_prise(part_id, query){
    console.log(part_id);
    console.log(query);
    $.ajax({
        type: "POST",
        url: "https://wonderpop.ru/prise_check.php",
        data:  {part_id: part_id, query: query}
    }).done(function( result )  {
        res =  JSON.parse(result);
        prises = [];
        var lables = [];
        res = res.filter(function(item) { 
            return item.prise != null
        })
        res.sort((a, b) => parseInt(a.prise.replace(' ', '')) > parseInt(b.prise.replace(' ', '')) ? 1 : -1);
        res.forEach(element => {
            if (element['prise'] != null){
                prises.push(parseInt(element['prise'].replace(' ', '')));
                lables.push(element['s_count']);
            }
        });
        console.log(prises);
        var ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lables,
                datasets: [{
                    label: 'Цена',
                    data: prises,
                    backgroundColor:'rgba(0, 209, 178, 0.5)',
                    borderColor: 'rgba(0, 209, 178, 1)',
                    borderWidth: 0
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        document.getElementById('count').innerText = 'Количество объявлений: ' + prises.length;
        document.getElementById('mean').innerText = 'Возможная цена: ' + Math.round(get_mean()) + 'р.';
        min = document.getElementById('min_prise');
        min.value = res[0].title;
        min.parentNode.href = res[0].link;
        max = document.getElementById('max_prise');
        max.value = res[res.length-1].title
        max.parentNode.href = res[res.length-1].link;
        $('#search').toggleClass('is-loading');
    });
}

function check_old_prise(part_id, query){
    console.log(part_id);
    console.log(query);
    $.ajax({
        type: "POST",
        url: "https://wonderpop.ru/old_prise_check.php",
        data:  {part_id: part_id, query: query}
    }).done(function( result )  {
        res =  JSON.parse(result);
        prises = [];
        var lables = [];
        res = res.filter(function(item) { 
            return item.prise != null
        })
        res.sort((a, b) => parseInt(a.prise.replace(' ', '')) > parseInt(b.prise.replace(' ', '')) ? 1 : -1);
        res.forEach(element => {
            if (element['prise'] != null){
                prises.push(parseInt(element['prise'].replace(' ', '')));
                lables.push(element['s_count']);
            }
        });
        console.log(prises);
        var ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: lables,
                datasets: [{
                    label: 'Цена',
                    data: prises,
                    backgroundColor:'rgba(0, 209, 178, 0.5)',
                    borderColor: 'rgba(0, 209, 178, 1)',
                    borderWidth: 0
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            offsetGridLines: true
                        }
                    }]
                }
            }
        });
        document.getElementById('mean').innerText = 'Возможная цена: ' + Math.round(get_mean()) + 'р.';
        document.getElementById('count').innerText = 'Количество объявлений: ' + prises.length;
        min = document.getElementById('min_prise');
        min.value = res[0].title;
        min.parentNode.href = res[0].link;
        max = document.getElementById('max_prise');
        max.value = res[res.length-1].title
        max.parentNode.href = res[res.length-1].link;
    });
}

function delete_min(){
    res.shift();
    prises.shift();
    min = document.getElementById('min_prise');
    min.value = res[0].title;
    min.parentNode.href = res[0].link;
    document.getElementById('mean').innerText = 'Возможная цена: ' + Math.round(get_mean()) + 'р.';
    document.getElementById('count').innerText = 'Количество объявлений: ' + prises.length;
    myChart.update();
}

function delete_max(){
    res.pop();
    prises.pop();
    max = document.getElementById('max_prise');
    max.value = res[res.length-1].title;
    max.parentNode.href = res[res.length-1].link;
    document.getElementById('mean').innerText = 'Возможная цена: ' + Math.round(get_mean()) + 'р.';
    document.getElementById('count').innerText = 'Количество объявлений: ' + prises.length;
    myChart.update();
}

function get_mean(){
    mean = 0;
    prises.forEach(element => {
        mean += element;
    });
    mean = mean / (prises.length);
    return mean;
}

function save_changes(part_id, query){
    console.log(part_id);
    console.log(query);
    json = JSON.stringify(res);
    $.ajax({
        type: "POST",
        url: "https://wonderpop.ru/save_changes.php",
        data:  {part_id: part_id, query: query, json: json}
    }).done(function( result )  {
        console.log(result);
    });
}