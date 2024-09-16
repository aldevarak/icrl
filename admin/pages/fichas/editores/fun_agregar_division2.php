<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");
	$sql3="INSERT INTO tg011_division2 (co_division,nb_division2,in_eliminar,in_estatus) VALUES (".$_POST['co_division'].",'".$_POST['nb_division2']."',1,1)";
	mysqli_query($link,$sql3);
?>