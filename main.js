$(function () {
	$(".NavigationBar").load("header.html");
});


function initDirMap() {
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer();

	var map = new google.maps.Map(document.getElementById('dirMap'), {
		zoom:7,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById('panel'));

	var request = {
		origin: 'Dublin',
		destination: '53.4198282,-6.2183937',
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
}

function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 13,
	  center: {lat: 29.6516344, lng: -82.32482619999996}
	});
	
	var trafficLayer = new google.maps.TrafficLayer();
	trafficLayer.setMap(map);
}

function setMap(latitude, longitude) {	
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 13,
	  center: {lat: latitude, lng: longitude}
	});
	
	var trafficLayer = new google.maps.TrafficLayer();
	trafficLayer.setMap(map);
}

function getAddress(){
	//printing it
	var print = document.getElementById('printHere');
	var address = document.getElementById('inputAddress');
	print.innerHTML = address.textContent + "<br/>";
	
	//setting the map
	
	address = document.getElementById('inputAddress').value;
	var geocoding = new google.maps.Geocoder();
	
        geocoding.geocode({'address': address}, function(results, status)
		{
		console.log(status);
          if (status === 'OK') {
			  console.log(results[0].geometry.location.lat());
			  console.log(results[0].geometry.location.lng());
				setMap(results[0].geometry.location.lat(), results[0].geometry.location.lng());
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
	});
}