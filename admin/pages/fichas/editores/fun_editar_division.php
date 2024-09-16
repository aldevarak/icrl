<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg010_division SET co_sublineas='".$_POST['co_sublineas']."',nb_division='".$_POST['nb_division']."' WHERE co_division='".$id."'";
mysqli_query($link,$sql);
?>