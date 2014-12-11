function fadeandgotoabout(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelater');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelatest');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/about.html"},200);
}

function fadeandgotoresources(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelater');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelatest');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/resources.html"},200);
}

function fadeandgotoindex(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelater');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelatest');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/index.html"},200);
}

function fadeandgotolinks(){
var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelater');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
var myObj = document.getElementsByClassName('fadelatest');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/links.html"},200);
}

function chuckify(){
document.body.style.Transition="background 1s ease";
document.body.style.WebkitTransition="background 1s ease";
document.body.style.MozTransition="background 1s ease";
document.body.style.OTransition="background 1s ease";
document.body.style.msTransition="background 1s ease";
document.body.style.backgroundRepeat="no-repeat";
document.body.style.backgroundPosition="center";
document.body.style.backgroundImage="url('chuckface.jpg')";
}

function ruthspin(){
var ruth = document.getElementsByClassName('ruth');
    ruth.style.Transition="rotate(36000deg)";
    ruth.style.WebkitTransition="rotate(36000deg)";
    ruth.style.MozTransition="rotate(36000deg)";
    ruth.style.OTransition="rotate(36000deg)";
    ruth.style.msTransition="rotate(36000deg)";
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
	// if they press C
	case 67 :
	    chuckify()
	    break;
	case 82 :
	    ruthspin()
	    break;
        }
    });
