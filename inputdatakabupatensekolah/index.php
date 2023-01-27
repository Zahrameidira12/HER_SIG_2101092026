<?php
 require_once("db.php");
 $conn = new  connectToDB();
 $sekolah = $conn->getSekolahList();
 $kabupaten = $conn->getKabupatenList();
 
?>
<!DOCTYPE html>
<html>
<head>
 <title>Leaflet basic example</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"  />
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" ></script>

<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
</style>
</head>
<body>
 <div id="map" style="width: 1300px; height: 800px"></div>
 <script>

//const map = L.map('map').setView([-0.9462510832514028, 100.41665073650391], 13);
var sekolahh = L.layerGroup();
var kabupatenn = L.layerGroup();

const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

var mapboxUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

var streets = L.tileLayer(mapboxUrl,{
  id :'mapbox/streets-v11',
  tileSize : 512,
  zoomOffset : -1
});

var satellite = L.tileLayer(mapboxUrl,{
  id :'mapbox/satellite-v9',
  tileSize : 512,
  zoomOffset : -1
});

var map = L.map('map',{
  center: [-0.9462510832514028, 100.41665073650391],
  zoom : 14,
  layers : [osm,sekolahh]
}); 

  $( document ).ready(function() {
   addSekolah();    
   addKabupaten();   
  });

  var baseMaps ={
    'OpenStreetMap ': osm,
		'MapBoxStreet': streets,
    'Satellite' : satellite
  };

  const overlays = {
		'Sekolah': sekolahh,
    'Kabupaten' : kabupatenn
	};

  function addSekolah() {
   for(var i=0; i<sekolah.length; i++) {
    var marker = L.marker( [sekolah[i]['latitude'], sekolah[i]['longitude']]).addTo(sekolahh);
    marker.bindPopup( "<b>" + sekolah[i]['nama']+"</b><br>Details: " + sekolah[i]['details']);
   }
  }
  
  function stringToGeoPoints( geo ) {
   var linesPin = geo.split(",");

   var linesLat = new Array();
   var linesLng = new Array();

   for(i=0; i < linesPin.length; i++) {
    if(i % 2) {
     linesLat.push(linesPin[i]);
    }else{
     linesLng.push(linesPin[i]);
    }
   }

   var latLngLine = new Array();

   for(i=0; i<linesLng.length;i++) {
    latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
   }
   
   return latLngLine;
  }

  function addKabupaten() {
   for(var i=0; i < kabupaten.length; i++) {
    var polygon = L.polygon( stringToGeoPoints(kabupaten[i]['geolocation']), { color: 'blue'}).addTo(kabupatenn);
    polygon.bindPopup( "<b>" + kabupaten[i]['nama']);   
   }
  }
  
  var sekolah = JSON.parse( '<?php echo json_encode($sekolah) ?>' );
  var kabupaten = JSON.parse( '<?php echo json_encode($kabupaten) ?>' );
  var layerControl = L.control.layers(baseMaps,overlays).addTo(map);
 </script>
</body>
</html>
