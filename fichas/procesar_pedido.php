<?php 
include ("../inic/dbcon.php");
require_once '../js/PHPMailer-master/PHPMailerAutoload.php';
@session_start();
$hoy=date('Y-m-d H:i:s');

if (isset($_SESSION['co_nivel_usuario'])){
	 //Coorelativo de pedidos
	 /*********************************************************/
	 /*Ingresamos el codigo que deseamos implementar*/ 
	 $Codigo_Nivel=$_SESSION['params']['tx_formato_pedido'];
	 
	 $result = mysqli_query($link,"SELECT nu_pedido FROM tr001_pedidos ORDER BY co_pedidos DESC LIMIT 1");
	 $row = mysqli_fetch_array($result);
   
   		if($row['nu_pedido']==""){
			$longitud=strlen($Codigo_Nivel)-1;
			$Correlativo = substr($Codigo_Nivel,0,$longitud)."1"; 
		}else{
			$Correlativo=substr($row['nu_pedido'],-5);
			$num=$Correlativo+1;
			$longitud=strlen($Codigo_Nivel);
			$longitud2=strlen($num);
			$Correlativo= substr($Codigo_Nivel,0,-$longitud2).$num; 
		}
	 /*****************************************************/
	
	if ($_SESSION['co_nivel_usuario']=="1"){
		$mensaje="<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Administrador',
					type: BootstrapDialog.TYPE_WARNING,
					message: 'Como Administrador no puede procesar pedidos',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							parent.parent.parent.cambio('../fichas/inicio.php','cont');
							}
					}]
				});
				</script>";
	}
	
	if ($_SESSION['co_nivel_usuario']=="2"){
		$co_cliente=$_SESSION['cliente']['co_clientes'];
		$co_vendedor=$_SESSION['params']['co_vendedor'];
		$tx_iva=$_SESSION['params']['tx_iva'];
		
		$sql2="INSERT INTO tr001_pedidos (co_clientes,co_vendedor,co_condicion_pago,co_transporte,nu_pedido,nu_total,fe_fecha,nu_estatus,tx_iva,in_estatus) VALUES (".$co_cliente.",".$co_vendedor.",".$_SESSION['params']['tx_condicion_pago'].",1,'".$Correlativo."','".$_SESSION['total'][1]."','".$hoy."','Sin Notificar Pago','".$tx_iva."',1)";
		mysqli_query($link,$sql2);
		//echo $sql2."<br>";
		
		$result2 = mysqli_query($link,"SELECT MAX(co_pedidos) AS id FROM tr001_pedidos");
		$cod2 = mysqli_fetch_array($result2);
		
		foreach ($_SESSION['carrito'] as $i => $value) {
			$sql3="INSERT INTO tr002_reng_pedidos (co_pedidos,co_productos,nu_cantidad,nu_sub_total,in_estatus) VALUES (".$cod2['id'].",'".$_SESSION['carrito'][$i]."','".$_SESSION['item'][$i]."','".$_SESSION['subtotal'][$i]."',1)";
			mysqli_query($link,$sql3);
			//echo $sql3."<br>";
			
			//buscar stock de producto y restar
			$result = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$_SESSION['carrito'][$i]."'");
			$rowpro = mysqli_fetch_array($result);
			$descontar_inv=$rowpro['nu_stock']-$_SESSION['item'][$i];
			
			$sql23="UPDATE tg013_productos SET nu_stock='".$descontar_inv."' WHERE co_productos='".$_SESSION['carrito'][$i]."'";
			mysqli_query($link,$sql23);
			//
			
		}
		
		/*//PARA ENVIAR EL CORREO
		$para= $_SESSION['nb_usuario'];
		 
		$results_messages = array();
 
		$mail = new PHPMailer;
		$mail->setLanguage('es', '../js/PHPMailer-master/language/phpmailer.lang-es.php');
		$mail->CharSet = 'utf-8';
		//ini_set('default_charset', 'UTF-8');
		 
		//class phpmailerAppException extends phpmailerException {}
		$mail->SMTPDebug  = 0;
		$mail->isSMTP();
		$mail->Host       = "apure.tepuyserver.net";
		$mail->SMTPAuth   = true;
		$mail->Username = "bydigital@disenosos.com";
		$mail->Password = "bydigital.test()";
		$mail->SMTPSecure = "tls";
		$mail->Port       = "587";
		
		$mail->addReplyTo("".$_SESSION['params']['tx_correo_pedidos']."", "".$_SESSION['params']['tx_titulo_tienda']."");
		$mail->setFrom("".$_SESSION['params']['tx_correo_pedidos']."", "".$_SESSION['params']['tx_titulo_tienda']."");
		$mail->addAddress($para, "".$_POST['nb_usuario']."");
		//$mail->addBCC("");
		$mail->isHTML(true); 
		$mail->Subject  = "Su pedido en ".$_SESSION['params']['tx_titulo_tienda'];
		$mail->Body    = '
		<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
		<table width="100%" border="0" style="margin:0 auto; width:600px;">
		  <tbody>
			<tr>
			  <td colspan="2" style="text-align:center;"><h3>Pedido en la tienda '.$_SESSION['params']['tx_titulo_tienda'].'</h3></td>
			  </tr>
			<tr>
			  <td style="text-align:center">Su pedido ha sido procesado y almacenado en nuestro sistema bajo el número:</td>
			  <td>'.$Correlativo.'.</td>
			</tr>
			<tr>
			  <td colspan="2" style="text-align:center"><strong>Nota:</strong></td>
			  </tr>
			<tr>
			  <td colspan="2" style="text-align:center"><p>Una version electronica de este pedido se encuentra guardada en su<br>
				cuenta en nuestra tienda en linea, puede acceder en su cuenta para <br>
				visualizarlo nuevamente.</p>
				<p>Todo Pedido tiene vigencia máxima, tome en cuenta este tiempo para <br>
				contactar notificar el pago y concretar su compra.</p></td>
			  </tr>
			<tr>
			  <td colspan="3" style="text-align:center;"><img src="http://disenosos.com/desarrollo/bydigitalv2/img/logo_bydigital.png" alt="ByDigital" width="120px" height="auto"/> Tienda desarrollada por <a href="http://disenosos.com/"><img src="http://disenosos.com/desarrollo/bydigitalv2/img/Logo-SOS-150.png" width="100px" height="auto" alt="SOS Diseño"/></a></td>
			</tr>
		  </tbody>
		</table>
		</div>';
		$mail->AltBody = 'Su pedido ha sido procesado y almacenado en nuestro sistema bajo el número: '.$Correlativo.'';
		$mail->WordWrap = 78;
		
		if(!$mail->send()) {
			echo 'El correo no pudo ser enviado.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_SUCCESS,
					message: 'Su pedido fue agregado con exito y le fue enviado una notificación a su correo',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							parent.parent.parent.cambio('../fichas/pedidos.php','cont');
							}
					}]
				});
				</script>";
		}*/
		//FIN PARA ENVIAR EL CORREO
		
		
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
			  <td style="text-align:center">Su pedido ha sido procesado y almacenado en nuestro sistema bajo el número:</td>
			  <td>'.$Correlativo.'.</td>
			</tr>
			<tr>
			  <td colspan="2" style="text-align:center"><strong>Nota:</strong></td>
			  </tr>
			<tr>
			  <td colspan="2" style="text-align:center"><p>Una version electronica de este pedido se encuentra guardada en su<br>
				cuenta en nuestra tienda en linea, puede acceder en su cuenta para <br>
				visualizarlo nuevamente.</p>
				<p>Todo Pedido tiene vigencia máxima, tome en cuenta este tiempo para <br>
				contactar notificar el pago y concretar su compra.</p></td>
			  </tr>
			<tr>
			  <td colspan="3" style="text-align:center;"><img src="https://frenoskoi.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/> <img src="https://frenoskoi.com/img/Koi_logo-min.jpg" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></a></td>
			</tr>
		  </tbody>
		</table>
		</div>';

		mail($to, $subject, $message, $headers);
		mail($to2, $subject, $message, $headers);
		
		echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_SUCCESS,
					message: 'Su pedido fue agregado con exito y le fue enviado una notificación a su correo',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							parent.parent.parent.cambio('../fichas/pedidos.php','cont');
							}
					}]
				});
				</script>";
		
		
		
		
		unset($_SESSION['carrito'],$_SESSION['item'],$_SESSION['subtotal'],$_SESSION['total']);
	}
	
	if ($_SESSION['co_nivel_usuario']=="3"){
		//$mensaje="<div class='alert alert-info' role='alert'>El Vendedor aun esta en desarrollo</div>";
		echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_WARNING,
					message: 'El Vendedor aun esta en desarrollo',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							parent.parent.parent.cambio('../fichas/pedidos.php','cont');
							}
					}]
				});
				</script>";
	}

}else{
	//$mensaje="<div class='alert alert-warning' role='alert'> Debe estar registrado para poder generar un pedido</div>";
	echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_INFO,
					message: 'Debe estar registrado para poder generar un pedido',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							parent.parent.parent.cambio('../fichas/inicio.php','cont');
							}
					}]
				});
				</script>";	
}

echo $mensaje;
unset($_SESSION['carrito'],$_SESSION['item'],$_SESSION['subtotal'],$_SESSION['total']);
$texto_carrito="0 productos / 0,00 Bsf";
echo "<script type='text/javascript'>parent.$('#tx_carrito small').text('".$texto_carrito."');</script>";
?>																																							