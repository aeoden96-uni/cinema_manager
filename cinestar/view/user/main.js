$(document).ready(function () {
	//alert('New game started');
	main();
});


MARGIN = 200;
UNIT_SIZE = 50;
IKONE = [1, 2, 3, 4, 5]

var podaci = null;
var vraceno = null;
var tablica = null;
var marked = [];
var block = {
	x: null,
	y: null
};

var x_mouse = 0;
var y_mouse = 0;

var mouse = { x: 0, y: 0 };
var block = { i: 0, j: 0 };

var canvas = null;
var ctx = null;



function draw_seat2(i, j, mar = 5, color = '#0D736280') { // i ide od gore, j od lijevo
	/* crta poligon
	
		y,x	  *-----* y2,x
			 /	   /
	y_d,x_d *-----*  y_d2,x_d
	
	*/
	ctx.fillStyle = color;

	//
	var x0 = MARGIN;
	var xn = MARGIN + tablica.length * UNIT_SIZE;

	var y0 = MARGIN + j * UNIT_SIZE;
	var yn = j * (canvas.width / (tablica[0].length));

	var y0_desno = y0 + UNIT_SIZE;
	var yn_desno = yn + (canvas.width / (tablica[0].length));


	var x = MARGIN + i * UNIT_SIZE + mar;
	var x_d = x + UNIT_SIZE - 2 * mar;

	var y = (yn - y0) / (xn - x0) * (x - xn) + yn + mar;
	var y_d = (yn - y0) / (xn - x0) * (x_d - xn) + yn + mar;

	//


	var y2 = (yn_desno - y0_desno) / (xn - x0) * (x - xn) + yn_desno - mar;
	var y_d2 = (yn_desno - y0_desno) / (xn - x0) * (x_d - xn) + yn_desno - mar;


	ctx.beginPath();
	ctx.moveTo(y, x);
	ctx.lineTo(y_d, x_d);
	ctx.lineTo(y_d2, x_d);
	ctx.lineTo(y2, x);

	ctx.closePath();
	ctx.fill();
}

function draw_seat() {

	for (i = 0; i < tablica.length; i++) { //i == 1 ... 5
		for (j = 0; j < tablica[0].length; j++) {//j == 1 ... 10
			draw_seat2(i, j);
		}
	}
}

function drawTable(podaci = null) {
	ctx.fillStyle = 'black';


	ctx.fillRect(
		MARGIN,
		0,
		tablica[0].length * UNIT_SIZE,
		MARGIN);


	draw_seat();
}



function obradi() {//asinkrono se poziva kada server posalje podatke o brodovima

	vraceno.forEach(element => {
		if (element.answer == "correct") {
			tablica[element.col - 1][element.row - 1] += 2;  //s 1,2 na 3,4	
		}
		else if (element.answer == "wrong") {
			if (element.type == "ship") {
				tablica[element.col - 1][element.row - 1] += 3;  //s 1 na 4	
			}
			else {
				tablica[element.col - 1][element.row - 1] += 1;  //s 2 na 3	
			}
		}

	});

	drawStatic();

	vraceno = null;
}

function sendMyChoice() { //button ....poziva obradi kad dobije odgovor

	var oznaceni = [];
	for (i = 0; i < 10; i++)
		for (j = 0; j < 10; j++) {
			if (tablica[i][j] == 1)
				oznaceni.push({ col: i + 1, row: j + 1, type: "ship" });
			else if (tablica[i][j] == 2)
				oznaceni.push({ col: i + 1, row: j + 1, type: "sea" });

		}

	if (oznaceni.length == 0) return;
	console.log(oznaceni);



	$.ajax(
		{
			url: "https://rp2.studenti.math.hr/~zbujanov/dz4/check.php",
			data:
			{
				id: podaci.id,
				list: oznaceni
			},
			type: "POST",
			dataType: "json", // očekivani povratni tip podatka
			success: function (json) {
				console.log(json);
				vraceno = json;
				obradi();

			},
			error: function (xhr, status, errorThrown) { },
			complete: function (xhr, status) { }
		});


}

function getInitData() { //dobiva pocetnu tablicu s servera,i sprema ju u 
	$.get(
		"https://rp2.studenti.math.hr/~zbujanov/dz4/id.php",
		{},
		function (data, status) {
			if (status === "success") {
				// Ovdje ide kod u slučaju da je server uspješno
				// vratio odgovor. Odgovor se nalazi u varijabli data.
				//console.log(data);
				podaci = JSON.parse(JSON.stringify(data));
			}
		}
	);
}

var numOfSeatsSelected = 0;
var MAXSeats = 4;
var seatsSelected = [];
function markIt() {//oznacava jednu celiju

	if (tablica[block.j][block.i] > 2) return;

	if (numOfSeatsSelected >= MAXSeats && tablica[block.j][block.i] == 0) {
		alert("Možeš odabrati maksimalno " + MAXSeats + " mjesta.");
		return;
	}
	tablica[block.j][block.i] = (tablica[block.j][block.i] + 1) % 2;

	var list = document.getElementById('myList');
	var lis = document.querySelectorAll('#myList li');

	if (tablica[block.j][block.i] == 1) {
		numOfSeatsSelected++;
		seatsSelected.push({ i: (block.i + 1), j: (block.j + 1) });
		var entry = document.createElement('li');
		entry.appendChild(document.createTextNode("Mjesto " + (block.j + 1) + "," + (block.i + 1)));
		entry.className = "list-group-item";
		list.appendChild(entry);

	}
	else {
		numOfSeatsSelected--;
		var index = seatsSelected.indexOf({ i: (block.i + 1), j: (block.j + 1) });
		if (index !== -1) {
			seatsSelected.splice(index, 1);
		}
		for (var i = 0; li = lis[i]; i++) {
			if (li.innerHTML == "Mjesto " + (block.j + 1) + "," + (block.i + 1))
				li.parentNode.removeChild(li);
		}


	}
	var button = document.getElementById('odaberi');

	if (numOfSeatsSelected > 0) {

		console.log(numOfSeatsSelected);
		button.disabled = false;
	}
	else {
		console.log(numOfSeatsSelected);
		button.disabled = true;
	}

	//tablica[block.j][block.i]=4;// za zauzeta mjesta
}

function odaberiMjesta() { //on click event
	var button = document.getElementById('odaberi');
	button.disabled = true;
	showHide('spiner', false);

	$.ajax(
		{
			url: "index.php?rt=user/seatSelectionConfirm",
			data:
			{
				seats: seatsSelected
			},
			type: "POST",
			dataType: "json", // očekivani povratni tip podatka
			success: function (json) {
				if (json.uspjeh) {
					setTimeout(function () {

						window.location.href = "index.php?rt=user/reservationSuccess/" + json.rezervacija;

					}, 2000);
				}
				else {

				}


			},
			error: function (xhr, status, errorThrown) {

			},
			complete: function (xhr, status) {
				console.log(status);

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

		}

}

function drawStatic() { //crta tablicu i njene elemente
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	drawTable(podaci);
	drawMarked();

}

function drawHover() {


	if (block.i < 0 || block.j < 0) return;

	// i == STUPCI    j== REDOVI
	if (block.i > tablica[0].length - 1 || block.j > tablica.length - 1) return;

	if (tablica[block.j][block.i] >= 2) return;
	var marg = 8;

	ctx.fillStyle = "yellow";
	//ctx.fillRect(MARGIN+ block.i*UNIT_SIZE+marg, MARGIN+ block.j*UNIT_SIZE+marg, UNIT_SIZE-marg*2, UNIT_SIZE-marg*2);
	//ctx.fillRect(MARGIN+ x*UNIT_SIZE, MARGIN+ y*UNIT_SIZE, UNIT_SIZE, UNIT_SIZE);
	draw_seat2(block.j, block.i, mar = 10, color = "yellow")



	ctx.font = "20px Arial";
	ctx.fillStyle = "blue";
	ctx.globalAlpha = 0.2;
	ctx.fillRect(mouse.x + 30, mouse.y, 150, 50);
	ctx.fillStyle = "black";
	ctx.globalAlpha = 1.0;

	ctx.fillText("Select seat", mouse.x + 35, mouse.y + 20);
	ctx.fillText("(" + (block.i + 1) + "," + (block.j + 1) + ")", mouse.x + 45, mouse.y + 40);

}


function refreshActiveBlock(x, y) {
	block.j = parseInt((y - MARGIN) / UNIT_SIZE);

	var marg = MARGIN * (tablica.length - block.j) / tablica.length;

	block.i = parseInt((x - marg) / ((canvas.width - 2 * marg) / tablica[0].length));



}


function oznaciKupljena(prikaz_id) {
	$.ajax(
		{
			url: "index.php?rt=user/vratiZauzetaMjesta/" + prikaz_id,
			data:
			{
			},
			type: "POST",
			dataType: "json",
			success: function (json) {
				console.log(json);
				json.forEach(element => {
					tablica[element.x][element.y] = 2;
				});


			},
			error: function (xhr, status, errorThrown) {

			},
			complete: function (xhr, status) {
				console.log(status);

			}
		});


}

function main() {



	canvas = document.getElementById('myBoard');
	ctx = canvas.getContext('2d');

	var size_x = parseInt(canvas.getAttribute('br_redova'));
	var size_y = parseInt(canvas.getAttribute('velicina_reda'));

	console.log(size_x + "," + size_y);
	MARGIN = canvas.width * 0.25;

	tablica = new Array(size_x);
	for (var i = 0; i < tablica.length; i++) {
		tablica[i] = new Array(size_y).fill(0);
	}


	oznaciKupljena(1);


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
			if (tablica[block.j][block.i] <= 2) {
				markIt();
				drawStatic();
				drawHover();
			}
		}
	}, false);

}