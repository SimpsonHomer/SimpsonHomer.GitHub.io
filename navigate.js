function fadeandgotoabout(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/about.html"},500);
}

function fadeandgotoresources(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/resources.html"},500);
}

function fadeandgotoindex(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/index.html"},500);
}

function fadeandgotolinks(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/links.html"},500);
}

function addListener(element, type, response) {
        if (element.addEventListener) {
            element.addEventListener(type, response, false);
        }
        else if (element.attachEvent) {
            element.attachEvent("on" + type, response);
        }
    }

    addListener(window, "keypress", function(key) {
        // do this stuff when a key is pressed:

        key = key || window.event;
        var theKey = key.which || key.keyCode;

        switch (theKey) {
        // if they hit a
        case 97 :
	    fadeandgotoabout()
            break;
        // if they press r
        case 114 :
	    fadeandgotoresources()
            break;
            // if they hit l
        case 108 :
	    fadeandgotolinks()
            break;
        // if they press h
        case 104 :
	    fadeandgotoindex()
            break;
        }
    });

document.getElementsByClassName('about').onclick = fadeandgotoabout;
document.getElementsByClassName('resources').onclick = fadeandgotoresources;
document.getElementsByClassName('links').onclick = fadeandgotolinks;
document.getElementsByClassName('home').onclick = fadeandgotoindex;

/* window.onload = {
setTimeout(function(){document.getElementsByClassName="fadelater".style.animation-delay='0';},2000)
} */

function delay (URL) {
    setTimeout( function() { window.location.href = URL }, 150 );
}
