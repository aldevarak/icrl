<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg008_linea SET in_estatus='0' WHERE co_linea='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>

																																																																																					