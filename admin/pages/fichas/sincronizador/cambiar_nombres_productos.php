<?php 
//include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM tg005_clientes";
$resultados_des = mysqli_query($link,$sql_des);
			
while ($clientes = mysqli_fetch_array($resultados_des)) {
 
	echo "//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS<br>";
	
	$nombre = str_replace('"', '', $clientes['nb_clientes']);
	echo "La cadena resultante es: " . $nombre."<br>";
		
	$sql="UPDATE tg005_clientes SET nb_clientes='".$nombre."' WHERE co_clientes='".$clientes['co_clientes']."'";
	mysqli_query($link,$sql);
	echo $sql."<br><br>";
}
?>