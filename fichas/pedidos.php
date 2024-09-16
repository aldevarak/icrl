<?php
include ("../inic/dbcon.php");
include ("../funciones/funciones.php");

@session_start();

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

if (isset($_POST['modo'])){ $modo = $_POST['modo'];}
if (isset($_GET['modo'])){ $modo = $_GET['modo'];}
//echo $id."<br>";
//echo $modo."<br>";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pedidos</title>
<style type="text/css">
.panel-body{
	padding: 10px;
	}
</style>
</head>

<body>
<div class="container-fluid">
<div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Sus Pedidos</strong></div>
      <div class="panel-body">
        <table id="example" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Total</th>
                    <th>Pendiente</th>
                    <th>Acción</th>
                </tr>
            </thead> 
            <tbody>
            <?php
				$sql="SELECT * FROM tr001_pedidos WHERE co_clientes='".$_SESSION['cliente']['co_clientes']."' AND in_estatus='1'";
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
					
					$estructura.="
						<tr>
							<td>".$row['nu_pedido']."</td>
							<td>".$fecha."</td>
							<td>".$row['nu_estatus']."</td>
							<td>".number_format($row['nu_total'],2,",",".")."</td>
							<td>".number_format($deuda,2,",",".")."</td>
							<td>
								";
							
					$estructura.="
								<div class='btn-group'>
									<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
										Acciones <span class='caret'></span>
									</button>
									<ul class='dropdown-menu' role='menu'>
										<li><a data-title='Pedido Nº ".$row['nu_pedido']."' data-height='620px' href='javaScript:;' onclick=\"detalles_ped(".$row['co_pedidos'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver</a>
										</li>";
										
					if (($row['nu_estatus']=="Sin Notificar Pago")||($deuda>0)){					
						 $estructura.="           	
										<li><a data-title='Pago del pedido ".$row['nu_pedido']."' data-height='550px' href='javaScript:;' onclick=\"notificar(".$row['co_pedidos'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Notificar Pago</a></li>";
					}	
						
						$estructura.="
									</ul>
								</div>
						";	
					
					$estructura.="
							</td>
						</tr>";
						
					$deuda=0;
					$suma_pago=0;
				}
				echo $estructura;
			?>
            </tbody>
        </table>
            </div>
        </div>
      </div>
</div>
</div>
<div id="funciones"></div>
<script type="text/javascript">
$(document).ready(function() {
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
	"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
	buttons:[
			{
                extend: 'copyHtml5',
				text: 'Copiar',
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4]
                },
				title:'Pedidos'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4]
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
                    columns: [0,1,2,3,4]
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
                    columns: [0,1,2,3,4]
                }
            }			
		],
	columnDefs: [
	{
		orderable: false,
		targets:   [5]
	}],
    });
});
function detalles_ped(id) {
	parent.cambio('../fichas/pedidos.php','cont');
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load('../fichas/detalles-ped.php?id='+id);
}
function notificar(id) {
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load('../fichas/procesar-pago.php?id='+id);
}
function pago_exito() {
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
}
</script>
</body>
</html>