<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg016_modelo SET in_estatus='1' WHERE co_modelo='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>																																																																													