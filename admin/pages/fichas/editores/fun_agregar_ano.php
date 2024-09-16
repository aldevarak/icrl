<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg017_ano (co_modelo,nu_ano,in_estatus) VALUES (".$_POST['co_modelo'].",'".$_POST['nu_ano']."',1)";
	mysqli_query($link,$sql3);

	//echo $sql;
?>