<?php
@session_start();
 
if (isset($_POST['num'])){ $num = $_POST['num'];}
if (isset($_GET['num'])){ $num = $_GET['num'];}

if (isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}
if (isset($_GET['nombre'])){ $nombre = $_GET['nombre'];}

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $nombre;

$cantidad_img=$_SESSION['params']['nu_imagenes_pro'];

unlink("../img_productos/".$nombre."");

for ($i = $num; $i <= $cantidad_img; $i++){
	$j=$i+1;
	$archivo_posterior="../img_productos/p".$id."-".$j.".jpg";
	$archivo_nuevo="../img_productos/p".$id."-".$i.".jpg";
	
	if (file_exists($archivo_posterior)) {
		copy($archivo_posterior,$archivo_nuevo);
		unlink($archivo_posterior);
	}
}
?>

																																																																																					