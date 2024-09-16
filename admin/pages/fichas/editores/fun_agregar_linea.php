<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg008_linea (co_categoria,nb_linea,in_eliminar,in_estatus) VALUES (".$_POST['co_categoria'].",'".$_POST['nb_linea']."',1,1)";
	mysqli_query($link,$sql3);

	//echo $sql;
?>