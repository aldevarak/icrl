<?php
include ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$id."'");
$cod = mysqli_fetch_array($result);	
		
$estructura_cate.="
		<li><a href='javaScript:;' onclick=\"location.reload();\">Inicio</a></li><li id='ref_categoria'><a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$cod['co_categoria']."' onclick=\"menu_nav(".$cod['co_categoria'].");close_menu();\">".$cod['nb_categoria']."</a></li>";

echo $estructura_cate;
?>