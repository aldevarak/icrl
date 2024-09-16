<?php 
require("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$nombre_arc="banner_superior".$id;
$num=$id+1;
	
//echo "<script type='text/javascript'> alert('hola');/script>";
	
// obtenemos los datos del archivo
$tamano = $_FILES["imgpublicidad".$num]['size'];
$tipo = $_FILES["imgpublicidad".$num]['type'];
$archivo = $_FILES["imgpublicidad".$num]['name'];
//$prefijo = substr(md5(uniqid(rand())),0,6);
		   
if ($archivo != "") {
	// guardamos el archivo a la carpeta files
	$destino =  "../img/".$nombre_arc.".jpg";
	$nombre=$nombre_arc.".jpg";
				
	move_uploaded_file($_FILES["imgpublicidad".$num]["tmp_name"],$destino);
				
	$sql21="UPDATE tg004_configuracion SET tx_imgpublicidad".$num."='".$nombre."' WHERE co_configuracion='1'";
	mysqli_query($link,$sql21);
} else {
	echo "Error al subir archivo";
}
?>