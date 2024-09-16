<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	//insertar producto
	$sql3="INSERT INTO tr004_busqueda (co_marca,co_modelo,co_ano,co_tp_pastilla,co_productos,tx_observacion,in_estatus) VALUES (".$_POST['co_marca'].",".$_POST['co_modelo'].",".$_POST['co_ano'].",".$_POST['co_tp_pastilla'].",".$_POST['co_productos'].",'".$_POST['tx_observacion']."',1)";
	mysqli_query($link,$sql3);
	
	//echo $sql3;
	echo "<script type='text/javascript' charset='utf-8'>console.log('".$sql3."')</script>";
?>