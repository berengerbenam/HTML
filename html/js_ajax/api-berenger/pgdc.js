window.onload = function (){
	const button = document.querySelector('input[type=button]');
	button.onclick = calculerPgdc;
}
function calculerPgdc(){
	const api_url = 'http://api.demoajax.sn/pgdc.php'
	const xhr = new XMLHttpRequest();

	xhr.onload = function (){
		resultat.innerHTML = `PGDC = ${xhr.responseText}`;
	}

	const form = document.querySelector('form');
	let data = new FormData(form);

	xhr.open('POST',api_url);
	xhr.send(data);
}
