<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");
	$sql3="INSERT INTO tg012_division3 (co_division2,nb_division3,in_eliminar,in_estatus) VALUES (".$_POST['co_division2'].",'".$_POST['nb_division3']."',1,1)";
	mysqli_query($link,$sql3);
?>