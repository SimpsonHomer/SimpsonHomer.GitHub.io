function clear() {
document.getElementById('about').style.display = 'none';
document.getElementById('teaching').style.display = 'none';
document.getElementById('research').style.display = 'none';
document.getElementById('cv').style.display = 'none';
document.getElementById('contact').style.display = 'none';
}

function about() {
	document.getElementById('about').style.display = 'block';
	document.getElementById('teaching').style.display = 'none';
	document.getElementById('research').style.display = 'none';
	document.getElementById('cv').style.display = 'none';
	document.getElementById('contact').style.display = 'none';
}

function teaching() {
document.getElementById('teaching').style.display = 'block';
document.getElementById('about').style.display = 'none';
document.getElementById('research').style.display = 'none';
document.getElementById('cv').style.display = 'none';
document.getElementById('contact').style.display = 'none';
}

function research() {
	document.getElementById('about').style.display = 'none';
	document.getElementById('teaching').style.display = 'none';
document.getElementById('research').style.display = 'block';
document.getElementById('cv').style.display = 'none';
document.getElementById('contact').style.display = 'none';
}

function cv() {
	document.getElementById('about').style.display = 'none';
	document.getElementById('teaching').style.display = 'none';
	document.getElementById('research').style.display = 'none';
document.getElementById('cv').style.display = 'block';
document.getElementById('contact').style.display = 'none';
}

function contact() {
	document.getElementById('about').style.display = 'none';
	document.getElementById('teaching').style.display = 'none';
	document.getElementById('research').style.display = 'none';
	document.getElementById('cv').style.display = 'none';
document.getElementById('contact').style.display = 'block';
}