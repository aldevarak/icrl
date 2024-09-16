<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg008_linea SET co_categoria='".$_POST['co_categoria']."',nb_linea='".$_POST['nb_linea']."' WHERE co_linea='".$id."'";
mysqli_query($link,$sql);
?>