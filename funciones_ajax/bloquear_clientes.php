<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg005_clientes SET in_activa='0' WHERE co_clientes='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>

																																																																																					