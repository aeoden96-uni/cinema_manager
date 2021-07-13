$(document).ready(function () {
	//alert('New game started');
	main();
});


MARGIN = null;
UNIT_SIZE = 50;


var tablica = null;

var x_mouse = 0;
var y_mouse = 0;

var mouse = { x: 0, y: 0 };
var block = { i: 0, j: 0 };

var canvas = null;
var ctx = null;



function draw_seat2(j, i, mar = 5, color = '#0D736280') { // i ide od gore, j od lijevo
	/* crta poligon
	
		y,x	  *-----* y2,x
			 /	   /
	y_d,x_d *-----*  y_d2,x_d
	
	*/



	var mjesto = {
		gd: { x: 0, y: 0 },
		gl: { x: 0, y: 0 },
		dd: { x: 0, y: 0 },
		dl: { x: 0, y: 0 }

	};

	ctx.fillStyle = color;
	var br_redova = tablica.length;
	var br_sjedala = tablica[0].length;


	var sjedalo_h = (canvas.height - MARGIN) / br_redova;
	var sjedalo_w_gore = ((canvas.width - 2 * MARGIN) / br_sjedala);
	var sjedalo_w_dolje = (canvas.width / (br_sjedala));





	var x0 = MARGIN + i * sjedalo_w_gore;
	var xn = i * sjedalo_w_dolje;

	var y0 = MARGIN;
	var yn = MARGIN + br_redova * sjedalo_h;

	var y0_desno = y0;
	var yn_desno = yn;

	var x0_desno = x0 + sjedalo_w_gore;
	var xn_desno = xn + sjedalo_w_dolje;



	//var x; trazi

	mjesto.gl.y = MARGIN + j * sjedalo_h + mar;
	mjesto.gd.y = MARGIN + j * sjedalo_h + mar;
	mjesto.dd.y = MARGIN + (j + 1) * sjedalo_h - mar;
	mjesto.dl.y = MARGIN + (j + 1) * sjedalo_h - mar;

	mjesto.gl.x = tockaKrozPravac(x0, y0, xn, yn, mjesto.gl.y) + mar;
	mjesto.gd.x = tockaKrozPravac(x0_desno, y0_desno, xn_desno, yn_desno, mjesto.gd.y) - mar;
	mjesto.dl.x = tockaKrozPravac(x0, y0, xn, yn, mjesto.dl.y) + mar;
	mjesto.dd.x = tockaKrozPravac(x0_desno, y0_desno, xn_desno, yn_desno, mjesto.dd.y) - mar;



	ctx.beginPath();
	ctx.moveTo(mjesto.gl.x, mjesto.gl.y);
	ctx.lineTo(mjesto.dl.x, mjesto.dl.y);
	ctx.lineTo(mjesto.dd.x, mjesto.dd.y);
	ctx.lineTo(mjesto.gd.x, mjesto.gd.y);

	ctx.closePath();
	ctx.fill();
}

function tockaKrozPravac(prvaX, prvaY, drugaX, drugaY, Y) {
	//poznat Y
	return (drugaX - prvaX) / (drugaY - prvaY) * (Y - prvaY) + prvaX;
}

function draw_seats() {

	for (i = 0; i < tablica.length; i++) { //i == 1 ... 5
		for (j = 0; j < tablica[0].length; j++) {//j == 1 ... 10
			draw_seat2(i, j);
		}
	}
}

function drawTable() {
	ctx.fillStyle = 'black';


	ctx.fillRect(
		MARGIN,
		0,
		canvas.width - 2 * MARGIN,
		MARGIN);


	draw_seats();
}








var numOfSeatsSelected = 0;
var MAXSeats = 4;
var seatsSelected = [];


function markIt() {//oznacava jednu celiju

	if (disableButton) return;
	//ako je block rezerviran od nekog drugog,ne diraj ga
	if (tablica[block.j][block.i] > 2) return;

	//ako je odabrano previse blockova
	if (numOfSeatsSelected >= MAXSeats && tablica[block.j][block.i] == 0) {
		alert("Možeš odabrati maksimalno " + MAXSeats + " mjesta.");
		return;
	}

	//oznaci block kao rezerviran=1 ili slobodan=0
	tablica[block.j][block.i] = (tablica[block.j][block.i] + 1) % 2;

	if (tablica[block.j][block.i] == 1) {
		console.log("Oznacio sam celiju " + (block.j + 1) + "," + (block.i + 1));
		numOfSeatsSelected++;

		seatsSelected.push({ i: (block.j + 1), j: (block.i + 1) });

		var list = document.getElementById('myList');
		item = "Mjesto " + (block.j + 1) + "," + (block.i + 1);
		addItemToHTMLList(list, item);


	}
	else {
		numOfSeatsSelected--;

		item = { i: (block.j + 1), j: (block.i + 1) };
		removeItemFromJSList(item);

		var lis = document.querySelectorAll('#myList li');
		item = "Mjesto " + (block.j + 1) + "," + (block.i + 1);
		removeItemFromHTMLList(item, lis);

	}

	updateButtonOdaberi();

}


function addItemToHTMLList(lis, item) {
	var entry = document.createElement('li');
	entry.appendChild(document.createTextNode(item));
	entry.className = "list-group-item";
	lis.appendChild(entry);
}


function removeItemFromHTMLList(item, lis) { // mice item iz HTML liste

	for (var i = 0; li = lis[i]; i++) {
		if (li.innerHTML == item)
			li.parentNode.removeChild(li);
	}

}

function removeItemFromJSList(item) { // mice item iz JS liste

	//console.log("micem iz JS liste item = " + JSON.stringify(item));

	var filtered = seatsSelected.filter(
		function (el) { return el.i != item.i || el.j != item.j });

	seatsSelected = filtered;

}

function removeAllMarked() {


	while (numOfSeatsSelected > 0) {
		numOfSeatsSelected--;



		item = { i: seatsSelected[0].i, j: seatsSelected[0].j };


		removeItemFromJSList(item);

		var lis = document.querySelectorAll('#myList li');
		item2 = "Mjesto " + (item.i) + "," + (item.j);
		removeItemFromHTMLList(item2, lis);

		tablica[item.i - 1][item.j - 1] = (tablica[item.i - 1][item.j - 1] + 1) % 2;

	}

	updateButtonOdaberi();

}

var disableButton = false;

function updateButtonOdaberi() {
	var button = document.getElementById('odaberi');

	if (/*numOfSeatsSelected > 0*/ true) {

		//console.log(numOfSeatsSelected);
		button.disabled = false;
	}
	else {
		//console.log(numOfSeatsSelected);
		button.disabled = true;
	}

}

function sellSeats() { //on click event
	disableButton = true;
	updateButtonOdaberi();
	showHide('spiner', false);

	console.log("Rezultat:");
	$.ajax(
		{
			url: "index.php?rt=employee/sell",
			data:
			{
				action: "sell",
				seats: seatsSelected,
				rez: parseInt(canvas.getAttribute('rezerv_id'))
			},
			type: "POST",
			dataType: "json",
			success: function (json) {
				console.log(json);

				if (json.uspjeh) {

					setTimeout(function () {

						window.location.href = "index.php?rt=employee/";

					}, 2000);
				}
				else {



					setTimeout(function () {
						showHide('spiner', true);

						alert("Molimo pokušajte ponovno.")
						disableButton = false;
					}, 2000);
				}


			},
			error: function (xhr, status, errorThrown) {
				//console.log(status); console.log(errorThrown);
			},
			complete: function (xhr, status) {
				//console.log(status);

			}
		});


}

function removeSeats() { //on click event
	disableButton = true;
	updateButtonOdaberi();
	showHide('spiner', false);

	console.log("Rezultat:");
	$.ajax(
		{
			url: "index.php?rt=employee/sell",
			data:
			{
				action: "delete",
				seats: seatsSelected,
				rez: parseInt(canvas.getAttribute('rezerv_id'))
			},
			type: "POST",
			dataType: "json",
			success: function (json) {
				console.log(json);

				if (json.uspjeh) {

					setTimeout(function () {

						window.location.href = "index.php?rt=employee/";

					}, 2000);
				}
				else {

					setTimeout(function () {
						showHide('spiner', true);
						alert("Molimo pokušajte ponovno.")
						disableButton = false;
					}, 2000);
				}


			},
			error: function (xhr, status, errorThrown) {
				//console.log(status); console.log(errorThrown);
			},
			complete: function (xhr, status) {
				//console.log(status);

			}
		});


}


function showHide(id, hide = true) {
	if (hide)
		document.getElementById(id).style.display = 'none';
	else
		document.getElementById(id).style.display = 'block';
}

function drawMarked() { //crta SVE elemente tablice
	var marg = 3;
	for (i = 0; i < tablica.length; i++)
		for (j = 0; j < tablica[0].length; j++) {
			if (tablica[i][j] == 1) {

				ctx.fillStyle = "red";
				draw_seat2(i, j, 5, "red");
			}
			else if (tablica[i][j] == 2) {
				draw_seat2(i, j, 5, "gray");
			}
			else if (tablica[i][j] == 3) {
				draw_seat2(i, j, 5, "blue");
			}

		}

}

function drawStatic() { //crta tablicu i njene elemente
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	drawTable();
	drawMarked();

}

function drawHover() {

	if (disableButton) return;
	if (block.i < 0 || block.j < 0) return;

	// i == STUPCI    j== REDOVI
	if (block.i > tablica[0].length - 1 || block.j > tablica.length - 1) return;

	if (tablica[block.j][block.i] >= 2) return;
	var marg = 8;

	ctx.fillStyle = "yellow";
	//ctx.fillRect(MARGIN+ block.i*UNIT_SIZE+marg, MARGIN+ block.j*UNIT_SIZE+marg, UNIT_SIZE-marg*2, UNIT_SIZE-marg*2);
	//ctx.fillRect(MARGIN+ x*UNIT_SIZE, MARGIN+ y*UNIT_SIZE, UNIT_SIZE, UNIT_SIZE);
	draw_seat2(block.j, block.i, mar = 8, color = "yellow")



	ctx.font = "20px Arial";
	ctx.fillStyle = "blue";
	ctx.globalAlpha = 0.2;
	ctx.fillRect(mouse.x + 30, mouse.y, 150, 50);
	ctx.fillStyle = "black";
	ctx.globalAlpha = 1.0;

	ctx.fillText("Select seat", mouse.x + 35, mouse.y + 20);
	ctx.fillText("(row " + (block.j + 1) + "," + (block.i + 1) + ". seat)", mouse.x + 45, mouse.y + 40);

}


function refreshActiveBlock(x, y) {
	//SETS variables block.i,block.j

	var br_redova = tablica.length;

	var sjedalo_h = (canvas.height - MARGIN) / br_redova;

	block.j = parseInt((y - MARGIN) / sjedalo_h);

	var marg = MARGIN * (tablica.length - block.j) / tablica.length;

	block.i = parseInt((x - marg) / ((canvas.width - 2 * marg) / tablica[0].length));



}


function oznaciKupljena(prikaz_id) {
	console.log("Oznacavam kupljena za proj_id: " + prikaz_id);
	$.ajax(
		{
			url: "index.php?rt=user/vratiZauzetaMjesta/" + prikaz_id,
			data:
			{
			},
			type: "POST",
			dataType: "json",
			success: function (json) {

				console.log("Dobio " + json.length + " zauzeta sjedala.");

				json.forEach(element => {

					tablica[element.red - 1][element.broj_u_redu - 1] = 2;
				});


			},
			error: function (xhr, status, errorThrown) {
				console.log(errorThrown);
			},
			complete: function (xhr, status) {
				//console.log(xhr);

			}
		});


}

function oznaciRezervirana(rez_id) {

	console.log("Oznacavam kupljena za proj_id: " + rez_id);
	$.ajax(
		{
			url: "index.php?rt=employee/vratiRezervMjesta/" + rez_id,
			data:
			{
				id: rez_id
			},
			type: "POST",
			dataType: "json",
			success: function (json) {

				console.log("Dobio ");
				console.log(json);

				json.forEach(element => {

					tablica[element.red - 1][element.broj_u_redu - 1] = 3;

					var list = document.getElementById('myList');
					item = "Reserved seat " + (element.red) + "," + (element.broj_u_redu);
					addItemToHTMLList(list, item);

					seatsSelected.push({ i: (element.red), j: (element.broj_u_redu) });

				});


			},
			error: function (xhr, status, errorThrown) {
				console.log(errorThrown);
			},
			complete: function (xhr, status) {
				//console.log(xhr);

			}
		});


}

function main() {



	canvas = document.getElementById('myBoard');
	ctx = canvas.getContext('2d');

	var size_x = parseInt(canvas.getAttribute('br_redova'));
	var size_y = parseInt(canvas.getAttribute('velicina_reda'));

	console.log(size_x + "," + size_y);

	if (size_x > 8)
		MARGIN = canvas.width * 0.15;
	else
		MARGIN = canvas.width * 0.25;
	tablica = new Array(size_x);
	for (var i = 0; i < tablica.length; i++) {
		tablica[i] = new Array(size_y).fill(0);
	}

	oznaciKupljena(parseInt(canvas.getAttribute('prikaz_id'))); //id

	setTimeout(function () {
		oznaciRezervirana(parseInt(canvas.getAttribute('rezerv_id'))); //ova su zapravo potenc kupljena --employee
	}, 200);


	//getInitData();


	canvas.onmousemove = function (e) {

		drawStatic();

		var rect = this.getBoundingClientRect();
		mouse.x = e.clientX - rect.left;
		mouse.y = e.clientY - rect.top;

		refreshActiveBlock(mouse.x, mouse.y);

		drawHover();




	};

	canvas.addEventListener('click', function () {
		if (block.i >= 0 && block.i < tablica[0].length && block.j >= 0 && block.j < tablica.length) {
			if (tablica[block.j][block.i] < 2) {
				markIt();
				drawStatic();
				drawHover();
			}
		}
	}, false);

}