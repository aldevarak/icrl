<?php 
require("../inic/dbcon.php");

$nombre_arc="categoria3";
	
//echo "<script type='text/javascript'> alert('hola');/script>";
	
// obtenemos los datos del archivo
$tamano = $_FILES["tx_imgcat3"]['size'];
$tipo = $_FILES["tx_imgcat3"]['type'];
$archivo = $_FILES["tx_imgcat3"]['name'];
//$prefijo = substr(md5(uniqid(rand())),0,6);
		   
if ($archivo != "") {
	// guardamos el archivo a la carpeta files
	$destino =  "../img/".$nombre_arc.".jpg";
	$nombre=$nombre_arc.".jpg";
				
	move_uploaded_file($_FILES["tx_imgcat3"]["tmp_name"],$destino);
				
	$sql21="UPDATE tg004_configuracion SET tx_imgcat3='".$nombre."' WHERE co_configuracion='1'";
	mysqli_query($link,$sql21);
} else {
	echo "Error al subir archivo";
}
?>