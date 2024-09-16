<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg011_division2 SET in_estatus='0' WHERE co_division2='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>

																																																																																					