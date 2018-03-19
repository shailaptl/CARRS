$(function () {
	$(".NavigationBar").load("header.html");
});

function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 13,
	  center: {lat: 40.7830603, lng: -73.97124880000001}
	});
	
	var marker = new google.maps.Marker({
		map: map,
		position: {lat: 40.7830603, lng: -73.97124880000001}
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
	var address = document.getElementById('inputAddress');
	var print = document.getElementById('printHere');
	print.innerHTML = address.value + "<br/>";
	
	//setting the map
	
	address = document.getElementById('inputAddress').value;
	var geocoding = new google.maps.Geocoder();
	//var resultsMap = new google.maps.Map(document.getElementById('map'));
	var resultsMap = document.getElementById('map');
	
        geocoding.geocode({'address': address}, function(results, status)
		{
		console.log(status);
          if (status === 'OK') {
			  //console.log(results);
			  //console.log(results[0].geometry.location.lat());
			  //console.log(results[0].geometry.location.lng());
			  resultsMap.setCenter(results[0].geometry.location);		
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
	});
}