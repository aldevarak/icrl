<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg015_marca SET in_estatus='0' WHERE co_marca='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>																																																																													