<?php 
@session_start();

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

if (isset($_POST['valor'])){ $valor = $_POST['valor'];}
if (isset($_GET['valor'])){ $valor = $_GET['valor'];}

$_SESSION['item'][$id]=$valor;
?>

																																																																																					