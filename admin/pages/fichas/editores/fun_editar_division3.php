<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg012_division3 SET co_division2='".$_POST['co_division2']."',nb_division3='".$_POST['nb_division3']."' WHERE co_division3='".$id."'";
mysqli_query($link,$sql);
?>