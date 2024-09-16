<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
	include ("../../../funciones/funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Transporte</title>
</head>
<body>
<div class="container-fluid"><!--CUERPO DE LA PAGINA-->
<h3>Transporte <a class="btn btn-success btn-sm pull-rigth" data-title='Nuevo Transporte' href='javaScript:;' onclick="modal_agregar_transporte();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Transporte</a></h3>
<hr>
	<table class="table table-striped table-bordered display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Teléfono</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT * FROM tg014_transporte";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {
				
				$originalDate = $row['fe_registro'];
				$newDate = date("m/d/Y", strtotime($originalDate));
				$fecha= traducefecha($newDate);
					
				$estructura.="
					<tr>
						<td>".$row['nb_transporte']."</td>
						<td>".$row['tx_descripcion']."</td>
						<td>".$row['nu_telefono']."</td>
						<td>
							";
						
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Editar ".$row['nb_transporte']."' data-height='280px' href='javaScript:;' onclick=\"modal_transporte(".$row['co_transporte'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a>
									<li class='divider'></li>";
									
				if ($row['in_estatus']=="1"){
					$estructura.="<li><a href='#' onclick=\"bloquear(".$row['co_transporte'].");\">Bloquear</a></li>";	
				}else{
					$estructura.="<li><a href='#' onclick=\"desbloquear(".$row['co_transporte'].");\">Desbloquear</a></li>";
				}

				$estructura.="
								</ul>
							</div>
						</td>
					</tr>";
				}
				echo $estructura;
		?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#page-loader').fadeOut(500);
	var tituloexport= "Listado de Transportes";
	var columns= [0,1,2];
	var logo="<img src='http://<?php echo $_SERVER['HTTP_HOST']; ?>/transporte/img/logo-transporte.jpg' width='300' height='100'/>"
	var logo64=''
	var table = $('table.display').DataTable({
		"dom": '<"col-sm-4 col-xs-12"l><"col-sm-4 col-xs-12"f><"col-sm-4 col-xs-12"i>rt<"col-sm-4 col-xs-12 text-center"B><"col-sm-8 col-xs-12"p><"clearfix">',
		language:{
            "sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron registros",
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
				className: 'btn-sm',
                exportOptions: {
                    columns: columns
                }
            },
            {
                extend: 'excelHtml5',
				className: 'btn-sm',
                exportOptions: {
                    columns: columns
                },
				title: tituloexport
            },
            {
                extend: 'pdfHtml5',
				className: 'btn-sm',
                exportOptions: {
                    columns: columns
                },
				title:tituloexport,
				pageSize: 'letter',
				customize: function ( doc ) {
					// Splice the image in after the header, but before the table
					doc.content.splice( 0, 0, {
						//margin: [ 0, 0, 0, 0 ],
						alignment: 'left',
						image: logo64,
						fit: [100, 100]
					} );
                // Data URL generated by http://dataurl.net/#dataurlmaker
            }				
            },
			{
                extend: 'print',
				className: 'btn-sm',
				text: 'Imprimir',
				title:tituloexport,
				pageSize: 'letter',
				//autoPrint: false,
                exportOptions: {
                    columns: columns
                },
				customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
						.css( 'margin-top', '0' )
						.prepend(
                            '<table><tbody><tr><td>'+logo+'</td></tr></tbody></table>'
                        );
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
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
function modal_agregar_transporte() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_transporte.php' );
};
function modal_transporte(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_transporte.php?id='+id);
};
//Dialog
function bloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este transporte?',
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
								url:   '../../funciones_ajax/bloquear_transporte.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/transporte.php','cont');
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

//Dialog
function desbloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear este transporte?',
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
								url:   '../../funciones_ajax/desbloquear_transporte.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/transporte.php','cont');
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