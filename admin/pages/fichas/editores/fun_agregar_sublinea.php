<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

	$sql3="INSERT INTO tg009_sublineas (co_linea,nb_sublineas,in_eliminar,in_estatus) VALUES (".$_POST['co_linea'].",'".$_POST['nb_sublineas']."',1,1)";
	mysqli_query($link,$sql3);

//echo "<script>console.log(".$sql3.");</script>";

?>