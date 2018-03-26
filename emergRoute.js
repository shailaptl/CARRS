$(function () {
	$(".NavigationBar").load("header.html");
});

function initMap() {
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer();	//for map

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom:13,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});
	
	//directionsDisplay.setPanel(document.getElementById('panel'));
	var city = 'Dublin';
	var request = {
		origin: city,
		destination: '53.4198282,-6.2183937',
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
		
	directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
    }
	});
	
	directionsDisplay.setMap(map);
}

function getAddress() {
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer();	//for map
	ori = document.getElementById('origin').value;
	dest = document.getElementById('dest').value;

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom:13,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});
	
	//directionsDisplay.setPanel(document.getElementById('panel'));
	var request = {
		origin: ori,
		destination: dest,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
		
	directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
    }
	});
	
	directionsDisplay.setMap(map);
}