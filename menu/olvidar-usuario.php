<?php 
include ("../inic/dbcon.php");

require_once("../js/PHPMailer-master/class.phpmailer.php");
require_once("../js/PHPMailer-master/class.smtp.php");

if (isset($_POST['email'])){ $email = $_POST['email'];}
if (isset($_GET['email'])){ $email = $_GET['email'];}

$tx_clave=rand(1000, 9999);
$hoy = date("Y-m-d H:i:s");

$result = mysqli_query($link,"SELECT COUNT(co_usuario) AS num,co_usuario FROM th001_usuario WHERE nb_usuario='".$email."'");
$cod = mysqli_fetch_array($result);

if($cod['num']!=0){
	//PARA ENVIAR EL CORREO
		$mensaje = '
		Datos de su Cambio de Contraseña en Bydigital:
		   Usuario: '.$email.'
		   Contraseña: '.$tx_clave.'
		';
		
		//$header = "From: info@cedulasalud.com";
		
		$para= $_POST['email'];
		$titulo = "cambio de Contraseña Bydigital";
		
		//mail($para, $titulo, $mensaje, $header);
		
			//Especificamos los datos y configuración del servidor
			$mail = new PHPMailer();
			$mail->IsSMTP();
			//Agregamos la información que el correo requiere
			$mail->From = "notificacion@bydigitalv2.com";
			$mail->FromName = "Bydigital";
			$mail->Subject = "cambio de Contraseña Bydigital";
			$mail->AltBody = "";
			$mail->MsgHTML("".$mensaje."");
			//$mail->AddAttachment("adjunto.txt");
			$mail->AddAddress($para, "Usuario");
			$mail->IsHTML(true);
			 
			//Enviamos el correo electrónico
			$mail->Send();
	//HASTA AQUI CORREO
	
	$clave = md5($tx_clave);
	
	$sql4="UPDATE th001_usuario SET tx_clave='".$clave."' WHERE co_usuario='".$cod['co_usuario']."'";
	mysqli_query($link,$sql4);

}else{
	echo "<script type='text/javascript'> alert('Este Usuario no Existe en nuestro tienda');</script>";
}
	
?>