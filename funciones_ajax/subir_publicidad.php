<?php 
require("../inic/dbcon.php");

$nombre_arc="publicidad_inferior";
	
//echo "<script type='text/javascript'> alert('hola');/script>";
	
// obtenemos los datos del archivo
$tamano = $_FILES["imgpublicidad"]['size'];
$tipo = $_FILES["imgpublicidad"]['type'];
$archivo = $_FILES["imgpublicidad"]['name'];
//$prefijo = substr(md5(uniqid(rand())),0,6);
		   
if ($archivo != "") {
	// guardamos el archivo a la carpeta files
	$destino =  "../img/".$nombre_arc.".jpg";
	$nombre=$nombre_arc.".jpg";
				
	move_uploaded_file($_FILES["imgpublicidad"]["tmp_name"],$destino);
				
	$sql21="UPDATE tg004_configuracion SET tx_imgpublicidad='".$nombre."' WHERE co_configuracion='1'";
	mysqli_query($link,$sql21);
} else {
	echo "Error al subir archivo";
}
?>