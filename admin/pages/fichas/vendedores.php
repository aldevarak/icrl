<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
	include ("../../../funciones/funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Vendedores</title>
</head>
<body>
<a class="btn btn-success btn-block" data-title='Nuevo Vendedor' href='javaScript:;' onclick="modal_agr();" data-toggle='modal' data-target='#modal_det_iframe'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Vendedor</a>
<hr>
	<table class="table table-striped table-bordered display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Vendedor</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Comisión</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT usu.*,ven.* FROM (th001_usuario AS usu INNER JOIN tg002_vendedor AS ven ON usu.co_usuario=ven.co_usuario)";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {
				
				$estructura.="
					<tr>
						<td>".$row['nb_vendedor']."</td>
						<td>".$row['nb_usuario']."</td>
						<td>".$row['nu_telefono']."</td>
						<td>".number_format($row['nu_comision'],2,",",".")."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='".$row['nb_vendedor']."' href='javaScript:;' onclick=\"modal_ver(".$row['co_vendedor'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver y Editar</a></li><li><a data-title='Escribir a: ".$row['nb_vendedor']."' href='javaScript:;' onclick=\"modal_msj(".$row['co_vendedor'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Escribir</a></li><li class='divider'></li><li><a href='#' onclick=\"bloquear(".$row['co_vendedor'].");\">Bloquear</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear(".$row['co_vendedor'].");\">Desbloquear</button>";
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
                    columns: [0,1,2,3]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3]
                },
				title:'Vendedores'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3]
                },
				title:'Vendedores',
				pageSize: 'letter',				
            },
			{
                extend: 'print',
				text: 'Imprimir',
				title:'Vendedores',
				//autoPrint: false,
                exportOptions: {
                    columns: [0,1,2,3]
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
                    columns: [0,1,2,3]
                }
            }			
		],
	columnDefs: [
	{
		orderable: false,
		targets:   [4]
	}],
    });
});
function modal_agr() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_vendedor.php' );
};
function modal_ver(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_vendedor.php?id='+id);
};
function modal_msj(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/escribir_mensaje.php?id='+id+'&opc=vendedor');
};
	
//Dialog
function bloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este vendedor?',
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
								url:   '../../funciones_ajax/bloquear_vendedores.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/vendedores.php','cont');
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
            message: '¿Seguro desea desbloquear este vendedor?',
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
								url:   '../../funciones_ajax/desbloquear_vendedores.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/vendedores.php','cont');
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