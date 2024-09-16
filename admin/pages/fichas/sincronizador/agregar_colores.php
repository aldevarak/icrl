<?php 
//include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM colores WHERE campo1='S'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
$id=0;
			
while ($COLOR = mysqli_fetch_array($resultados_des)) {
 
	$id = $id+1;

	$sql3="INSERT INTO tg010_division (co_sublineas,nb_division,in_estatus) VALUES (1,'".$COLOR['des_col']."',1)";
	mysqli_query($link,$sql3);
	echo "INSERT INTO tg010_division (co_sublineas,nb_division,in_estatus) VALUES (1,'".$COLOR['des_col']."',1);<br>";
}
?>