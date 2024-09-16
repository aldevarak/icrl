<?php
include ("../inic/dbcon.php");
include ("../inic/session.php");
//require_once '../js/PHPMailer-master/PHPMailerAutoload.php';

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id."<br>";
$hoy=date('Y-m-d H:i:s');

$result = mysqli_query($link,"SELECT * FROM tr001_pedidos WHERE co_pedidos='".$id."'");
$cod = mysqli_fetch_array($result);

$sql2="SELECT * FROM tr003_pagos WHERE co_pedidos='".$id."' AND in_estatus='1'";
$res2=mysqli_query($link,$sql2);

while ($row2 = mysqli_fetch_array($res2)) {
	$suma_pago=$suma_pago+$row2['nu_monto'];	
}

$deuda=$cod['nu_total']-$suma_pago;

if (isset($_POST['btn_enviar'])){
	//echo $_POST['pago'];
	
	if ($_POST['pago']=="pago_t"){
		$monto=$_POST['pagototal'];
	}else{
		$monto=$_POST['pagoparcial'];
	}
	
	$sql3="INSERT INTO tr003_pagos (co_pedidos,co_cuentas,tp_pagos,tx_banco,tx_depositante,nu_monto,fe_fecha,nu_transaccion,in_estatus) VALUES (".$id.",'".$_POST['co_cuentas']."','".$_POST['tp_pagos']."','".$_POST['tx_banco']."','".$_POST['tx_depositante']."','".$monto."','".$hoy."','".$_POST['nu_transaccion']."',1)";
	mysqli_query($link,$sql3);
	
	$sql4="UPDATE tr001_pedidos SET nu_estatus='Por Procesar' WHERE co_pedidos='".$id."'";
	mysqli_query($link,$sql4);
	
//correo	
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
			  <td colspan="3" style="text-align:center;"><img src="http://corpmegawatts.com/img/logo_bydigital.png" alt="ByDigital" 150px" height="auto"/> <img src="http://corpmegawatts.com/img/LogoFinal.jpg" style="width:100px; height:auto;" alt="'.$_SESSION['params']['tx_titulo_tienda'].'"/></a></td>
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
					message: 'Su pago fue agregado con exito y le fue enviado una notificación a su correo',
					buttons: [{
						label: 'Aceptar',
						action: function(dialogItself){
							dialogItself.close();
							}
					}]
				});
				</script>";
	
	
	//FIN PARA ENVIAR EL CORREO
	echo "<script type='text/javascript' charset='utf-8'>console.log('paso');parent.$('#modal_det_iframe').modal('hide');parent.parent.parent.cambio('../fichas/pedidos.php','cont');</script>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Procesar Pagos</title>
<!--<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">-->
<link rel="stylesheet" type="text/css" href="../css/select/bootstrap-select.css">
<style type="text/css">
.modal-footer{
	padding-bottom:0;
	margin-bottom:0;
}
</style>
</head>

<body>
<div class="modal-body">
<form method="post" id="frm_pago" name="frm_pago" action="../fichas/procesar-pago.php">
        <div class='form-group col-xs-12'>
            <label for="exampleInputEmail1">Forma de pago</label>
            <select class='selectpicker' data-live-search='true' name='tp_pagos' id='tp_pagos' data-width='100%' onchange="mostarbanco(this)">
                <option value='0'>Seleccione...</option>
                <option value='1'>Depósito</option>
                <option value='2'>Transferencia</option>
        	</select>
          </div>
          <?php
		  	$sql="SELECT * FROM tg003_cuentas WHERE in_activa='1'";
			$res=mysqli_query($link,$sql);
				
			while ($row = mysqli_fetch_array($res)) {
				$opcion_1.= '<option value="'.$row['co_cuentas'].'" ';
				if ($cod['co_cuentas']==$row['co_cuentas']){ $opcion_1.= 'selected';}
				$opcion_1.= '>'.$row['tx_banco'].' / '.$row['nu_cuenta'].' / '.$row['tp_cuentas'].'</option>';
			}
		  ?>
          <div class='form-group col-xs-12'>
            <label for="cuentabancaria">Cuenta donde pago</label>
            <select class='selectpicker' data-live-search='true' name='co_cuentas' id='co_cuentas' data-width='100%'>
                <option value=''>Seleccione un Banco</option>
                <?php echo $opcion_1;?>
        	</select>
          </div>
          <div class='form-group col-xs-12' id='hidden_div' style="display: none;">
            <label for="banco-emisor">Banco Emisor</label>
            <input type='text' class='form-control' id='tx_banco' name="tx_banco" placeholder="Banco desde donde pagó">
          </div>
          <div class="form-group col-xs-12">
            <label for="transferencia">Nº Transferencia o Depósito</label>
            <input type='text' class='form-control' id='nu_transaccion' name="nu_transaccion" placeholder="Nº Deposito o transferencia" required>
          </div>
          <div class="form-group col-xs-12">
            <label for="titular">Depositante</label>
            <input type='text' class='form-control' id='tx_depositante' name="tx_depositante" placeholder="Nombre de quien paga" required>
          </div>
          <div class='form-group col-xs-6'>
				<label><input type="radio" name="pago" value="pago_t" checked> Pago total</label>
                <input type='text' class='form-control' id='pagototal' name="pagototal" placeholder="Pago total" value="<?php echo $deuda;?>" readonly>
          </div>
          <div class='form-group col-xs-6'>
                <label><input type="radio" name="pago" value="pago_p"> Pago parcial</label>
                <input type='text' class='form-control' id='pagoparcial' name="pagoparcial" placeholder="Pago parcial" readonly>
          </div>     
        <div class="clearfix"></div>
        <div class="modal-footer">
        	<input type='hidden' class='form-control' id='id' name="id" placeholder="Pago parcial" value='<?php echo $id;?>'>
          <button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
          <button type="submit" class="btn btn-primary" data-dismiss="modal" id="btn_enviar" name="btn_enviar">Notificar</button>
        </div>
</form>
</div><!-- /container -->
<div id="funciones"></div>
<!--<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/bootstrap.min.js"></script>-->
<script src="../js/select/bootstrap-select.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var $radios = $('input:radio[name=pago]');
		if($radios.is(':checked') === false) {
			$radios.filter('[value=pago_t]').prop('checked', true);
		};
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="pago_t"){
                $("#pagototal").attr("readonly", true);
				$("#pagoparcial").attr("readonly", true);
				$("#pagoparcial").val("");
            }
            if($(this).attr("value")=="pago_p"){
				$("#pagoparcial").attr("readonly", false);
				$("#pagoparcial").val("");
            }
        });
});
	
$('.modal-content #ventana').ready(function() {
	//alert('cargo');
	parent.document.getElementById('precarga').style.display='none';
});
$('.selectpicker').selectpicker({
      style: 'btn-default',
	  showSubtext: true
});
function mostarbanco(elem){
	if(elem.value == 1)
		document.getElementById('hidden_div').style.display = "none";
	if(elem.value == 2)
		document.getElementById('hidden_div').style.display = "block";
	if(elem.value == 0)
		document.getElementById('hidden_div').style.display = "none";
}


</script>
</body>
</html>