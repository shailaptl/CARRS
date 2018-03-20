$(function () {
	$(".NavigationBar").load("header.html");
});

function statsToday() {
	//printing it
	var print = document.getElementById('timeValue');
	print.innerHTML = "today:" ;
	
	//change result value
	printValueCarsPassed(5);
}

function statsWeek() {
	//printing it
	var print = document.getElementById('timeValue');
	print.innerHTML = "this week:";
	
	//change result value
	printValueCarsPassed(10);
}

function statsMonth() {
	//printing it
	var print = document.getElementById('timeValue');
	print.innerHTML = "this month:";
	
	//change result value
	printValueCarsPassed(15);
}

function statsYear() {
	//printing it
	var print = document.getElementById('timeValue');
	print.innerHTML = "this year:";
	
	//change result value
	printValueCarsPassed(20);
}

function printValueCarsPassed(numCars) {
	//printing it
	var print = document.getElementById('numCarsResult');
	print.innerHTML = numCars + "<br/>";
}