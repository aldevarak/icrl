<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg016_modelo (co_marca,nb_modelo,in_estatus) VALUES (".$_POST['co_marca'].",'".$_POST['nb_modelo']."',1)";
	mysqli_query($link,$sql3);

	//echo $sql;
?>