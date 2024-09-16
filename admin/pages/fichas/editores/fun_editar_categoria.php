<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

	$sql="UPDATE tg007_categoria SET nb_categoria='".$_POST['nb_categoria']."' WHERE co_categoria='".$id."'";
	mysqli_query($link,$sql);
?>