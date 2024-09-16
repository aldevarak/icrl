<?php 
@session_start();
include "../../../inic/config.php";
//require_once '../../../js/PHPMailer-master/PHPMailerAutoload.php';

$sql2="SELECT * FROM th001_usuario WHERE co_usuario='".$_SESSION['co_usuario']."'";
$result2 = mysqli_query($link,$sql2);
$row = mysqli_fetch_array($result2);

if (isset($_POST['btn_contactar'])){	
	$resultaaa = mysqli_query($link,"SELECT * FROM tg004_configuracion");
	$configurar = mysqli_fetch_array($resultaaa);

	/*//PARA ENVIAR EL CORREO
	$para=$configurar['tx_correo_contacto'];
	$tienda=$configurar['tx_nombre_empresa'];
	
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
	$mail->addReplyTo("by_digital@disenosos.com");
	$mail->setFrom("bydigital@disenosos.com");
	$mail->addAddress($para, "Tienda online");
	$mail->addBCC("bydigital@disenosos.com");
	$mail->Subject  = "Requerimiento desde ByDigital";
	$mail->isHTML(true);
	$mail->Body    = '
	<div style="text-align:center; width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
	<table border="0" style="margin:0 auto; width:500px;">
	  <tbody>
		<tr>
		  <td style="text-align:center"><img src="http://www.disenosos.com/images/logo-by-digital-u1014.png" width="100" height="auto" alt="ByDigitalV3"/></td>
		  <td style="text-align:center">Tienda de '.$tienda.'</td>
		</tr>
		<tr>
		  <td colspan="2">'.$_POST['tx_mensaje'].'</td>
		</tr>
		<tr>
			<td colspan="2">Su requerimiento sera atendido lo mas pronto posible.</td>
		</tr>
		<tr>
		  <td colspan="2" style="text-align:center; padding-top: 10px;"><img src="http://www.disenosos.com/images/logo-sos-200.png" alt="Diseño SOS" width="100" height="auto"/></td>
		</tr>
	  </tbody>
	</table>
	</div>';
	$mail->AltBody = '';
	$mail->WordWrap = 78;
	if(!$mail->send()) {
			echo "<div class='modal-body'><div class='alert alert-success alert-dismissible fade in' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
						<h4>Aviso</h4>
						<p>Su mensaje pudo ser enviado</p>
						<p><button type='button' class='btn btn-info' onClick=\"parent.$('#modal_det_iframe').modal('hide');\">Aceptar</button>
						</p>
					</div></div>";
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo "<div class='modal-body'><div class='alert alert-success alert-dismissible fade in' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
						<h4>Notificación</h4>
						<p>Su mensaje fue enviado correctamente</p>
						<p><button type='button' class='btn btn-info' onClick=\"parent.$('#modal_det_iframe').modal('hide');\">Aceptar</button>
						</p>
					</div></div>";
		}*/
	//FIN PARA ENVIAR EL CORREO
	
		$to = $configurar['tx_correo_contacto'];
		$tienda=$configurar['tx_nombre_empresa'];
		$subject = "Requerimiento desde ".$configurar['tx_titulo_tienda'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$message = '
		<div style="text-align:center; width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
	<table border="0" style="margin:0 auto; width:500px;">
	  <tbody>
		<tr>
		  <td style="text-align:center"><img src="http://corpmegawatts.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/></td>
		  <td style="text-align:center">Tienda de '.$tienda.'</td>
		</tr>
		<tr>
		  <td colspan="2">'.$_POST['tx_mensaje'].'</td>
		</tr>
		<tr>
			<td colspan="2">Su requerimiento sera atendido lo mas pronto posible.</td>
		</tr>
		<tr>
		  <td colspan="2" style="text-align:center; padding-top: 10px;"><img src="http://corpmegawatts.com/img/LogoFinal.jpg" style="width:100px; height:auto;" alt="'.$configurar['tx_titulo_tienda'].'"/></td>
		</tr>
	  </tbody>
	</table>
	</div>';

		mail($to, $subject, $message, $headers);
	
	echo "<div class='modal-body'><div class='alert alert-success alert-dismissible fade in' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>
				<h4>Aviso</h4>
				<p>Su mensaje pudo ser enviado</p>
				<p><button type='button' class='btn btn-info' onClick=\"parent.$('#modal_det_iframe').modal('hide');\">Aceptar</button>
				</p>
			</div></div>";
}
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Enviar mensaje a Megawatts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
</head>
<body>
<form method="post" id="frm_mensaje" name="frm_mensaje" action="escribir_mensaje_sos.php">
<div class="modal-body">
      <div class="form-group col-xs-12">
        <label for="exampleInputEmail1">Correo Electrónico:</label>
        <input type="text" class="form-control" id="tx_correo" name="tx_correo" value="<?php echo $row['nb_usuario'];?>" readonly>
        <label for="tx_mensaje">Mensaje:</label>
        <textarea class="form-control" rows="11" id="tx_mensaje" name="tx_mensaje" required></textarea>
      </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary" name="btn_contactar">Enviar</button>
</div>
</form>

<script src="../../../js/jquery-1.11.1.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script type="text/javascript">
$('.modal-content #ventana').ready(function() {
	//alert('cargo');
	parent.document.getElementById('precarga').style.display='none';
});
</script>
</body>
</html>