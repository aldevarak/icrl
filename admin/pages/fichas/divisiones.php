<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Divisiones</title>
</head>
<body>
<div class="container-fluid"><!--CUERPO DE LA PAGINA-->
<div id="funciones"></div>
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Categoria</strong>
  <a class="btn btn-default btn-sm pull-right" data-title='Nueva Categoria' href='javaScript:;' onclick="modal_agr_marca();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Categoria</a>
  </div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display" cellspacing="0" width="100%" data-titulo="prueba">
        <thead>
            <tr>
                <th>Categoria</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT * FROM tg015_marca";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura.="
					<tr>
						<td>".$row['nb_marca']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver / Editar ".$row['nb_marca']."' data-height='150px' href='javaScript:;' onclick=\"modal_ed(".$row['co_marca'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_marca(".$row['co_marca'].");\">Bloquear</a></li>
									
								</ul>
							</div>
					";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_marca(".$row['co_marca'].");\">Desbloquear</button>";
				}
				
				$estructura.="
						</td>
					</tr>";
				}
				echo $estructura;
		?>
        </tbody>
    </table>
    	</div>
    </div>
</div>
<!--/*MODELO*/--><!--/*MODELO*/--><!--/*MODELO*/--><!--/*MODELO*/--><!--/*MODELO*/--><!--/*MODELO*/-->
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Linea</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva Linea' href='javaScript:;' onclick="modal_agr_mod();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Linea</a></a></div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display2" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Categoria</th>
                <th>Linea</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT modelo.*,marca.nb_marca FROM tg016_modelo AS modelo INNER JOIN tg015_marca AS marca ON marca.co_marca=modelo.co_marca";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura2.="
					<tr>
						<td>".$row['nb_marca']."</td>
						<td>".$row['nb_modelo']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura2.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nb_modelo']."' data-height='250px' href='javaScript:;' onclick=\"modal_edt_mod(".$row['co_modelo'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_mod(".$row['co_modelo'].");\">Bloquear</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura2.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_mod(".$row['co_linea'].");\">Desbloquear</button>";
				}
				
				$estructura2.="
						</td>
					</tr>";
				}
				echo $estructura2;
		?>
        </tbody>
    </table>
    	</div>
    </div>
</div>

<!--AÑO--><!--AÑO--><!--AÑO--><!--AÑO--><!--AÑO--><!--AÑO--><!--AÑO--><!--AÑO--><!--AÑO-->
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Marca</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva Marca' data-target='#modal_det_iframe' href='javaScript:;' onclick="modal_agr_ano();" data-toggle='modal'><i class="fa fa-plus-circle" aria-hidden="true"></i> Marca</a></div>
  <div class="panel-body">   
	<table class="table table-striped table-bordered display3" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Linea</th>
                <th>Marca</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT ano.*,modelo.nb_modelo FROM tg017_ano AS ano INNER JOIN tg016_modelo AS modelo ON modelo.co_modelo=ano.co_modelo";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura3.="
					<tr>
						<td>".$row['nb_modelo']."</td>
						<td>".$row['nu_ano']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura3.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nu_ano']."' data-height='150px' href='javaScript:;' onclick=\"modal_edt_ano(".$row['co_ano'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_ano(".$row['co_ano'].");\">Bloquear</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura3.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_ano(".$row['co_ano'].");\">Desbloquear</button>";
				}
				
				$estructura3.="
						</td>
					</tr>";
				}
				echo $estructura3;
		?>
        </tbody>
    </table>
    	</div>
    </div>
</div>

<!--Posicion--><!--Posicion--><!--Posicion--><!--Posicion--><!--Posicion--><!--Posicion--><!--Posicion-->
    <div class="col-lg-6 col-md-6 col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Color</strong><a class="btn btn-default btn-sm pull-right" data-title='Nuevo Color' href='javaScript:;' onclick="modal_agr_pos();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Color</a></div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display4" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Linea</th>
            	<th>Marca</th>
                <th>Color</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql11="SELECT pos.*,ano.nu_ano,modelo.nb_modelo FROM ((tg018_tp_pastilla AS pos INNER JOIN tg017_ano AS ano ON pos.co_ano=ano.co_ano) INNER JOIN tg016_modelo AS modelo ON ano.co_modelo=modelo.co_modelo)";
				$res11=mysqli_query($link,$sql11);
				
				while ($row3 = mysqli_fetch_array($res11)) {

				$estructura4.="
					<tr>
						<td>".$row3['nb_modelo']."</td>
						<td>".$row3['nu_ano']."</td>
						<td>".$row3['nb_tp_pastilla']."</td>
						<td>";
						
				if ($row3['in_estatus']=="1"){
					$estructura4.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row3['nb_tp_pastilla']."' data-height='150px' href='javaScript:;' onclick=\"modal_edt_pos(".$row3['co_tp_pastilla'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_pos(".$row3['co_tp_pastilla'].");\">Bloquear</a></li>
								</ul>
							</div>
					";
				}else{
					$estructura4.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_pos(".$row3['co_tp_pastilla'].");\">Desbloquear</button>";
				}
				
				$estructura4.="
						</td>
					</tr>";
				}
				echo $estructura4;
		?>
        </tbody>
    </table>
    	</div>
    </div>
</div>


</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#page-loader').fadeOut(500);
	var tituloexport= "Listado de Divisiones";
	var columns= [0];
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
			targets:   [1]
		}],
    });
	//TABLA 2
	var columns2= [0,1];
	var table = $('table.display2').DataTable({
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
                    columns: columns2
                }
            },
            {
                extend: 'excelHtml5',
				className: 'btn-sm',
                exportOptions: {
                    columns: columns2
                },
				title: tituloexport
            },
            {
                extend: 'pdfHtml5',
				className: 'btn-sm',
                exportOptions: {
                    columns: columns2
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
                    columns: columns2
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
			targets:   [1]
		}],
    });
	
	//tabla3
	var table = $('table.display3').DataTable({
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
			targets:   [1]
		}],
    });
	
	//tabla4
	var table = $('table.display4').DataTable({
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
			targets:   [1]
		}],
    });
	
});


function modal_agr_marca() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_marcas.php' );
};
function modal_ed(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_marcas.php?id='+id);
};

function modal_agr_mod() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_modelo.php' );
};
function modal_edt_mod(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_modelo.php?id='+id);
};

function modal_agr_ano() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_ano.php' );
};
function modal_edt_ano(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_ano.php?id='+id);
};

function modal_agr_pos() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_posicion.php' );
};
function modal_edt_pos(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_posicion.php?id='+id);
};

//FUNCIONES DE BLOQUEO Y DESBLOQUEO CATEGORIAS
function bloquear_marca(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear esta Marca?',
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
								url:   '../../funciones_ajax/bloquear_marcas.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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
function desbloquear_marca(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear esta Marca?',
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
								url:   '../../funciones_ajax/desbloquear_marcas.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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

//FUNCIONES DE BLOQUEO Y DESBLOQUEO LINEAS
function bloquear_mod(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este Modelo?',
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
								url:   '../../funciones_ajax/bloquear_modelo.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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
function desbloquear_mod(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear este Modelo?',
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
								url:   '../../funciones_ajax/desbloquear_modelo.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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

//FUNCIONES DE BLOQUEO Y DESBLOQUEO SUB-LINEAS
function bloquear_ano(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este Año?',
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
								url:   '../../funciones_ajax/bloquear_ano.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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
function desbloquear_ano(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear este Años?',
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
								url:   '../../funciones_ajax/desbloquear_ano.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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

//FUNCIONES DE BLOQUEO Y DESBLOQUEO DIVISIONES
function bloquear_pos(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear esta Posición?',
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
								url:   '../../funciones_ajax/bloquear_posicion.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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
function desbloquear_pos(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear esta Posición?',
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
								url:   '../../funciones_ajax/desbloquear_posicion.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/divisiones.php','cont');
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