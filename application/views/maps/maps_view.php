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
	      function initMap() {
	        var <?=$maps['maps_code'];?> = {lat: <?=$maps['maps_lat'];?> , lng: <?=$maps['maps_lng'];?> };
	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 16,
	          center: <?=$maps['maps_code'];?>
	        });
	        {point_script}
	      }
	    </script>
        <script async defer src="{google_maps_js}"></script>
    </body>
</html>