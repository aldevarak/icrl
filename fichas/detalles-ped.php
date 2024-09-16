<?php
include ("../inic/dbcon.php");
include ("../inic/session.php");
include ("../funciones/funciones.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
//echo $id;
$hoy=date('Y-m-d H:i:s');

$result = mysqli_query($link,"SELECT ped.*,cli.* FROM (tr001_pedidos AS ped INNER JOIN tg005_clientes AS cli ON ped.co_clientes=cli.co_clientes) WHERE ped.co_pedidos='".$id."'");
$cod = mysqli_fetch_array($result);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Detalles del pedido</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<style type="text/css">
</style>
</head>

<body>
<div class="modal-body">
<div class="row">
    <div class="col-sm-12 col-md-12">
    <div class="row">
        <div class="col-xs-6">
            <h1><img src="../img/<?php echo $_SESSION['params']['tx_logo'];?>" class="img-responsive" alt=""/></h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>PEDIDO</h1>
                <h1><small>Pedido #<?php echo $cod['nu_pedido'];?></small></h1>
        </div>
     </div>
    <hr/>
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                De: <strong><?php echo $_SESSION['params']['tx_nombre_empresa'];?></strong>
                </div>
            <div class="panel-body"><small>El pago debe ser por transferencia o depósito bancario</small></div>
            </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                Para : <strong><?php echo $cod['nb_clientes'];?></strong>
                </div>
            <div class="panel-body">
            	Dirección Envio: <?php echo $cod['tx_direccion_entrega'];?><br>
				Teléfono: <?php echo $cod['nu_telefono'];?><br>
                CI/Rif: <?php echo $cod['nu_rif_cedula'];?><br>
                Email: <?php echo $_SESSION['nb_usuario'];?>
            </div>
            </div>
        </div>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Sub-Total</th>
                </tr>
            </thead>
        <tbody>
        <?php
		$sql5="SELECT ren.*,pro.nb_productos FROM(tr002_reng_pedidos AS ren INNER JOIN tg013_productos AS pro ON ren.co_productos=pro.co_productos) WHERE ren.co_pedidos='".$id."' AND ren.in_estatus='1'";
		$res5=mysqli_query($link,$sql5);
		//echo $sql5;
		
		while ($row5=mysqli_fetch_array($res5)) {
			$precio=$row5['nu_sub_total']/$row5['nu_cantidad'];
			
			$estructura_pedido.="
			<tr>
                <td>".$row5['co_productos']."</td>
                <td>".$row5['nb_productos']."</td>
                <td class='text-right'>".$row5['nu_cantidad']."</td>
                <td class='text-right'>".$_SESSION['moneda']['di_simbolo']." ".number_format($precio,2,",",".")."</td>
                <td class='text-right'>".$_SESSION['moneda']['di_simbolo']." ".number_format($row5['nu_sub_total'],2,",",".")."</td>
            </tr>
			";	
			
			$sub_total=$sub_total+$row5['nu_sub_total'];
		}
		
		$iva=$cod['nu_total']-$sub_total;
		echo $estructura_pedido;
		?>
	    </tbody>
        </table>
	</div>
    <div class="row text-right">
        <div class="col-xs-3 col-xs-offset-7">
            <strong>
            Sub Total:<br>
            Impuesto (IVA <?php echo $cod['tx_iva'];?>%):<br>
            Total:
            </strong>
        </div>
        <div class="col-xs-2">
            <strong>
                <?php echo $_SESSION['moneda']['di_simbolo'];?> <?php echo number_format($sub_total,2,",",".");?><br>
                <?php echo $_SESSION['moneda']['di_simbolo'];?> <?php echo number_format($iva,2,",",".");?><br>
                <?php echo $_SESSION['moneda']['di_simbolo'];?> <?php echo number_format($cod['nu_total'],2,",",".");?>
            </strong>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class = "col-xs-6">
            <div class="panel panel-info">
            <div class="panel-heading"><strong>Pagos Realizados</strong></div>
                <div class="panel-body">
                <?php
					$sql2="SELECT pa.*,cu.nu_cuenta,cu.tp_cuentas,cu.tx_banco AS bancocuenta FROM (tr003_pagos AS pa INNER JOIN tg003_cuentas AS cu ON pa.co_cuentas=cu.co_cuentas) WHERE pa.co_pedidos='".$id."' AND pa.in_estatus='1'";
					$res2=mysqli_query($link,$sql2);
					
					//echo $sql2;
					
					while ($row2 = mysqli_fetch_array($res2)) {
						$originalDate = $row2['fe_fecha'];
						$newDate = date("m/d/Y", strtotime($originalDate));
						$fecha= traducefecha($newDate);
						
						if($row2['tp_pagos']=="1"){
							$tp_pagos="Deposito";	
						}else{
							$tp_pagos="Transferencia desde ".$row2['tx_banco'];
						}
					
						$estructura_pagos.="
							Banco: ".$row2['bancocuenta']."<br>
							Cuenta: ".$row2['nu_cuenta']." Tipo: ".$row2['tp_cuentas']."<br>
							".$tp_pagos.": ".$row2['nu_transaccion']."<br>
							Monto: BsF ".number_format($row2['nu_monto'],2,",",".")."<br>
							Fecha: ".$fecha."<br>
						";
					}
					echo $estructura_pagos;
				?>
                 </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="span7">
                <div class="panel panel-info">
                <div class="panel-heading"> <strong>Datos de contacto cliente</strong> </div>
                    <div class="panel-body">
                    Dirección: <?php echo $cod['tx_direccion_fiscal'];?>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div><!-- /container -->
<div class="modal-footer">
    <button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cerrar</button>
    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_enviar" name="btn_enviar" onClick="window.print();">Imprimir</button>
</div>
<div id="funciones"></div>
<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
$('.modal-content #ventana').ready(function() {
	parent.document.getElementById('precarga').style.display='none';
});
function eliminar_pro(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea eliminar el producto de su carrito?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						//alert(id);
						
						var parametros = {
								"id" : id
						};

						$.ajax({
								data:  parametros,
								url:   '../funciones_ajax/fun_carrito_eliminar.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('../fichas/carrito-total.php?modo=ver','cont');
								}
						});
						dialogItself2.close();
					}
			}, {
					label: 'No',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });

}
</script>
</body>
</html>