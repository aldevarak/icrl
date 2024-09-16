<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="UPDATE tg018_tp_pastilla SET co_ano='".$_POST['co_ano']."',nb_tp_pastilla='".$_POST['nb_tp_pastilla']."' WHERE co_tp_pastilla='".$id."'";
mysqli_query($link,$sql);
?>