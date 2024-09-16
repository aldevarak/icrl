<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Banca</title>
</head>
<body>
<a class="btn btn-success btn-block" data-title='Nuevo Banco' href='javaScript:;' onclick="modal_agr();" data-toggle='modal' data-target='#modal_det_iframe'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Cuenta</a>
<hr>
	<table class="table table-striped table-bordered display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>T. Cuenta</th>
                <th>Banco</th>
                <th>Cuenta</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT * FROM tg003_cuentas";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {
					
				$estructura.="
					<tr>
						<td>".$row['tp_cuentas']."</td>
						<td>".$row['tx_banco']."</td>
						<td>".$row['nu_cuenta']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='".$row['tx_banco']."' href='javaScript:;' onclick=\"modal_ver(".$row['co_cuentas'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear(".$row['co_cuentas'].");\">Bloquear</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear(".$row['co_cuentas'].");\">Desbloquear</button>";
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
                    columns: [0,1,2]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2]
                },
				title:'cuentas'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2]
                },
				title:'Cuentas',
				pageSize: 'letter',				
            },
			{
                extend: 'print',
				text: 'Imprimir',
				title:'Cuentas',
				//autoPrint: false,
                exportOptions: {
                    columns: [0,1,2]
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
                    columns: [0,1,2]
                }
            }			
		],
	columnDefs: [
	{
		orderable: false,
		targets:   [3]
	}],
    });
});
function modal_agr() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_cuenta.php' );
}
function modal_ver(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_cuenta.php?id='+id);
}
//Dialog
function bloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este cuenta?',
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
								url:   '../../funciones_ajax/bloquear_cuenta.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/banca.php','cont');
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
            message: '¿Seguro desea desbloquear esta cuenta?',
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
								url:   '../../funciones_ajax/desbloquear_cuenta.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/banca.php','cont');
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