<!doctype html>
<html>
<head>
	<style type="text/css">
		#map {
			height: 40vw;
			width: 100%;
		}
	</style>
</head>
<body>
	<div id="map"></div>
	<div id="log"></div>
	<script>
	var center = {lat: <?=$maps_center['lat'];?>, lng: <?=$maps_center['lng'];?>};

	var map, infowindow;
	var dropPoint = [];


	function addMarker(location) {
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
        marker.addListener('click', function() {
			infowindow.setContent(""+location);
			infowindow.open(map, marker);
		});
		google.maps.event.trigger(marker, 'click'); 
        dropPoint.push(marker);
	}
	function setMapOnAll(map) {
        for (var i = 0; i < dropPoint.length; i++) {
          dropPoint[i].setMap(map);
        }
	}

	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 11,
			center: center
		});
		infowindow = new google.maps.InfoWindow;
		var marker, i;

		map.addListener('click', function(event) {
			if (dropPoint.length >= 1) {
				setMapOnAll(null);
			}
			addMarker(event.latLng);
			console.log("@map:"+event.latLng.lat()+","+event.latLng.lng());
		});

	}
	function downloadUrl(url, callback) {
		var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

		request.onreadystatechange = function() {
			if (request.readyState == 4) {
				request.onreadystatechange = doNothing;
				callback(request, request.status);
			}
		};

		request.open('GET', url, true);
		request.send(null);
	}
	function doNothing() {}
	</script>
	<script async defer src="{google_maps_js}"></script>
</body>
</html>