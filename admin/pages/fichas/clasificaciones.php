<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clasificaciones</title>
</head>
<body>
<div class="container-fluid"><!--CUERPO DE LA PAGINA-->
<div id="funciones"></div>
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Categorias</strong>
  <a class="btn btn-default btn-sm pull-right" data-title='Nueva Categoría' href='javaScript:;' onclick="modal_agr_cat();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Categoría</a>
  </div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display" cellspacing="0" width="100%" data-titulo="prueba">
        <thead>
            <tr>
                <th>Categorías</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT * FROM tg007_categoria WHERE in_eliminar='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura.="
					<tr>
						<td>".$row['nb_categoria']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver / Editar ".$row['nb_categoria']."' data-height='150px' href='javaScript:;' onclick=\"modal_ed(".$row['co_categoria'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_cat(".$row['co_categoria'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar_cat(".$row['co_categoria'].");\">Eliminar</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_cat(".$row['co_categoria'].");\">Desbloquear</button>";
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
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Lineas</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva Línea' href='javaScript:;' onclick="modal_agr_lin();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Líneas</a></a></div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display2" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Categoría</th>
                <th>Lineas</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT lin.*,cat.nb_categoria FROM tg008_linea AS lin INNER JOIN tg007_categoria AS cat ON lin.co_categoria=cat.co_categoria WHERE lin.in_eliminar='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura2.="
					<tr>
						<td>".$row['nb_categoria']."</td>
						<td>".$row['nb_linea']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura2.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nb_linea']."' data-height='250px' href='javaScript:;' onclick=\"modal_edt_lin(".$row['co_linea'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_lin(".$row['co_linea'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar_lin(".$row['co_linea'].");\">Eliminar</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura2.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_lin(".$row['co_linea'].");\">Desbloquear</button>";
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
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Sub-lineas</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva Sub-línea' data-target='#modal_det_iframe' href='javaScript:;' onclick="modal_agr_sublin();" data-toggle='modal'><i class="fa fa-plus-circle" aria-hidden="true"></i> Sub-línea</a></div>
  <div class="panel-body">   
	<table class="table table-striped table-bordered display2" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Linea</th>
                <th>Sub-linea</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT slin.*,lin.nb_linea FROM tg009_sublineas AS slin INNER JOIN tg008_linea AS lin ON slin.co_linea=lin.co_linea WHERE slin.in_eliminar='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura3.="
					<tr>
						<td>".$row['nb_linea']."</td>
						<td>".$row['nb_sublineas']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura3.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nb_sublineas']."' data-height='150px' href='javaScript:;' onclick=\"modal_edt_sublin(".$row['co_sublineas'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_slin(".$row['co_sublineas'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar_slin(".$row['co_sublineas'].");\">Eliminar</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura3.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_slin(".$row['co_sublineas'].");\">Desbloquear</button>";
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
<!--DIVISION 1-->
    <div class="col-lg-6 col-md-6 col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Division 1</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva división 1' href='javaScript:;' onclick="modal_agr_div1();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> Divisíon 1</a></div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display2" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Sub-linea</th>
                <th>División 1</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT divi.*,slin.nb_sublineas FROM tg010_division AS divi INNER JOIN tg009_sublineas AS slin ON divi.co_sublineas=slin.co_sublineas WHERE divi.in_eliminar='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura4.="
					<tr>
						<td>".$row['nb_sublineas']."</td>
						<td>".$row['nb_division']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura4.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nb_division']."' data-height='150px' href='javaScript:;' onclick=\"modal_edt_div1(".$row['co_division'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_div(".$row['co_division'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar_div(".$row['co_division'].");\">Eliminar</a></li>
								</ul>
							</div>
					";
				}else{
					$estructura4.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_div(".$row['co_division'].");\">Desbloquear</button>";
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
<!--DIVISION 2--><!--DIVISION 2--><!--DIVISION 2-->
<div class="col-lg-6 col-md-6 col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Division 2</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva división 2' href='javaScript:;' onclick="modal_agr_div2();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> División 2</a></div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display2" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>División 1</th>
                <th>Division 2</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT divi2.*,div1.nb_division FROM tg011_division2 AS divi2 INNER JOIN tg010_division AS div1 ON divi2.co_division=div1.co_division WHERE divi2.in_eliminar='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura5.="
					<tr>
						<td>".$row['nb_division']."</td>
						<td>".$row['nb_division2']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura5.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nb_division2']."' onclick=\"modal_edt_div2(".$row['co_division2'].");\" data-height='150px' href='javaScript:;'  data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_div2(".$row['co_division2'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar_div2(".$row['co_division2'].");\">Eliminar</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura5.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_div2(".$row['co_division2'].");\">Desbloquear</button>";
				}
				
				$estructura5.="
						</td>
					</tr>";
				}
				echo $estructura5;
		?>
        </tbody>
    </table>
    	</div>
    </div>
</div>
<!--DIVISION 3--><!--DIVISION 3--><!--DIVISION 3--><!--DIVISION 3-->
<div class="col-lg-6 col-md-6 col-sm-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Division 3</strong><a class="btn btn-default btn-sm pull-right" data-title='Nueva división 3' href='javaScript:;' onclick="modal_agr_div3();" data-toggle='modal' data-target='#modal_det_iframe'><i class="fa fa-plus-circle" aria-hidden="true"></i> División 3</a></div>
  <div class="panel-body">
	<table class="table table-striped table-bordered display2" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>División 2</th>
                <th>División 3</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT divi3.*,div2.nb_division2 FROM tg012_division3 AS divi3 INNER JOIN tg011_division2 AS div2 ON divi3.co_division2=div2.co_division2 WHERE divi3.in_eliminar='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura6.="
					<tr>
						<td>".$row['nb_division2']."</td>
						<td>".$row['nb_division3']."</td>
						<td>
							";
						
				if ($row['in_estatus']=="1"){
					$estructura6.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver o Editar ".$row['nb_division3']."' data-height='150px' href='javaScript:;' onclick=\"modal_edt_div3(".$row['co_division3'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver o Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_div3(".$row['co_division3'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar_div3(".$row['co_division3'].");\">Eliminar</a></li>
								</ul>
							</div>
					";	
				}else{
					$estructura6.="<button type='button' class='btn btn-warning' onclick=\"desbloquear_div3(".$row['co_division3'].");\">Desbloquear</button>";
				}
				
				$estructura6.="
						</td>
					</tr>";
				}
				echo $estructura6;
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
	var tituloexport= "Listado de Clasificaciones";
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
});
function modal_agr_cat() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_categorias.php' );
};
function modal_agr_lin() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_linea.php' );
};
function modal_agr_sublin() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_sublinea.php' );
};
function modal_agr_div1() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_division.php' );
};
function modal_agr_div2() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_division2.php' );
};
function modal_agr_div3() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_division3.php' );
};
function modal_ed(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_categorias.php?id='+id);
};
function modal_edt_lin(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_linea.php?id='+id);
};
function modal_edt_sublin(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_sublinea.php?id='+id);
};
function modal_edt_div1(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_division.php?id='+id);
};
function modal_edt_div2(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_division2.php?id='+id);
};
function modal_edt_div3(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'fichas/editar_division3.php?id='+id);
};
//FUNCIONES DE BLOQUEO Y DESBLOQUEO CATEGORIAS
function bloquear_cat(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear esta categoría?',
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
								url:   '../../funciones_ajax/bloquear_categorias.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function desbloquear_cat(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear esta categoria?',
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
								url:   '../../funciones_ajax/desbloquear_categorias.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function bloquear_lin(id) {
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
								url:   '../../funciones_ajax/bloquear_lineas.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function desbloquear_lin(id) {
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
								url:   '../../funciones_ajax/desbloquear_lineas.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function bloquear_slin(id) {
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
								url:   '../../funciones_ajax/bloquear_slineas.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function desbloquear_slin(id) {
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
								url:   '../../funciones_ajax/desbloquear_slineas.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function bloquear_div(id) {
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
								url:   '../../funciones_ajax/bloquear_division.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function desbloquear_div(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear esta Division?',
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
								url:   '../../funciones_ajax/desbloquear_division.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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

//FUNCIONES DE BLOQUEO Y DESBLOQUEO DIVISIONES 2
function bloquear_div2(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear esta Division?',
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
								url:   '../../funciones_ajax/bloquear_division2.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function desbloquear_div2(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear esta Division?',
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
								url:   '../../funciones_ajax/desbloquear_division2.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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

//FUNCIONES DE BLOQUEO Y DESBLOQUEO DIVISIONES 3
function bloquear_div3(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear esta Division?',
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
								url:   '../../funciones_ajax/bloquear_division3.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
function desbloquear_div3(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear la Division?',
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
								url:   '../../funciones_ajax/desbloquear_division3.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
	
///ELIMINAR PRODUCTOS
function eliminar_cat(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar esta clasificación?, Recuerde que borrara todos los elementos menores a esta clasificacion y los productos que se encuentren clasificados entre ellos',
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
								url:   '../../funciones_ajax/eliminar_clasificaciones.php?opc=cat&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
	
function eliminar_lin(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar esta clasificación?, Recuerde que borrara todos los elementos menores a esta clasificacion y los productos que se encuentren clasificados entre ellos',
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
								url:   '../../funciones_ajax/eliminar_clasificaciones.php?opc=lin&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
	
function eliminar_slin(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar esta clasificación?, Recuerde que borrara todos los elementos menores a esta clasificacion y los productos que se encuentren clasificados entre ellos',
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
								url:   '../../funciones_ajax/eliminar_clasificaciones.php?opc=slin&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
	
function eliminar_div(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar esta clasificación?, Recuerde que borrara todos los elementos menores a esta clasificacion y los productos que se encuentren clasificados entre ellos',
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
								url:   '../../funciones_ajax/eliminar_clasificaciones.php?opc=div&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
	
function eliminar_div2(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar esta clasificación?, Recuerde que borrara todos los elementos menores a esta clasificacion y los productos que se encuentren clasificados entre ellos',
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
								url:   '../../funciones_ajax/eliminar_clasificaciones.php?opc=div2&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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
	
function eliminar_div3(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Confirmación',
            message: '¿Seguro desea Eliminar esta clasificación?, Recuerde que borrara todos los elementos menores a esta clasificacion y los productos que se encuentren clasificados entre ellos',
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
								url:   '../../funciones_ajax/eliminar_clasificaciones.php?opc=div3&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('fichas/clasificaciones.php','cont');
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