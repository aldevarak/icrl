<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg007_categoria (nb_categoria,in_eliminar,in_estatus) VALUES ('".$_POST['nb_categoria']."',1,1)";
	mysqli_query($link,$sql3);
?>