<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg009_sublineas SET co_linea='".$_POST['co_linea']."',nb_sublineas='".$_POST['nb_sublineas']."' WHERE co_sublineas='".$id."'";
mysqli_query($link,$sql);
?>