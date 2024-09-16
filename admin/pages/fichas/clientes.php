<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
	include ("../../../funciones/funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clientes</title>
</head>
<body>
	<table id="example" class="table table-striped table-bordered display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cedula/Rif</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Ubicación</th>
                <th>Registro</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT usu.*,cli.* FROM (th001_usuario AS usu INNER JOIN tg005_clientes AS cli ON usu.co_usuario=cli.co_usuario) WHERE cli.in_estatus='1' AND cli.co_clientes!='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {
				
				$originalDate = $row['fe_registro'];
				$newDate = date("m/d/Y", strtotime($originalDate));
				$fecha= traducefecha($newDate);
					
				$estructura.="
					<tr>
						<td>".$row['nb_clientes']."</td>
						<td>".$row['nu_rif_cedula']."</td>
						<td>".$row['nb_usuario']."</td>
						<td>".$row['nu_telefono']."</td>
						<td>".$row['tx_direccion_fiscal']."</td>
						<td>".$fecha."</td>
						<td>
							";
						
				if ($row['in_activa']=="1"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver / Editar Cliente' data-height='600px' href='javaScript:;' onclick=\"modal_ed(".$row['co_clientes'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li><a data-title='Mensaje' data-height='450px' href='javaScript:;' onclick=\"modal_mensaje(".$row['co_clientes'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Escribir Mensaje</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear(".$row['co_clientes'].");\">Bloquear</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear(".$row['co_clientes'].");\">Desbloquear</button>";
				}

				$estructura.="
						</td>
					</tr>";
				}
				echo $estructura;
		?>
        </tbody>
    </table>
<div id="funciones"></div>

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
	"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todo"] ],
	buttons:[
			{
                extend: 'copyHtml5',
				text: 'Copiar',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                },
				title:'Pedidos'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
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
                    columns: [0,1,2,3,4,5]
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
                    columns: [0,1,2,3,4,5]
                }
            }			
		],
	columnDefs: [
	{
		orderable: false,
		targets:   [6]
	}],
    });
});
function modal_ed(id) {
	$(".modal-dialog").addClass( "modal-md" );
	//$("#modal_det_iframe iframe").attr({'src':'fichas/editar_cliente.php?id='+id,});
	$("#modal_det_iframe #ventana").load( 'fichas/editar_cliente.php?id='+id);
}
function modal_mensaje(id) {
	$(".modal-dialog").addClass( "modal-md" );
	//$("#modal_det_iframe iframe").attr({'src':'fichas/escribir_mensaje.php?id='+id+'&opc=cliente',});
	$("#modal_det_iframe #ventana").load( 'fichas/escribir_mensaje.php?id='+id+'&opc=cliente');
}
//Dialog
function bloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este cliente?',
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
								url:   '../../funciones_ajax/bloquear_clientes.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clientes.php','cont');
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
function desbloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear este cliente?',
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
								url:   '../../funciones_ajax/desbloquear_clientes.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clientes.php','cont');
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