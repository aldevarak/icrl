<?php 
include ("../inic/dbcon.php");
@session_start();

unset($_SESSION['params']);
$respar = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$_SESSION['params'] = mysqli_fetch_array($respar);

$dias_vencimiento=$_SESSION['params']['tx_vencimiento'];
$hoy=date('Y-m-d');

$dt_Ayer= date('Y-m-d', strtotime('-'.$dias_vencimiento.' day')) ; // resta 1 día

//echo "hoy ".$hoy."<br>";
//echo "hace ".$dias_vencimiento." es ".$dt_Ayer."<br>";

$sql_des="SELECT * FROM tr001_pedidos WHERE fe_fecha<='".$dt_Ayer."' AND in_estatus='1' AND nu_estatus='Sin Notificar Pago'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
			
while ($pedido = mysqli_fetch_array($resultados_des)) {
	$sql="UPDATE tr001_pedidos SET in_estatus='0' WHERE co_pedidos='".$pedido['co_pedidos']."'";
	mysqli_query($link,$sql);
	echo $pedido['nu_pedido']."<br>";
}

?>