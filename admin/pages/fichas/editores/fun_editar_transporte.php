<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg014_transporte SET nb_transporte='".$_POST['nb_transporte']."',tx_descripcion='".$_POST['tx_descripcion']."',nu_telefono='".$_POST['nu_telefono']."' WHERE co_transporte='".$id."'";
mysqli_query($link,$sql);
?>