<?php 
require_once ("../inic/dbcon.php");
require_once ("../inic/session.php");
require_once("../js/PHPMailer-master/class.phpmailer.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$sql="SELECT ped.*,cli.*,usu.nb_usuario FROM ((tr001_pedidos AS ped INNER JOIN tg005_clientes AS cli ON ped.co_clientes=cli.co_clientes)INNER JOIN th001_usuario AS usu ON cli.co_usuario=usu.co_usuario) WHERE ped.co_pedidos='".$id."'";
$res=mysqli_query($link,$sql);

while ($row = mysqli_fetch_array($res)) {
	$sql2="SELECT * FROM tr003_pagos WHERE co_pedidos='".$row['co_pedidos']."' AND in_estatus='1'";
	$res2=mysqli_query($link,$sql2);
			
	while ($row2 = mysqli_fetch_array($res2)) {
		$suma_pago=$suma_pago+$row2['nu_monto'];	
	}

	$deuda=$row['nu_total']-$suma_pago;
	
	if($deuda>0){
		echo "<script type='text/javascript'>
				BootstrapDialog.show({
					size: BootstrapDialog.SIZE_SMALL,
					type: BootstrapDialog.TYPE_WARNING,
					title: 'Say-hello dialog',
					message: 'El Pedido no Puede ser Procesado porque aun tiene una Deuda Pendiente',
					buttons: [{
								label: 'Ok',
								cssClass: 'btn-primary',
								action: function(dialogItself){
									dialogItself.close();
								}
							}]
				});
			</script>";	
	}else{
		//PARA ENVIAR EL CORREO
		$to = $_SESSION['nb_usuario'];
		$to2 =$_SESSION['params']['tx_correo_pedidos'];
		$subject = "Pago Aprobado por: ".$_SESSION['params']['tx_titulo_tienda'];
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
			  <td style="text-align:center" width="50%">Su pago para el pedido <strong>'.$cod['nu_pedido'].'</strong> ha sido Aprobado y Confirmado en nuestro sistema
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
		
		
		//HASTA AQUI CORREO
		
		$sql="UPDATE tr001_pedidos SET nu_estatus='Procesado' WHERE co_pedidos='".$id."'";
mysqli_query($link,$sql);
		//echo $sql;
	}
}
?>																																																																															