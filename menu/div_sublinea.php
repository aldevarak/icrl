<?php
include ("../inic/dbcon.php");

if (isset($_POST['cat'])){ $cat = $_POST['cat'];}
if (isset($_GET['cat'])){ $cat = $_GET['cat'];}

if (isset($_POST['lin'])){ $lin = $_POST['lin'];}
if (isset($_GET['lin'])){ $lin = $_GET['lin'];}

if (isset($_POST['slin'])){ $slin = $_POST['slin'];}
if (isset($_GET['slin'])){ $slin = $_GET['slin'];}

$result = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$cat."'");
$cod = mysqli_fetch_array($result);	

$result2 = mysqli_query($link,"SELECT * FROM tg008_linea WHERE co_linea='".$lin."'");
$cod2 = mysqli_fetch_array($result2);

$result3 = mysqli_query($link,"SELECT * FROM tg009_sublineas WHERE co_sublineas='".$slin."'");
$cod3 = mysqli_fetch_array($result3);	
		
$estructura_slin.="
		<li><a href='javaScript:;' onclick=\"location.reload();\">Inicio</a></li><li id='ref_categoria'><a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$cod['co_categoria']."' onclick=\"menu_nav(".$cod['co_categoria'].");close_menu();\">".$cod['nb_categoria']."</a></li><li id='ref_linea'><a class='btn-cambio' href='../fichas/lineas.php?id=".$cod2['co_linea']."' onclick=\"menu_nav2(".$cod['co_categoria'].",".$cod2['co_linea'].");close_menu();\">".$cod2['nb_linea']."</a></li><li id='ref_sublinea'><a class='btn-cambio' href='../fichas/sublineas.php?id=".$cod3['co_sublineas']."' onclick=\"menu_nav3(".$cod['co_categoria'].",".$cod2['co_linea'].",".$cod3['co_sublineas'].");close_menu();\">".$cod3['nb_sublineas']."</a></li>";

echo $estructura_slin;
?>