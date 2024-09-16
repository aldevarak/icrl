<?php
include ("../inic/dbcon.php");

if (isset($_POST['cat'])){ $cat = $_POST['cat'];}
if (isset($_GET['cat'])){ $cat = $_GET['cat'];}

if (isset($_POST['lin'])){ $lin = $_POST['lin'];}
if (isset($_GET['lin'])){ $lin = $_GET['lin'];}

if (isset($_POST['slin'])){ $slin = $_POST['slin'];}
if (isset($_GET['slin'])){ $slin = $_GET['slin'];}

if (isset($_POST['div'])){ $div = $_POST['div'];}
if (isset($_GET['div'])){ $div = $_GET['div'];}

if (isset($_POST['div2'])){ $div2 = $_POST['div2'];}
if (isset($_GET['div2'])){ $div2 = $_GET['div2'];}

if (isset($_POST['div3'])){ $div3 = $_POST['div3'];}
if (isset($_GET['div3'])){ $div3 = $_GET['div3'];}

$result = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$cat."'");
$cod = mysqli_fetch_array($result);	

$result2 = mysqli_query($link,"SELECT * FROM tg008_linea WHERE co_linea='".$lin."'");
$cod2 = mysqli_fetch_array($result2);

$result3 = mysqli_query($link,"SELECT * FROM tg009_sublineas WHERE co_sublineas='".$slin."'");
$cod3 = mysqli_fetch_array($result3);

$result4 = mysqli_query($link,"SELECT * FROM tg010_division WHERE co_division='".$div."'");
$cod4 = mysqli_fetch_array($result4);

$result5 = mysqli_query($link,"SELECT * FROM tg011_division2 WHERE co_division2='".$div2."'");
$cod5 = mysqli_fetch_array($result5);

$result6 = mysqli_query($link,"SELECT * FROM tg012_division3 WHERE co_division3='".$div3."'");
$cod6 = mysqli_fetch_array($result6);		
		
$estructura_div.="
		<li><a href='javaScript:;' onclick=\"location.reload();\">Inicio</a></li><li id='ref_categoria'><a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$cod['co_categoria']."' onclick=\"menu_nav(".$cod['co_categoria'].");close_menu();\">".$cod['nb_categoria']."</a></li>
		<li id='ref_linea'><a class='btn-cambio' href='../fichas/lineas.php?id=".$cod2['co_linea']."' onclick=\"menu_nav2(".$cod['co_categoria'].",".$cod2['co_linea'].");close_menu();\">".$cod2['nb_linea']."</a></li>
		<li id='ref_sublinea'><a class='btn-cambio' href='../fichas/sublineas.php?id=".$cod3['co_sublineas']."' onclick=\"menu_nav3(".$cod['co_categoria'].",".$cod2['co_linea'].",".$cod3['co_sublineas'].");close_menu();\">".$cod3['nb_sublineas']."</a></li>
		<li id='ref_division'><a class='btn-cambio' href='../fichas/division.php?id=".$cod4['co_division']."' onclick=\"menu_nav4(".$cod['co_categoria'].",".$cod2['co_linea'].",".$cod3['co_sublineas'].",".$cod4['co_division'].");close_menu();\">".$cod4['nb_division']."</a></li>
		<li id='ref_division2'><a class='btn-cambio' href='../fichas/division2.php?id=".$cod5['co_division2']."' onclick=\"menu_nav5(".$cod['co_categoria'].",".$cod2['co_linea'].",".$cod3['co_sublineas'].",".$cod4['co_division'].",".$cod5['co_division2'].");close_menu();\">".$cod5['nb_division2']."</a></li>
		<li id='ref_division3'><a class='btn-cambio' href='../fichas/division3.php?id=".$cod6['co_division3']."' onclick=\"menu_nav6(".$cod['co_categoria'].",".$cod2['co_linea'].",".$cod3['co_sublineas'].",".$cod4['co_division'].",".$cod5['co_division2'].",".$cod6['co_division3'].");close_menu();\">".$cod6['nb_division3']."</a></li>";

echo $estructura_div;
?>