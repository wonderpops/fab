window.addEventListener("load", create_button, false);
var last_tg_news_id = 0;
var old_tg_news_id = 0;

function create_button(){
    document.body.innerHTML += '<a id="tg_button" class="tg_button" onclick="openNav()"><div class="tg_icon"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 455.731 455.731"><path style="fill:#FFFFFF;" d="M358.844,100.6L54.091,219.359c-9.871,3.847-9.273,18.012,0.888,21.012l77.441,22.868l28.901,91.706c3.019,9.579,15.158,12.483,22.185,5.308l40.039-40.882l78.56,57.665c9.614,7.057,23.306,1.814,25.747-9.859l52.031-248.76C382.431,106.232,370.443,96.08,358.844,100.6z M320.636,155.806L179.08,280.984c-1.411,1.248-2.309,2.975-2.519,4.847l-5.45,48.448c-0.178,1.58-2.389,1.789-2.861,0.271l-22.423-72.253c-1.027-3.308,0.312-6.892,3.255-8.717l167.163-103.676C320.089,147.518,324.025,152.81,320.636,155.806z"/></svg></div></a>'
    document.body.innerHTML += '<div id="tg_modal_background" class="tg_modal_background"></div>';
    document.body.innerHTML += '<div id="tg_sidepanel" class="tg_sidepanel"><div class="tg_chanel_name">t.me/dostavim03</div><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><div id="tg_main_container" class="tg_main_container"></div></div>'
    
    addStyle();
    get_tg_news();
}

var styleNode;
function addStyle() {
  styleNode = document.createElement("style");
  styleNode.innerText = "a.tg_button{display:block;z-index: 3;position: fixed;top: 10%;right: 0;height: 50px;width: 50px;text-decoration: none;user-select: none;outline: none;transition: 0.5s;background-color: rgb(0, 136, 204);border-top-left-radius: 15px;border-bottom-left-radius: 15px;}a.tg_button:hover{background-color: rgb(16, 109, 155);}a.tg_button:active {background: white;}";
  document.body.appendChild(styleNode);
}
function removeStyle() {
  styleNode.parentNode.removeChild(styleNode);
}

function openNav() {
    document.getElementById("tg_sidepanel").style.width = "500px";
    document.getElementById("tg_button").style.right = "500px";
    document.getElementById("tg_modal_background").style.backgroundColor = "rgba(0, 0, 0, 0.363)";
}

function closeNav() {
    document.getElementById("tg_sidepanel").style.width = "0";
    document.getElementById("tg_button").style.right = "0";
    document.getElementById("tg_modal_background").style.backgroundColor = "rgba(0, 0, 0, 0)";
}

function add_tg_post(text,date,img){
    x = document.getElementById('tg_main_container');
    y = x.innerHTML;
    x.innerHTML = '<div class="tg_post"><div class="tg_post_point"></div><div class="tg_post_content"><div id="tg_text" class="tg_post_text tg_hide_text">' + text + '</div><div id="tg_date" class="tg_post_date tg_hide_text">' + date + '</div></div><div class="tg_post_media"><img class="tg_img" src="'+ img + '"></img></div></div>';
    x.innerHTML += y;
}

function get_tg_news(){
    $.ajax({
        type: "POST",
        // url: "http://62.109.7.133/get_tg_news.php",
        url: "olo.php",
        contentType: "application/json; charset=utf-8"
    }).done(function( result )  {
        document.getElementById('tg_main_container').innerHTML = '';
        var result =  JSON.parse(result);
        console.log(result);
        result.forEach(element => {
            if (element!=null){
                if ((element['img']!=undefined) & (element['img'] != '')){
                    add_tg_post(element['text'], element['date'], 'http://62.109.7.133/'+element['img']);
                }
            }
        });
        //alert('loaded');
    });
}

setInterval('get_tg_news()', 10000);