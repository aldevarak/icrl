<?php
@session_start();
 
if (isset($_POST['num'])){ $num = $_POST['num'];}
if (isset($_GET['num'])){ $num = $_GET['num'];}

if (isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}
if (isset($_GET['nombre'])){ $nombre = $_GET['nombre'];}

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $nombre;

unlink("../img_productos/".$nombre."");
?>

																																																																																					