<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg016_modelo SET co_marca='".$_POST['co_marca']."',nb_modelo='".$_POST['nb_modelo']."' WHERE co_modelo='".$id."'";
mysqli_query($link,$sql);
?>