$(function () {
	$(".NavigationBar").load("header.html");
});

function statsToday() {
	printValueCarsPassed(5);
}

function statsWeek() {
	printValueCarsPassed(10);
}

function statsMonth() {
	printValueCarsPassed(15);
}

function statsYear() {
	printValueCarsPassed(20);
}

function printValueCarsPassed(numCars) {
	//printing it
	var print = document.getElementById('printHere');
	print.innerHTML = numCars + "<br/>";
}