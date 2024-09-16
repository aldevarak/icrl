<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg013_productos SET tx_descripcion_web='".$_POST['tx_descripcion_web']."' WHERE co_productos='".$id."'";
mysqli_query($link,$sql);
//echo $sql3;
?>