<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");
	$sql3="INSERT INTO tg014_transporte (nb_transporte,tx_descripcion,nu_telefono,in_estatus) VALUES ('".$_POST['nb_transporte']."','".$_POST['tx_descripcion']."','".$_POST['nu_telefono']."',1)";
	mysqli_query($link,$sql3);
?>