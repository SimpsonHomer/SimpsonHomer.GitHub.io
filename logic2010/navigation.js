$(document).ready( function() {
    var previous = getPrevious(pages, files);
    var next = getNext(pages, files);

    $('body').append('<div class="navleft"><a href="' + previous + '">previous</a></div>');
    $('body').append('<div class="navright"><a href="' + next + '">next</a></div>');

$('a').each( function() {
    $(this).attr('target', '_self');
    });
});

function getPrevious(pages, files) {
    var title = document.title;
    var position = getPosition(title, pages);
    if (position === 0) {
	return files[position];
	}
    else {
	return files[position] + ".html";
	}
}

function getNext(pages, files) {
    var title = document.title;
    var position = getPosition(title, pages) + 2;
    if (position === files.length) {
	return files[position];
	}
    else {
	return files[position] + ".html";
	}
}

function getPosition(title, pages) {
    var i = 0;
    while (true) {
	if (title === pages[i]) {
	    return i;
	    }
	else
	    i++;
	}
    }

var pages = ["Table of Contents", "Introduction", "Chapter 1 Symbolization", "Chapter 1 Parsing", "Chapter 1 Derivations","Chapter 2 Symbolization", "Chapter 2 Parsing", "Chapter 2 Derivations", "Chapter 3 Symbolization", "Chapter 3 Parsing", "Chapter 3 Recognizing Rules", "Chapter 3 Derivations", "Keyboard Shortcuts"];

var files = ["#", "index", "intro", "Ch1Sym", "Ch1Parse", "Ch1Der", "Ch2Sym", "Ch2Parse", "Ch2Der", "Ch3Sym", "Ch3Parse", "Ch3Rules", "Ch3Der", "Keyboard", "#"];
