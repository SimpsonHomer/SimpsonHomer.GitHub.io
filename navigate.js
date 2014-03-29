addListener(window, "keypress", function(key) {
key = key || window.event;
var theKey = key.which || key.keyCode;

switch (theKey) {
  case 37 :
    window.location = "#prev";
  case 39 :
    window.location = "#next";
}
