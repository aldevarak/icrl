<?php 
include ("../inic/dbcon.php");
require_once("../js/PHPMailer-master/class.phpmailer.php");
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
		$mensaje="<div> Como Administrador no puede generar un pedido</div>";
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
		}
		
	//PARA ENVIAR EL CORREO
		$mensaje_correo = '
Su pedido ha sido procesado y almacenado en nuestro sistema bajo el numero '.$Correlativo.'.

**********************************************************************************
NOTA: Una version electronica de este pedido se encuentra guardada en su
cuenta en nuestra tienda en linea, puede acceder en su cuenta para 
visualizarlo nuevamente.

Todo Pedido tiene vigencia máxima, tome en cuenta este tiempo para 
contactar al vendedor y concretar su compra.
**********************************************************************************';

		
		$para= $_SESSION['nb_usuario'];
		$titulo = "Bienvenido a ".$_SESSION['params']['tx_titulo_tienda'];
		
		//mail($para, $titulo, $mensaje, $header);
		
			//Especificamos los datos y configuración del servidor
			$mail = new PHPMailer();
			$mail->IsSMTP();
			//Agregamos la información que el correo requiere
			$mail->From = "".$_SESSION['params']['tx_correo_pedidos']."";
			$mail->FromName = "Bydigital";
			$mail->Subject = "Bienvenido a Bydigital";
			$mail->AltBody = "";
			$mail->MsgHTML("".$mensaje_correo."");
			//$mail->AddAttachment("adjunto.txt");
			$mail->AddAddress($para, "Cliente");
			$mail->IsHTML(true);
			 
			//Enviamos el correo electrónico
			$mail->Send();	
		
		unset($_SESSION['carrito'],$_SESSION['item'],$_SESSION['subtotal'],$_SESSION['total']);

	$mensaje="<div>Su pedido fue agregado con exito</div>";
	}
	
	if ($_SESSION['co_nivel_usuario']=="3"){
		$mensaje="<div>El Vendedor aun esta en desarrollo</div>";	
	}

}else{
	$mensaje="<div> Debe estar registrado para poder generar un pedido</div>";	
}

echo $mensaje;
unset($_SESSION['carrito'],$_SESSION['item'],$_SESSION['subtotal'],$_SESSION['total']);
$texto_carrito="0 productos / 0,00 Bsf";
echo "<script type='text/javascript'>parent.$('#tx_carrito small').text('".$texto_carrito."');</script>";
?>

																																																																																					