<?php 
//include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM sublineas WHERE campo1='S'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
$id=0;
			
while ($sublinea = mysqli_fetch_array($resultados_des)) {
 
	$id = $id+1;

	//LINEAS
	$result = mysqli_query($link,"SELECT * FROM lineas WHERE co_lin='".$sublinea['co_lin']."'");
	$lin_vieja = mysqli_fetch_array($result);
	
	$result = mysqli_query($link,"SELECT * FROM tg008_linea WHERE nb_linea='".$lin_vieja['lin_des']."'");
	$lin_new = mysqli_fetch_array($result);
	
	
	$sql3="INSERT INTO tg009_sublineas (co_linea,nb_sublineas,in_estatus) VALUES (".$lin_new['co_linea'].",'".$sublinea['subl_des']."',1)";
	mysqli_query($link,$sql3);
	echo "INSERT INTO tg009_sublineas (co_linea,nb_sublineas,in_estatus) VALUES (".$lin_new['co_linea'].",'".$sublinea['subl_des']."',1)<br>";
}
?>