<?php 
require_once ("../inic/dbcon.php");
@session_start();
//require_once '../js/PHPMailer-master/PHPMailerAutoload.php';

if (isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}
if (isset($_GET['nombre'])){ $nombre = $_GET['nombre'];}

if (isset($_POST['telefono'])){ $telefono = $_POST['telefono'];}
if (isset($_GET['telefono'])){ $telefono = $_GET['telefono'];}

if (isset($_POST['email'])){ $email = $_POST['email'];}
if (isset($_GET['email'])){ $email = $_GET['email'];}

if (isset($_POST['mensaje'])){ $mensaje = $_POST['mensaje'];}
if (isset($_GET['mensaje'])){ $mensaje = $_GET['mensaje'];}

//echo $email;
//PARA ENVIAR EL CORREO
	//$para= "atencion@disenosos.com";
	$quien= $nombre;
	$telefono= $telefono;
	$mensaje= $mensaje;
	$email= $email;
	
	/*$mail = new PHPMailer;
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
	$mail->addReplyTo("bydigital@disenosos.com");
	$mail->setFrom("bydigital@disenosos.com");
	$mail->addAddress($para);
	$mail->addBCC($email);
	$mail->Subject  = "Gracias por Contactar a ".$_SESSION['params']['tx_titulo_tienda'];
	$mail->isHTML(true);
	$mail->Body    = '
	<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
	<table border="0" style="margin:0 auto; width:500px;">
	  <tbody>
		<tr style="background-color: #003368; color: #fff">
			<td style="text-align:center"><img src="http://www.disenosos.com/images/logo-by-digital-u1014.png" style="width:100px; height:auto;" alt="ByDigitalV3"/></td>
			<td style="text-align:center;"><h3>Contacto desde tienda online</h3></td>
		</tr>
		<tr>
		  <td colspan="2">'.$nombre.'</td>
		</tr>
		<tr>
		  <td colspan="2">'.$email.'</td>
		</tr>
		<tr>
		  <td colspan="2">'.$telefono.'</td>
		</tr>
		<tr>
		  <td colspan="2">Mensaje:</td>
		</tr>
		<tr>
		  <td colspan="2">'.$mensaje.'</td>
		</tr>
		<tr>
			<td colspan="2">Su requerimiento sera atendido lo mas pronto posible.</td>
		</tr>
		<tr>
		  <td colspan="2" style="text-align:center; line-height: 90px;"><img src="http://www.disenosos.com/images/logo-by-digital-u1014.png" alt="Diseño SOS" style="width:80px; height:auto;"/> Tienda Desarrollada por <img src="http://www.disenosos.com/images/logo-sos-200.png" alt="Diseño SOS" style="width:80px; height:auto;"/></td>
		</tr>
	  </tbody>
	</table>
	</div>';
	$mail->AltBody = '';
	$mail->WordWrap = 78;
	if(!$mail->send()) {
			echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_DANGER,
					message: 'Su mensaje no pudo ser enviado',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							}
					}]
				});
				</script>";
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_SUCCESS,
					message: 'Su mensaje fue enviado con exito',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							}
					}]
				});
				</script>";
		}
	//FIN PARA ENVIAR EL CORREO*/


		$to = $_SESSION['params']['tx_correo_pedidos'];
		//$to2 =$_SESSION['params']['tx_correo_pedidos'];
		$subject = "Gracias por Contactar a ".$_SESSION['params']['tx_titulo_tienda'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$message = '
		<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
		<table border="0" style="margin:0 auto; width:500px;">
		  <tbody>
			<tr style="background-color: #003368; color: #fff">
				<td style="text-align:center"><img src="http://www.disenosos.com/images/logo-by-digital-u1014.png" style="width:100px; height:auto;" alt="ByDigitalV3"/></td>
				<td style="text-align:center;"><h3>Contacto desde tienda online</h3></td>
			</tr>
			<tr>
			  <td colspan="2">'.$nombre.'</td>
			</tr>
			<tr>
			  <td colspan="2">'.$email.'</td>
			</tr>
			<tr>
			  <td colspan="2">'.$telefono.'</td>
			</tr>
			<tr>
			  <td colspan="2">Mensaje:</td>
			</tr>
			<tr>
			  <td colspan="2">'.$mensaje.'</td>
			</tr>
			<tr>
				<td colspan="2">Su requerimiento sera atendido lo mas pronto posible.</td>
			</tr>
			<tr>
			  <td colspan="2" style="text-align:center; line-height: 90px;"><img src="http://corpmegawatts.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/><img src="http://corpmegawatts.com/img/LogoFinal.jpg" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></td>
			</tr>
		  </tbody>
		</table>
		</div>';

		mail($to, $subject, $message, $headers);
		//mail($to2, $subject, $message, $headers);

		echo "<script type='text/javascript'>
					BootstrapDialog.show({
					title: 'Procesado',
					type: BootstrapDialog.TYPE_SUCCESS,
					message: 'Su mensaje fue enviado con exito',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							}
					}]
				});
				</script>";
?>																																																	