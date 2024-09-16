<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

/*$result = mysqli_query($link,"SELECT * FROM tr004_busqueda WHERE co_busqueda='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){*/
$sql="UPDATE tr004_busqueda SET co_marca='".$_POST['co_marca']."',co_modelo='".$_POST['co_modelo']."',co_ano='".$_POST['co_ano']."',co_tp_pastilla='".$_POST['co_tp_pastilla']."',co_productos='".$_POST['co_productos']."',tx_observacion='".$_POST['tx_observacion']."' WHERE co_busqueda='".$id."'";
mysqli_query($link,$sql);
	
//echo $sql;
echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/buscar_avan.php','cont');</script>";	
//}

?>