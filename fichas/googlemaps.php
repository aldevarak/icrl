<?php 
include ("../inic/dbcon.php");
@session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>google Maps</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<style type="text/css">
#map-canvas {
	  width:100%;
	  background:black;
    height:470px;
    display:block;
}
</style>
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
     <script type="text/javascript">
       /*function init_map() {
		var var_location = new google.maps.LatLng();
 
        var var_mapoptions = {
          center: var_location,
          zoom: 20
        };
 
		var var_marker = new google.maps.Marker({
			position: var_location,
            map: var_map,
			title:"Venice"});
 
        var var_map = new google.maps.Map(document.getElementById("map-canvas"),
            var_mapoptions);
 
		var_marker.setMap(var_map);	
 
      }
 
      google.maps.event.addDomListener(window, 'load', init_map);*/
		
	  $("#ventana").ready(function() {
		$('#precarga').hide();
	  });
     </script>
</head>

<body>
<div class="modal-body">
	<div id="map-canvas" class="col-sm-12">
		

    <iframe src="<?php echo $_SESSION['params']['tx_coordenadas'];?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


		
	</div>
</div>
</body>
</html>