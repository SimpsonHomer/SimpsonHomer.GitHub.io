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
	    var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/about.html"},1000);
            break;
        // if they press r
        case 114 :
	    var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/resources.html"},1000);
            break;
            // if they hit l
        case 108 :
	    var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/links.html"},1000);
            break;
        // if they press h
        case 104 :
	    var myObj = document.getElementsByClassName('fade');
	    for(var i=0; i<myObj.length; i++){
		myObj[i].style['opacity'] = '0';
	    }
            setTimeout(function(){window.location.href = "/index.html"},1000);
            break;
        }
    });
