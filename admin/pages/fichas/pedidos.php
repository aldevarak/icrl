<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
	include ("../../../funciones/funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pedidos</title>
</head>
<body>
	<table id="example" class="table table-striped table-bordered display" cellspacing="0">
        <thead>
            <tr>
                <th>Nº Pedido</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Pendiente</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
		$sql="SELECT ped.*,cli.* FROM (tr001_pedidos AS ped INNER JOIN tg005_clientes AS cli ON ped.co_clientes=cli.co_clientes) WHERE ped.in_estatus='1' ORDER BY ped.fe_fecha DESC";
		$res=mysqli_query($link,$sql);
		
		while ($row = mysqli_fetch_array($res)) {
			$originalDate = $row['fe_fecha'];
			$newDate = date("m/d/Y", strtotime($originalDate));
			$fecha= traducefecha($newDate);
		
			$sql2="SELECT * FROM tr003_pagos WHERE co_pedidos='".$row['co_pedidos']."' AND in_estatus='1'";
			$res2=mysqli_query($link,$sql2);
					
			while ($row2 = mysqli_fetch_array($res2)) {
				$suma_pago=$suma_pago+$row2['nu_monto'];	
			}
		
			$deuda=$row['nu_total']-$suma_pago;
			
			if($suma_pago>0){
				$estatus_cobro="Si posee";	
			}else{
				$estatus_cobro="No posee";
			}
		
			$estructura.="
				<tr>
					<td>".$row['nu_pedido']."</td>
					<td>".$fecha."</td>
					<td>".$row['nb_clientes']."</td>
					<td>".$row['nu_estatus']."</td>
					<td><span class='badge'>".$estatus_cobro."</span></td>
					<td>BsF ".number_format($row['nu_total'],2,",",".")."</td>
					<td>BsF ".number_format($deuda,2,",",".")."</td>
					<td>
                	<div class='btn-group'>
                      <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                        Acciones <span class='caret'></span>
                      </button>
                      <ul class='dropdown-menu' role='menu'>
					  <li><a href='javaScript:;' onclick=\"modal_ver(".$row['co_pedidos'].");\">Ver</a></li>";
			
			if($row['nu_estatus']!="Procesado"){
				$estructura.="<li class='divider'></li>
                        <li><a href='#' onclick=\"procesar_pago(".$row['co_pedidos'].");\">Procesar Pago</a></li>";
			}
			
			if($row['nu_estatus']=="Sin Notificar Pago"){
				$estructura.="<li class='divider'></li>
                        
						<li><a href='javaScript:;' onclick=\"modal_eliminar(".$row['co_pedidos'].");\">Eliminar</a></li>";
			}
			
			$estructura.="</ul>
                    </div>
                </td>
            </tr>";
			
		$deuda=0;
		$suma_pago=0;
		}
		
		echo $estructura;
		
        ?>
        </tbody>
    </table>
<div id="funciones"></div>
<!--HASTA AQUI LA MODAL-->
<script type="text/javascript">
$(document).ready(function() {
	$('#page-loader').fadeOut(500);
	var table = $('table.display').DataTable({
		"dom": '<"col-sm-6 col-xs-12"l><"col-sm-6 col-xs-12"f>rt<"col-sm-4 col-xs-12"i><"col-sm-4 col-xs-12"B><"col-sm-4 col-xs-12"p><"clearfix">',
		language:{
            "sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del _START_ al _END_ de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sSearch":         "Buscar:",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Sig.",
				"sPrevious": "Ant."
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
        },
	responsive: true,
	"lengthMenu": [ [20, 25, 50, 100, -1], [20, 25, 50, 100, "Todo"] ],
	buttons:[
			{
                extend: 'copyHtml5',
				text: 'Copiar',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                },
				title:'Pedidos'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                },
				title:'Pedidos',
				pageSize: 'letter',				
            },
			{
                extend: 'print',
				text: 'Imprimir',
				title:'Pedidos',
				//autoPrint: false,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                },
				customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
						.css( 'margin-top', '0' )
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            },
			{
                extend: 'colvis',
				text: 'Mostrar/ocultar',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            }			
		],
	columnDefs: [
	{
		orderable: false,
		targets:   [7]
	}],
    });
});
function modal_ver(id) {
	console.log('codigo '+id);
	/*$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe iframe").attr({'src':'../fichas/ver_pedido.php?id='+id,});*/
	
	var a = document.createElement("a");
	a.target = "_blank";
	a.href = '../pages/fichas/ver_pedido.php?id='+id;
	a.click();
}
//Dialog	
function procesar_pago(id) {
	//alert(id);
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea Procesar el pago de este Pedido?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						var parametros = {
								"id" : id
						};

						$.ajax({
								data:  parametros,
								url:   '../../funciones_ajax/procesar_pagos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/pedidos.php','cont');
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
function modal_eliminar(id) {
	//alert(id);
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar este pedido?, la eliminación del pedido producira que los Items Comprados, vuelvan al Inventario del mismo.',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						var parametros = {
								"id" : id
						};

						$.ajax({
								data:  parametros,
								url:   '../../funciones_ajax/eliminar_pedido.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/pedidos.php','cont');
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