<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

$sql6=mysqli_query($link,"SELECT COUNT(*) AS num FROM th001_usuario WHERE nb_usuario='".$_POST['nb_usuario']."'");
$num_registros = mysqli_fetch_array($sql6);
 
if($num_registros['num']==0){

	$clave = md5($_POST['tx_clave']);

	$sql="INSERT INTO th001_usuario (co_nivel_usuario,nb_usuario,tx_clave,in_mconf,in_mcliente,in_mpedido,in_mvendedor,in_mclasifica,in_mbanca,in_transporte,in_estatus) VALUES (3,'".$_POST['nb_usuario']."','".$clave."',0,0,0,0,0,0,0,1)";
	mysqli_query($link,$sql);

	$sql2="SELECT MAX(co_usuario) AS id FROM th001_usuario";
	$result = mysqli_query($link,"SELECT MAX(co_usuario) AS id FROM th001_usuario");
	$cod = mysqli_fetch_array($result);
	
	$sql3="INSERT INTO tg002_vendedor (co_usuario,nb_vendedor,nu_cedula,nu_telefono,nu_comision,fe_ultima_session,in_estatus) VALUES (".$cod['id'].",'".$_POST['nb_vendedor']."','".$_POST['nu_cedula']."','".$_POST['nu_telefono']."','".$_POST['nu_comision']."',NULL,1)";
	mysqli_query($link,$sql3);
	
	//require_once '../../../../js/PHPMailer-master/PHPMailerAutoload.php';
	//PARA ENVIAR EL CORREO
		
		/*$mensaje = '
		Datos de su Registro en Bydigital:
		   Usuario: '.$_POST['nb_usuario'].'
		   Contraseña: '.$_POST['tx_clave'].'
		';
		
		//$header = "From: info@cedulasalud.com";
		
		$para= $_POST['nb_usuario'];
		$titulo = "Bienvenido a Bydigital";
		
		//mail($para, $titulo, $mensaje, $header);
		
			//Especificamos los datos y configuración del servidor
			$mail = new PHPMailer();
			$mail->IsSMTP();
			//Agregamos la información que el correo requiere
			$mail->From = "notificacion@bydigitalv2.com";
			$mail->FromName = "Bydigital";
			$mail->Subject = "Bienvenido a Bydigital";
			$mail->AltBody = "";
			$mail->MsgHTML("".$mensaje."");
			//$mail->AddAttachment("adjunto.txt");
			$mail->AddAddress($para, "Vendedor");
			$mail->IsHTML(true);
			 
			//Enviamos el correo electrónico
			$mail->Send();
	//HASTA AQUI CORREO
			
	//echo $sql;*/
	
		$to = $_POST['nb_usuario'];
		$subject = "Bienvenido a ".$_SESSION['params']['tx_titulo_tienda'];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$message = '
		<div style="width:100%; font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;">
		<table width="100%" border="0" style="margin:0 auto; width:500px;">
		  <tbody>
			<tr>
			  <td colspan="3" style="text-align:center;"><h3>Datos del Vendedor en Bydigital</h3></td>
			  </tr>
			<tr>
			  <td rowspan="2" style="text-align:center"><img src="http://corpmegawatts.com/img/LogoFinal.jpg" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></td>
			  <td>Usuario:</td>
			  <td>'.$_POST['nb_usuario'].'</td>
			</tr>
			<tr>
			  <td>Contraseña:</td>
			  <td>'.$_POST['tx_clave'].'</td>
			</tr>
			<tr>
			  <td colspan="3" style="text-align:center; padding-top:20px;"><img src="http://corpmegawatts.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/> </a></td>
			</tr>
		  </tbody>
		</table>
		</div>';

		mail($to, $subject, $message, $headers);
		
		//FIN PARA ENVIAR EL CORREO
		echo "<script type='text/javascript' charset='utf-8'>alert('Ya se proceso su registro y le fue enviado un correo revisar los spam.');$('#modal_editar_iframe').modal('hide');cambio('fichas/vendedores.php','cont');</script>";	

	}else{
		echo "<script type='text/javascript'>alert('No se puedo realizar su registro, es Posible que ya Exista el Usuario');parent.$('#modal_det_iframe').modal('hide');</script>";
	}
?>