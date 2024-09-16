<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

	$sql="UPDATE tg015_marca SET nb_marca='".$_POST['nb_marca']."' WHERE co_marca='".$id."'";
	mysqli_query($link,$sql);
?>