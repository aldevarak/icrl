<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg014_transporte SET in_estatus='1' WHERE co_transporte='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>

																																																																																					