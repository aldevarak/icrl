<?php 
//include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM categorias WHERE campo1='S'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
$id=0;
			
while ($categoria = mysqli_fetch_array($resultados_des)) {
 
	$id = $id+1;

	$sql3="INSERT INTO tg007_categoria (nb_categoria,in_estatus) VALUES ('".$categoria['cat_des']."',1)";
	mysqli_query($link,$sql3);
}
?>