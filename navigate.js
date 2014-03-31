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

        // http://stackoverflow.com/a/5420482
        key = key || window.event;
        var theKey = key.which || key.keyCode;

        switch (theKey) {
        // if they hit a
        case 65 :
            window.location.assign = "/about.html";
            break;
        // if they press r
        case 82 :
            window.location.assign = "/resources.html";
            break;
            // if they hit l
        case 76 :
            window.location.assign = "/links.html";
            break;
        // if they press h
        case 72 :
            window.location.assign = "/index.html";
            break;
        }
    });
