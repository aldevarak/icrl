<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");
include ("../../../funciones/funciones.php");

//require_once("../../../js/PHPMailer-master/class.phpmailer.php");
//require_once("../../../js/PHPMailer-master/class.smtp.php");

unset($_SESSION['params']);
$respar = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$_SESSION['params'] = mysqli_fetch_array($respar);

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
//echo $id;

if (isset($_POST['opc'])){ $opc = $_POST['opc'];}
if (isset($_GET['opc'])){ $opc = $_GET['opc'];}
//echo $opc;

$result = mysqli_query($link,"SELECT tx_correo_contacto FROM tg004_configuracion");
$cod = mysqli_fetch_array($result);

if ($opc=="cliente"){
	$result2 = mysqli_query($link,"SELECT usu.nb_usuario FROM tg005_clientes AS cli INNER JOIN th001_usuario AS usu ON cli.co_usuario=usu.co_usuario WHERE co_clientes='".$id."'");
	$cod2 = mysqli_fetch_array($result2);	
}

if ($opc=="vendedor"){
	$result2 = mysqli_query($link,"SELECT usu.nb_usuario FROM tg002_vendedor AS ven INNER JOIN th001_usuario AS usu ON ven.co_usuario=usu.co_usuario WHERE co_vendedor='".$id."'");
	$cod2 = mysqli_fetch_array($result2);	
}

if (isset($_POST['tx_mensaje'])) {
	
//PARA ENVIAR EL CORREO
		$mensaje = $_POST['tx_mensaje'];
		
		//$header = "From: info@cedulasalud.com";
		
		/*$para= $cod2['nb_usuario'];
		$titulo = "Correo Bydigital";
		
		//mail($para, $titulo, $mensaje, $header);
		
			//Especificamos los datos y configuración del servidor
			$mail = new PHPMailer();
			$mail->IsSMTP();
			//Agregamos la información que el correo requiere
			$mail->From = "".$cod['tx_correo_contacto']."";
			$mail->FromName = "Bydigital";
			$mail->Subject = "Correo Bydigital";
			$mail->AltBody = "";
			$mail->MsgHTML("".$mensaje."");
			//$mail->AddAttachment("adjunto.txt");
			$mail->AddAddress($para, "Cliente");
			$mail->IsHTML(true);
			 
			//Enviamos el correo electrónico
			$mail->Send();
//HASTA AQUI CORREO	*/
	
		$to = $cod2['nb_usuario'];
		$to2 = $cod['tx_correo_contacto'];
		$subject = "Mensaje desde ".$_SESSION['params']['tx_titulo_tienda'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$message = $mensaje;

		mail($to, $subject, $message, $headers);
		mail($to2, $subject, $message, $headers);
	
	if ($opc=="cliente"){
		echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_escribir_iframe').modal('hide');parent.parent.parent.cambio('fichas/clientes.php','cont');</script>";	
	}
	
	if ($opc=="vendedor"){
		echo "<script type='text/javascript' charset='utf-8'>$('#modal_det_iframe').modal('hide');parent.parent.parent.cambio('fichas/vendedores.php','cont');</script>";
		
	/*echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_escribir_iframe').modal('hide');parent.parent.parent.cambio('fichas/vendedores.php','cont');</script>";*/	
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Enviar Mensajes</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
<style type="text/css">
.modal-footer{
	padding-bottom:0;
	margin-bottom:0;
}
</style>
</head>
<body>
<form method="post" id="frm_mensaje" name="frm_mensaje" action="escribir_mensaje.php">
<div class="modal-body">
      <div class="form-group col-xs-12">
        <label for="exampleInputEmail1">Correo Electrónico:</label>
        <input type="text" class="form-control" id="tx_correo" name="tx_correo" value="<?php echo $cod2['nb_usuario'];?>" readonly>
        <label for="tx_mensaje">Mensaje:</label>
        <textarea class="form-control" rows="11" id="tx_mensaje" name="tx_mensaje"></textarea>
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <input type="hidden" name="opc" id="opc" value="<?php echo $opc;?>">
      </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <button type="submit" class="btn btn-default" data-dismiss="modal">Enviar</button>
  <button type="button" class="btn btn-primary" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
</div>
</form>
<script src="../../../js/jquery-1.11.1.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
</script>
</body>
</html>