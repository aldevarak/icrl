<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

//if (isset($_POST['btn_enviar'])){
	$sql3="INSERT INTO tg003_cuentas (tp_cuentas,tx_banco,nu_cuenta,in_activa,in_estatus) VALUES ('".$_POST['tp_cuentas']."','".$_POST['tx_banco']."','".$_POST['nu_cuenta']."',0,1)";
	mysqli_query($link,$sql3);
	
	//echo $sql;
	//echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/banca.php','cont');</script>";	
	//echo $sql3;
	echo "<script type='text/javascript' charset='utf-8'>console.log('".$sql3."')</script>";
//}
?>