<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg017_ano SET co_modelo='".$_POST['co_modelo']."',nu_ano='".$_POST['nu_ano']."' WHERE co_ano='".$id."'";
mysqli_query($link,$sql);
?>