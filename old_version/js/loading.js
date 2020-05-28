document.body.classList.add('js-loading');
loading();
window.addEventListener("load", showPage, false);

function begin_loading(){
    var loading = anime({
        targets: ['.wheel'],
        translateY: ['-20rem', '0rem'],
        autoplay: true,
        loop: false,
        easing: 'spring(1, 80, 10, 0)',
    });
}

function loading(){
    var loading = anime({
        targets: ['.wheel'],
        rotate: 360,
        autoplay: true,
        loop: true,
        easing: 'linear'
    });
}

function end_loading(){
    var loading = anime({
        targets: ['.loading' , '.wheel'],
        background: 'rgba(75, 72, 218, .0)',
        autoplay: true,
        loop: false,
        easing: 'linear',
        duration: 500
    });
}

function pop_up(){
    var pop_up = anime({
        targets: ['.box', '.green'],
        translateY: ['13rem', '0rem'],
        borderRadius: '30px',
        autoplay: true,
        delay: 100,
        easing: 'spring(1, 80, 10, 0)'
    });
}

function removeClass() {
    document.body.classList.remove('js-loading');
}

function showPage() {
    end_loading();
    pop_up();
    setTimeout(removeClass, 1000);
}