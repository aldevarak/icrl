<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg015_marca (nb_marca,in_estatus) VALUES ('".$_POST['nb_marca']."',1)";
	mysqli_query($link,$sql3);
?>