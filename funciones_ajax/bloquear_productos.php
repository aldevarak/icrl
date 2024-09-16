<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg013_productos SET in_bloqueado='1' WHERE co_productos='".$id."'";
mysqli_query($link,$sql);
//echo $sql;
?>

																																																																																					