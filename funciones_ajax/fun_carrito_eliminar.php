<?php 
@session_start();

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

unset($_SESSION['item'][$id]);
unset($_SESSION['carrito'][$id]);
?>

																																																																																					