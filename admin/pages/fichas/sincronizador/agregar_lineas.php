<?php 
//include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM lineas WHERE campo1='S'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
$id=0;
			
while ($cliente = mysqli_fetch_array($resultados_des)) {
 
	$id = $id+1;

	$sql3="INSERT INTO tg008_linea (co_categoria,nb_linea,in_estatus) VALUES (1,'".$cliente['lin_des']."',1)";
	mysqli_query($link,$sql3);
}
?>