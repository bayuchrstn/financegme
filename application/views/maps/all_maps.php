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
	<script>
	var center = {lat: <?=$maps_center['lat'];?>, lng: <?=$maps_center['lng'];?>};
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 11,
			center: center
		});
		var infowindow = new google.maps.InfoWindow;
		var marker, i;

		// maps_point
		downloadUrl('<?php echo base_url();?>maps/maps_data/point', function(data) {
			var xml = data.responseXML;
			var markers = xml.documentElement.getElementsByTagName('marker');
			Array.prototype.forEach.call(markers, function(markerElem) {
				var id = markerElem.getAttribute('id');
				var name = markerElem.getAttribute('name');
				var address = markerElem.getAttribute('address');
				var type = markerElem.getAttribute('type');
				var type_name = markerElem.getAttribute('type_name');
				var type_point = markerElem.getAttribute('type_point');
				var type_point_icon = markerElem.getAttribute('point_icon');

				type_point = type_point_icon.split("|");
				var point_form = type_point[0];
				var point_color = type_point[1];

				var point = new google.maps.LatLng(
					parseFloat(markerElem.getAttribute('lat')),
					parseFloat(markerElem.getAttribute('lng'))
				);

				var infowincontent = document.createElement('div');
				var strong = document.createElement('strong');
				strong.textContent = name + ' ' + type_name;
				infowincontent.appendChild(strong);
				infowincontent.appendChild(document.createElement('br'));

				var text = document.createElement('text');
				text.textContent = address
				infowincontent.appendChild(text);

				if (point_form=='circle') {
					var pointMarker = new google.maps.Marker({position: point,icon: {path: google.maps.SymbolPath.CIRCLE,fillColor: point_color,fillOpacity: 1,strokeColor: point_color,strokeOpacity: 1,strokeWeight: 4,scale: 2},draggable: true,map: map});
				} else {
					var width = 0.0002;
					var difference = width / 2;
					var lat = parseFloat(markerElem.getAttribute('lat'));
					var lng = parseFloat(markerElem.getAttribute('lng'));
					var utara = lat + difference;
					var selatan = lat - difference;
					var timur = lng + difference;
					var barat = lng - difference;
					var pointMarker = new google.maps.Rectangle({strokeColor: point_color,strokeOpacity: 1,strokeWeight: 2,fillColor: point_color,fillOpacity: 1,map: map,bounds: {north: utara,south: selatan,east: timur,west: barat}});
				}

				pointMarker.addListener('click', function() {
					infowindow.setContent(infowincontent);
					infowindow.setPosition(point);
					infowindow.open(map);
				});

			});
		});

		// maps_icon
		downloadUrl('<?php echo base_url();?>maps/maps_data/icon', function(data) {
			var xml = data.responseXML;
			var markers = xml.documentElement.getElementsByTagName('marker');
			Array.prototype.forEach.call(markers, function(markerElem) {
				var id = markerElem.getAttribute('id');
				var name = markerElem.getAttribute('name');
				var address = markerElem.getAttribute('address');
				var type = markerElem.getAttribute('type');
				var type_name = markerElem.getAttribute('type_name');
				var type_point = markerElem.getAttribute('type_point');
				var type_point_icon = markerElem.getAttribute('point_icon');

				var point = new google.maps.LatLng(
					parseFloat(markerElem.getAttribute('lat')),
					parseFloat(markerElem.getAttribute('lng'))
				);

				var infowincontent = document.createElement('div');
				var strong = document.createElement('strong');
				strong.textContent = name + ' ' + type_name;
				infowincontent.appendChild(strong);
				infowincontent.appendChild(document.createElement('br'));

				var text = document.createElement('text');
				text.textContent = address
				infowincontent.appendChild(text);

				var pointMarker = new google.maps.Marker({
					map: map,
					position: point,
					icon: {
						url: type_point_icon,
					},
					// icon: icons.icon
				});

				pointMarker.addListener('click', function() {
					infowindow.setContent(infowincontent);
					infowindow.open(map, pointMarker);
				});

			});
		});

		//maps_line
		downloadUrl('<?php echo base_url();?>maps/maps_data/line', function(data) {
			var xml = data.responseXML;
			var markers = xml.documentElement.getElementsByTagName('marker');
			Array.prototype.forEach.call(markers, function(markerElem) {
				var id = markerElem.getAttribute('id');
				var name = markerElem.getAttribute('name');
				var desc = markerElem.getAttribute('address');
				var type = markerElem.getAttribute('type');
				var type_name = markerElem.getAttribute('type_name');

				var point = new google.maps.LatLng(
					parseFloat(markerElem.getAttribute('lat')),
					parseFloat(markerElem.getAttribute('lng'))
				);
				var point2 = new google.maps.LatLng(
					parseFloat(markerElem.getAttribute('lat2')),
					parseFloat(markerElem.getAttribute('lng2'))
				);
				myroutes = [point, point2];

				var line_color = markerElem.getAttribute('point_icon');
				var traceroute = new google.maps.Polyline({
					path:myroutes,
					strokeColor:line_color,
					strokeOpacity:1,
					strokeWeight:3
				});
				var pathrute = traceroute.getPath();
				var service = new google.maps.DirectionsService(), traceroute, snap_path=[];
				traceroute.setMap(map);
				for(j=0;j<myroutes.length-1;j++){
					service.route({
						origin:myroutes[j],
						destination:myroutes[j+1],
						travelMode:google.maps.DirectionsTravelMode.WALKING
					},function(result, status) {
						if(status == google.maps.DirectionsStatus.OK) {
							snap_path = snap_path.concat(result.routes[0].overview_path);
							traceroute.setPath(snap_path);
						} else alert("Directions request failed: "+status);
					});
				}

				google.maps.LatLng.prototype.kmTo = function(a){ 
					var e = Math, ra = e.PI/180; 
					var b = this.lat() * ra, c = a.lat() * ra, d = b - c; 
					var g = this.lng() * ra - a.lng() * ra; 
					var f = 2 * e.asin(e.sqrt(e.pow(e.sin(d/2), 2) + e.cos(b) * e.cos 
					(c) * e.pow(e.sin(g/2), 2))); 
					return f * 6378.137; 
				}

				google.maps.Polyline.prototype.inKm = function(n){ 
					var a = this.getPath(n), len = a.getLength(), dist = 0; 
					for (var i=0; i < len-1; i++) { 
						dist += a.getAt(i).kmTo(a.getAt(i+1)); 
					}
					return dist; 
				}

				var thisLength = parseFloat(traceroute.inKm().toFixed(2));
				var ruteLength = '('+thisLength+' KM)';

				traceroute.addListener('click', function(event) {
					infowindow.setContent('<b>'+name+' '+type_name+'</b><br>'+desc+' '+ruteLength+'<br>'+parseFloat(event.latLng.lat()).toFixed(6)+', '+parseFloat(event.latLng.lng()).toFixed(6));
					infowindow.setPosition(event.latLng);
					infowindow.open(map);
				});
			});
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