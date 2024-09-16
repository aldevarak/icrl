<?php 
@session_start();
require_once ("../../inic/dbcon.php");

if (isset($_POST['co_marca'])){ $co_marca = $_POST['co_marca'];}
if (isset($_GET['co_marca'])){ $co_marca = $_GET['co_marca'];}

if (isset($_POST['co_modelo'])){ $co_modelo = $_POST['co_modelo'];}
if (isset($_GET['co_modelo'])){ $co_modelo = $_GET['co_modelo'];}

if (isset($_POST['co_ano'])){ $co_ano = $_POST['co_ano'];}
if (isset($_GET['co_ano'])){ $co_ano = $_GET['co_ano'];}

if (isset($_POST['co_tp_pastilla'])){ $co_tp_pastilla = $_POST['co_tp_pastilla'];}
if (isset($_GET['co_tp_pastilla'])){ $co_tp_pastilla = $_GET['co_tp_pastilla'];}
	
$options="";

$result = mysqli_query($link,"SELECT * FROM tr004_busqueda WHERE co_marca='".$co_marca."' AND co_modelo='".$co_modelo."' AND co_ano='".$co_ano."' AND co_tp_pastilla='".$co_tp_pastilla."' AND in_estatus='1'");
$cod = mysqli_fetch_array($result);	

$result2 = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$cod['co_productos']."'");
$cod2 = mysqli_fetch_array($result2);	

$options.="<a href='javaScript:;' onclick=\"parent.cambio('../fichas/detalles-pro.php?id=".$cod2['co_productos']."','cont');\" id='referido' name='referido'>".$cod2['nb_productos']."</a>";

//$options.="<a class='thumbnail pull-left hidden-xs' >".$co_marca."</a>";

echo $options;   
?>