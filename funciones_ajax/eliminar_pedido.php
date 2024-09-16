<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tr001_pedidos SET in_estatus='0' WHERE co_pedidos='".$id."'";
mysqli_query($link,$sql);
//echo $sql;

$sql="UPDATE tr002_reng_pedidos SET in_estatus='0' WHERE co_pedidos='".$id."'";
mysqli_query($link,$sql);
//echo $sql;

$sql3="SELECT * FROM tr002_reng_pedidos WHERE co_pedidos='".$id."'";
$res3=mysqli_query($link,$sql3);

while ($row = mysqli_fetch_array($res3)) {
	$result = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$row['co_productos']."'");
	$pro = mysqli_fetch_array($result);	
	
	$totalpro=$pro['nu_stock']+$row['nu_cantidad'];
	
	$sql4="UPDATE tg013_productos SET nu_stock='".$totalpro."' WHERE co_productos='".$row['co_productos']."'";
	mysqli_query($link,$sql4);
}
?>																																																																																				