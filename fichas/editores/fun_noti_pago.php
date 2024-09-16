<?php 
include ("../../inic/dbcon.php");
require_once '../../js/PHPMailer-master/PHPMailerAutoload.php';
@session_start();

unset($_SESSION['params']);
$respar = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$_SESSION['params'] = mysqli_fetch_array($respar);

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
	
$hoy = date("Y-m-d H:i:s");

$result = mysqli_query($link,"SELECT * FROM tr001_pedidos WHERE co_pedidos='".$id."'");
$cod = mysqli_fetch_array($result);

$sql2="SELECT * FROM tr003_pagos WHERE co_pedidos='".$id."' AND in_estatus='1'";
$res2=mysqli_query($link,$sql2);

while ($row2 = mysqli_fetch_array($res2)) {
	$suma_pago=$suma_pago+$row2['nu_monto'];	
}

$deuda=$cod['nu_total']-$suma_pago;

//echo $_POST['pago'];
	
	if ($_POST['pagotchec']==true){
		$monto= (float)$_POST['pagototal'];
	}else{
		$monto= (float)$_POST['pagoparcial'];
	}
	
	$sql3="INSERT INTO tr003_pagos (co_pedidos,co_cuentas,tp_pagos,tx_banco,tx_depositante,nu_monto,fe_fecha,nu_transaccion,in_estatus) VALUES (".$id.",'".$_POST['co_cuentas']."','".$_POST['tp_pagos']."','".$_POST['tx_banco']."','".$_POST['tx_depositante']."','".$monto."','".$hoy."','".$_POST['nu_transaccion']."',1)";
	mysqli_query($link,$sql3);
	
	$sql4="UPDATE tr001_pedidos SET nu_estatus='Por Procesar' WHERE co_pedidos='".$id."'";
	mysqli_query($link,$sql4);
		
///envio de correo
		
		$to = $_SESSION['nb_usuario'];
		$to2 =$_SESSION['params']['tx_correo_pedidos'];
		$subject = "Bienvenido a ".$_SESSION['params']['tx_titulo_tienda'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$message = '
		<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
		<table width="100%" border="0" style="margin:0 auto; width:600px;">
		  <tbody>
			<tr>
			  <td colspan="2" style="text-align:center;"><h3>Pedido en la tienda '.$_SESSION['params']['tx_titulo_tienda'].'</h3></td>
			</tr>
			<tr>
			  <td style="text-align:center" width="50%">Su pago para el pedido <strong>'.$cod['nu_pedido'].'</strong> ha sido enviado y almacenado en nuestro sistema
por un monto de:</td>
			  <td width="50%" style="font-size:2em">'.$monto.' Bsf.</td>
			</tr>
			<tr>
			  <td colspan="2" style="text-align:center"><strong>Nota:</strong></td>
			  </tr>
			<tr>
			  <td colspan="2" style="text-align:center"><p>Una version electronica de este pago se encuentra guardada en su cuenta de nuestra tienda en linea, puede acceder en ver el pedido para visualizarlo nuevamente.</p></td>
			  </tr>
			<tr>
			  <td colspan="3" style="text-align:center;"><img src="https://frenoskoi.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/> <img src="https://frenoskoi.com/img/Koi_logo-min.jpg" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></a></td>
			</tr>
		  </tbody>
		</table>
		</div>';

		mail($to, $subject, $message, $headers);
		mail($to2, $subject, $message, $headers);
		
		//FIN PARA ENVIAR EL CORREO
		/*echo "<script type='text/javascript'>parent.pago_exito();parent.$('#modal_det_iframe').modal('hide');</script>";*/
		
?>