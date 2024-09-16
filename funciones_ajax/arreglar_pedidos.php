<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}


$sql_des="SELECT * FROM tr001_pedidos WHERE in_estatus='1'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
			
while ($producto = mysqli_fetch_array($resultados_des)) {
	
	$cadena = str_replace( "MEGAH","FRKOI", $producto['nu_pedido']);
	
	echo "antes: ".$producto['nu_pedido']." y despues del cambio: ".$cadena."<br>";
	
	
	$sql="UPDATE tr001_pedidos SET nu_pedido='".$cadena."' WHERE co_pedidos='".$producto['co_pedidos']."'";
	mysqli_query($link,$sql);
	//echo $sql;
}
?>

																																																																																					