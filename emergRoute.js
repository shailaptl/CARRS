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

var destLat;
	var destLng;
function getAddress(){	
	//setting the origin
	origin = document.getElementById('origin').value;
	var geocoding = new google.maps.Geocoder();
	
	var originLat;
	var originLng;
        geocoding.geocode({'address': origin}, function(results, status)
		{
          if (status === 'OK') {
				originLat = results[0].geometry.location.lat();
				originLng = results[0].geometry.location.lng();
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
	});
	
	//setting the destination
	dest = document.getElementById('dest').value;
	var geocoding = new google.maps.Geocoder();
	
        geocoding.geocode({'address': dest}, function(results, status)
		{
          if (status === 'OK') {
				destLat = results[0].geometry.location.lat();
				destLng = results[0].geometry.location.lng();
				console.log(destLat);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
	});
	console.log(originLat);
	console.log(destLat);
	setMap(originLat, originLng, destLat, destLng);
}

function setMap(ilat, ilng, dlat, dlng) {	
	console.log(ilat);
	console.log(dlat);
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer();	//for map
	
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom:13,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	});
	
	var orig = String(ilat) + ',' + String(ilng);
	var dest = String(dlat) + ',' + String(dlng);
	
	var request = {
		origin: orig,
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