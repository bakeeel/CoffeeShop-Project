/*

Keegan Fargher
17920334
I confirm that this assignment is my own work and any work copied shall be referenced accordingly.

*/

function showLoader() {
	let button = document.getElementById('submit');
	button.textContent = '';

	var loader = "<div class='spinner'></div>";
	button.innerHTML += loader;
}
