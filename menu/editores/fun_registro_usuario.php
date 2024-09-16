<?php 
include ("../../inic/dbcon.php");
unset($_SESSION['params']);
$respar = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$_SESSION['params'] = mysqli_fetch_array($respar);
	
$hoy = date("Y-m-d H:i:s");

	$sql6=mysqli_query($link,"SELECT COUNT(*) AS num FROM th001_usuario WHERE nb_usuario='".$_POST['tx_email2']."'");
	$num_registros = mysqli_fetch_array($sql6);
 
	if($num_registros['num']==0){
		$clave = md5($_POST['tx_clave2']);
	
		$sql="INSERT INTO th001_usuario (co_nivel_usuario,nb_usuario,tx_clave,in_mconf,in_mcliente,in_mpedido,in_mvendedor,in_mclasifica,in_mbanca,in_transporte,in_estatus) VALUES (2,'".$_POST['tx_email2']."','".$clave."',0,0,0,0,0,0,0,1)";
		mysqli_query($link,$sql);
	
		$sql2="SELECT MAX(co_usuario) AS id FROM th001_usuario";
		$result = mysqli_query($link,"SELECT MAX(co_usuario) AS id FROM th001_usuario");
		$cod = mysqli_fetch_array($result);
		
		$sql3="INSERT INTO tg005_clientes (co_tpcliente,co_usuario,nb_clientes,nu_rif_cedula,nu_telefono,fe_registro,fe_ultima_session,tx_direccion_fiscal,tx_direccion_entrega,in_activa,in_estatus) VALUES (2,".$cod['id'].",'".$_POST['nb_usuario']."','".$_POST['nu_rif_cedula']."','".$_POST['nu_telefono']."','".$hoy."',NULL,'".$_POST['tx_direccion_fiscal']."','".$_POST['tx_direccion_entrega']."',1,1)";
		mysqli_query($link,$sql3);
		
		/*require_once '../../js/PHPMailer-master/PHPMailerAutoload.php';
		//PARA ENVIAR EL CORREO
		$para= $_POST['tx_email2'];
		 
		$results_messages = array();
 
		$mail = new PHPMailer;
		$mail->setLanguage('es', '../js/PHPMailer-master/language/phpmailer.lang-es.php');
		$mail->CharSet = 'utf-8';
		//ini_set('default_charset', 'UTF-8');
		 
		//class phpmailerAppException extends phpmailerException {}
		$mail->SMTPDebug  = 0;
		$mail->isSMTP();
		$mail->Host       = "mail.corpmegawatts.com";
		$mail->SMTPAuth   = true;
		$mail->Username = "informacion@corpmegawatts.com";
		$mail->Password = "$2aQ^7ElKPh#";
		$mail->SMTPSecure = "tls";
		$mail->Port       = "465";
		$mail->addReplyTo("".$_SESSION['params']['tx_correo_contacto']."", "".$_SESSION['params']['tx_titulo_tienda']."");
		$mail->setFrom("".$_SESSION['params']['tx_correo_contacto']."", "".$_SESSION['params']['tx_titulo_tienda']."");
		$mail->addAddress($para, "".$_POST['nb_usuario']."");
		//$mail->addBCC("");
		$mail->Subject  = "Bienvenido a ".$_SESSION['params']['tx_titulo_tienda'];
		$mail->Body    = '
		<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
		<table width="100%" border="0" style="margin:0 auto; width:500px;">
		  <tbody>
			<tr>
			  <td colspan="3" style="text-align:center;"><h3>Registro en la tienda web</h3></td>
			  </tr>
			<tr>
			  <td rowspan="2" style="text-align:center"><img src="'.$_SESSION['params']['tx_logo'].'" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></td>
			  <td>Usuario:</td>
			  <td>'.$_POST['tx_email2'].'</td>
			</tr>
			<tr>
			  <td>Contraseña:</td>
			  <td>'.$_POST['tx_clave2'].'</td>
			</tr>
			<tr>
			  <td colspan="3" style="text-align:center; padding-top:20px;"><img src="http://disenosos.com/desarrollo/bydigitalv2/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/> </a></td>
			</tr>
		  </tbody>
		</table>
		</div>';
		$mail->AltBody = 'Registro en la tienda '.$_SESSION['params']['tx_titulo_tienda'].' Usuario:'.$_POST['tx_email2'].', Contraseña:'.$_POST['tx_clave2'].'';
		//$mail->WordWrap = 78;
//		if(!$mail->send()) {
//			echo "<script type='text/javascript'>console.log('no envio el correo');</script>";
//			echo 'Mailer Error: ' . $mail->ErrorInfo;
//		} else {
//			echo "<script type='text/javascript'>console.log('correo enviado');</script>";
//		}
		
		$exito = $mail->Send(); // Envía el correo.
		if($exito){ 
			echo "<script type='text/javascript'>console.log('correo enviado');</script>";
		}else{ 
			echo "<script type='text/javascript'>console.log('no envio el correo');</script>";
		} */
		
		//$mail->IsHTML(true);
		//$mail->Send();
		
		$to = $_POST['tx_email2'];
		$subject = "Bienvenido a ".$_SESSION['params']['tx_titulo_tienda'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$message = '
		<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
		<table width="100%" border="0" style="margin:0 auto; width:500px;">
		  <tbody>
			<tr>
			  <td colspan="3" style="text-align:center;"><h3>Registro en la tienda web</h3></td>
			  </tr>
			<tr>
			  <td rowspan="2" style="text-align:center"><img src="https://frenoskoi.com/img/Koi_logo-min.jpg" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></td>
			  <td>Usuario:</td>
			  <td>'.$_POST['tx_email2'].'</td>
			</tr>
			<tr>
			  <td>Contraseña:</td>
			  <td>'.$_POST['tx_clave2'].'</td>
			</tr>
			<tr>
			  <td colspan="3" style="text-align:center; padding-top:20px;"><img src="https://frenoskoi.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/> </a></td>
			</tr>
		  </tbody>
		</table>
		</div>';

		mail($to, $subject, $message, $headers);
		
		//FIN PARA ENVIAR EL CORREO
		echo "<script type='text/javascript'>registro_exito();parent.$('#modal_det_iframe').modal('hide');</script>";
		
	}else{
		echo "<script type='text/javascript'>registro_no_exito();parent.$('#modal_det_iframe').modal('hide');</script>";
	}
?>