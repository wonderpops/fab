var Quagga = window.Quagga;
var videoSelect = document.querySelector('select#videoSource');
var sad = document.querySelector('input.isbn');
var App = {
    _scanner: null,
    _dev_id: null,
    init: function() {
        this.attachListeners();
    },
    activateScanner: function() {
        var scanner = this.configureScanner('.overlay__content'),
            onDetected = function (result) {
                document.querySelector('input.isbn').value = result.codeResult.code;
                document.querySelector('select#videoSource').setAttribute('disabled', 'true');
                loadPage();
                stop();
            }.bind(this),
            stop = function() {
                scanner.stop();  // should also clear all event-listeners?
                scanner.removeEventListener('detected', onDetected);
                this.hideOverlay();
                this.attachListeners();
            }.bind(this);

        // this.showOverlay(stop);
        scanner.addEventListener('detected', onDetected).start();
    },
    attachListeners: function() {
        // var self = this,
        //     button = document.querySelector('.input-field input + button.scan');
        //     button.id = 'scan_btn';

        // button.addEventListener("click", function onClick(e) {
        //     e.preventDefault();
        //     button.removeEventListener("click", onClick);
        //     self.activateScanner();
        // });
    },
    showOverlay: function(cancelCb) {
        // if (!this._overlay) {
        //     var content = document.createElement('div'),
        //         closeButton = document.createElement('div');

        //     closeButton.appendChild(document.createTextNode('X'));
        //     content.className = 'overlay__content';
        //     closeButton.className = 'overlay__close';
        //     closeButton.id = 'close_btn'
        //     this._overlay = document.createElement('div');
        //     this._overlay.className = 'overlay';
        //     this._overlay.appendChild(content);
        //     content.appendChild(closeButton);
        //     closeButton.addEventListener('click', function closeClick() {
        //         closeButton.removeEventListener('click', closeClick);
        //         cancelCb();
        //     });
        //     document.body.appendChild(this._overlay);
        // } else {
        //     // var closeButton = document.querySelector('.overlay__close');
        //     // closeButton.addEventListener('click', function closeClick() {
        //     //     closeButton.removeEventListener('click', closeClick);
        //     //     cancelCb();
        //     // });
        // }
        // this._overlay.style.display = "block";
    },
    hideOverlay: function() {
        if (this._overlay) {
            this._overlay.style.display = "none";
        }
    },
    configureScanner: function(selector) {
        if (!this._scanner) {
            this._scanner = Quagga
                .decoder({readers: ['code_39_reader']})
                .locator({patchSize: 'medium'})
                .fromSource({
                    target: '.scaner_out',
                    constraints: {
                        width: 800,
                        height: 600,
                        deviceId: this._dev_id
                    }
                });
        }
        return this._scanner;
    }
};

function get_cookie ( cookie_name )
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}

window.onload = function(){
    document.cookie = "loaded = true";
    console.log(get_cookie('loaded'));
    getDevices().then(gotDevices);
        function getDevices() {
        return navigator.mediaDevices.enumerateDevices();
    }
}

function gotDevices(deviceInfos) {
    // TODO Переделать
  window.deviceInfos = deviceInfos; // make available to console
  //console.log('Available input and output devices:', deviceInfos);
  for (const deviceInfo of deviceInfos) {
    const option = document.createElement('option');
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === 'audioinput') {
    //   option.text = deviceInfo.label || `Microphone ${audioSelect.length + 1}`;
    //   audioSelect.appendChild(option);
    } else if (deviceInfo.kind === 'videoinput') {
      option.text = deviceInfo.label || `Camera ${videoSelect.length + 1}`;
      videoSelect.appendChild(option);
    }
  }

  App._dev_id = $(videoSelect.childNodes[videoSelect.childElementCount-1]).val();
  $(videoSelect).val($(videoSelect.childNodes[videoSelect.childElementCount-1]).val());
  App.init();
  App.activateScanner();
}

console.log(videoSelect.childElementCount);
$(videoSelect).change(function(){
   
    App._dev_id = $(this).val();
    if (App._scanner){
        App._scanner.stop();
        App._scanner = null;
        App.activateScanner();
    } else {
        App.activateScanner();
    }
    console.log(App);
});

$(sad).change = loadPage();

function loadPage()
{
    x = document.querySelector('input.isbn').value;

    c = x.split('CAR');
    if (c.length > 1) {
        document.location.href = document.location.href.replace('search_by_barcode', 'cars/'+parseInt(c[1]).toString());
    }

    p = x.split('PART');
    if (p.length > 1) {
        //document.location.href = document.location.href.replace('search_by_barcode', 'parts/' + parseInt(p[1]).toString() + '/main');
    }
}

//console.log(App);
