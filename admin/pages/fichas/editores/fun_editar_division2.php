<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg011_division2 SET co_division='".$_POST['co_division']."',nb_division2='".$_POST['nb_division2']."' WHERE co_division2='".$id."'";
mysqli_query($link,$sql);
?>