<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
	include ("../../../funciones/funciones.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Busqueda Avanzada</title>
</head>
<body>
<a class="btn btn-success btn-block" data-title='Nueva Busqueda' href='javaScript:;' onclick="modal_agr();" data-toggle='modal' data-target='#modal_det_iframe'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Busqueda</a>
<hr>
	<table class="table table-striped table-bordered display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Posicion</th>
                <th>Producto</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT bus.*,mar.nb_marca,modelo.nb_modelo,ano.nu_ano,pos.nb_tp_pastilla,pro.nb_productos FROM (((((tr004_busqueda AS bus INNER JOIN tg015_marca AS mar ON bus.co_marca=mar.co_marca) INNER JOIN tg016_modelo AS modelo ON bus.co_modelo=modelo.co_modelo) INNER JOIN tg017_ano AS ano ON bus.co_ano=ano.co_ano) INNER JOIN tg018_tp_pastilla AS pos ON bus.co_tp_pastilla=pos.co_tp_pastilla) INNER JOIN tg013_productos AS pro ON bus.co_productos=pro.co_productos)";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {
				
				$estructura.="
					<tr>
						<td>".$row['nb_marca']."</td>
						<td>".$row['nb_modelo']."</td>
						<td>".$row['nu_ano']."</td>
						<td>".$row['nb_tp_pastilla']."</td>
						<td>".$row['nb_productos']."</td>
						<td>";
						
				if ($row['in_estatus']=="1"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='caret'></span></button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Busqueda' href='javaScript:;' onclick=\"modal_ver(".$row['co_busqueda'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver y Editar</a></li>
									<li class='divider'></li><li><a href='#' onclick=\"bloquear(".$row['co_busqueda'].");\">Bloquear</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear(".$row['co_busqueda'].");\">Desbloquear</button>";
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
		"dom": '<"col-sm-6 col-xs-12"l><"col-sm-6 col-xs-12"f>rt<"col-sm-4 col-xs-12"i><"col-sm-4 col-xs-12"i><"col-sm-4 col-xs-12"B><"col-sm-4 col-xs-12"p><"clearfix">',
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
				title:'Vendedores'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4]
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
function modal_agr() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_buscar.php' );
};
function modal_ver(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_buscar.php?id='+id);
};
	
//Dialog
function bloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear esta busqueda?',
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
								url:   '../../funciones_ajax/bloquear_buscar.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/buscar_avan.php','cont');
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
            message: '¿Seguro desea desbloquear esta Busqueda?',
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
								url:   '../../funciones_ajax/desbloquear_buscar.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/buscar_avan.php','cont');
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