<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg003_cuentas WHERE co_cuentas='".$id."'");
$cod = mysqli_fetch_array($result);	

	$sql="UPDATE tg003_cuentas SET tp_cuentas='".$_POST['tp_cuentas']."',tx_banco='".$_POST['tx_banco']."',nu_cuenta='".$_POST['nu_cuenta']."' WHERE co_cuentas='".$id."'";
	mysqli_query($link,$sql);
	
	//echo $sql;
	echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/banca.php','cont');</script>";	
?>