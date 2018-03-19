$(function () {
	$(".NavigationBar").load("header.html");
});

function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
	  zoom: 17,
	  center: {lat: 40.784373, lng: -73.97770500000001}
	});
	
	var trafficLayer = new google.maps.TrafficLayer();
	trafficLayer.setMap(map);
	
	//81st Street and Amsterdam
	var marker = new google.maps.Marker({
		map: map,
		position: {lat: 40.7844134, lng: -73.9773565}
	});
	
	var marker = new google.maps.Marker({
		map: map,
		position: {lat: 40.7845489, lng: -73.9773856}
	});
	
	//82nd Street and Amsterdam
	var marker = new google.maps.Marker({
		map: map,
		position: {lat: 40.7851537, lng: -73.9768766}
	});
	
	var marker = new google.maps.Marker({
		map: map,
		position: {lat: 40.7851403, lng: -73.9770398}
	});
}