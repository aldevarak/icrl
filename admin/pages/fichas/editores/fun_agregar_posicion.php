<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg018_tp_pastilla (co_ano,nb_tp_pastilla,in_estatus) VALUES (".$_POST['co_ano'].",'".$_POST['nb_tp_pastilla']."',1)";
	mysqli_query($link,$sql3);

	//echo $sql;
?>