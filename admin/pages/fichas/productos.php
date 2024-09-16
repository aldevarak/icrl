<?php 
	include ("../../../inic/dbcon.php");
	include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Productos</title>
</head>
<body>
<div class="container-fluid"><!--CUERPO DE LA PAGINA-->
<a class="btn btn-success btn-block" data-title='Agregar Producto' href='javaScript:;' onclick="modal_agr();" data-toggle='modal' data-target='#modal_det_iframe'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Producto</a>
<hr>
	<table class="table table-striped table-bordered display" cellspacing="0">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Línea</th>
                <th>Sub-linea</th>
                <th>División 1</th>
                <th>División 2</th>
                <th>División 3</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Excento</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT pro.*,cat.nb_categoria,lin.nb_linea,slin.nb_sublineas,div1.nb_division,div2.nb_division2,div3.nb_division3 FROM ((((((tg013_productos AS pro INNER JOIN tg007_categoria AS cat ON pro.co_categoria=cat.co_categoria) INNER JOIN tg008_linea AS lin ON pro.co_linea=lin.co_linea) INNER JOIN tg009_sublineas AS slin ON pro.co_sublineas=slin.co_sublineas) INNER JOIN tg010_division AS div1 ON pro.co_division=div1.co_division) INNER JOIN tg011_division2 AS div2 ON pro.co_division2=div2.co_division2) INNER JOIN tg012_division3 AS div3 ON pro.co_division3=div3.co_division3) WHERE pro.in_estatus='1'";
				$res=mysqli_query($link,$sql);
				
				while ($row = mysqli_fetch_array($res)) {

				$estructura.="
					<tr>
						<td>".$row['nb_productos']."</td>
						<td>".$row['nb_categoria']."</td>
						<td>".$row['nb_linea']."</td>
						<td>".$row['nb_sublineas']."</td>
						<td>".$row['nb_division']."</td>
						<td>".$row['nb_division2']."</td>
						<td>".$row['nb_division3']."</td>
						<td>".$row['nu_precio1']."</td>
							";
				
				if ($row['nu_stock']=="0"){
					$estructura.="<td><span class='label label-danger'>Sin Stock</span></td>";
				}else{
					$estructura.="<td>".$row['nu_stock']."</td>";
				}
				
				if ($row['in_excento']=="0"){
					$estructura.="<td>No</td>";
				}else{
					$estructura.="<td><span class='label label-danger'>Excento</span></td>";
				}
							
				$estructura.="<td>";
				
				if ($row['in_destacado']=="1"){
					$estructura.="<span class='label label-info'>Destacado</span>";
				}
				
				if ($row['in_oferta']=="1"){
					$estructura.="<span class='label label-success'>En Oferta</span>";
				}
				
				$estructura.="</td>";
						
				$estructura.="<td>";
				
				if ($row['in_bloqueado']=="0"){
					$estructura.="
							<div class='btn-group'>
								<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									Acciones <span class='caret'></span>
								</button>
								<ul class='dropdown-menu' role='menu'>
									<li><a data-title='Ver ".$row['nb_productos']."' href='javaScript:;' onclick=\"modal_produc(".$row['co_productos'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Ver</a></li>
									<li><a data-title='Galeria de ".$row['nb_productos']."' data-height='600px' href='javaScript:;' onclick=\"modal_img(".$row['co_productos'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Agregar/Editar Imagenes</a></li>
									<li><a data-title='Descripción de ".$row['nb_productos']."' data-height='340px' href='javaScript:;' onclick=\"modal_descripcion(".$row['co_productos'].");\" data-toggle='modal' data-target='#modal_det_iframe'>Editar Descripción</a></li>";
                    
					if ($row['in_oferta']=="0"){
						$estructura.="<li><a href='#' onclick=\"ofertar(".$row['co_productos'].");\">Ofertar</a></li>";
					}else{
						$estructura.="<li><a href='#' onclick=\"anu_ofertar(".$row['co_productos'].");\">Anular Ofertar</a></li>";
					}
					
					if ($row['in_destacado']=="0"){
						$estructura.="<li><a href='#' onclick=\"destacar(".$row['co_productos'].");\">Destacar</a></li>";
					}else{
						$estructura.="<li><a href='#' onclick=\"anu_destacar(".$row['co_productos'].");\">Anular Destacado</a></li>";
					}
					
					$estructura.="	<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear(".$row['co_productos'].");\">Bloquear</a></li>
									<li><a href='#' onclick=\"eliminar(".$row['co_productos'].");\">Eliminar</a></li>
								</ul>
							</div>";	
				}else{
					$estructura.="<button type='button' class='btn btn-warning' onclick=\"desbloquear(".$row['co_productos'].");\">Desbloquear</button>";
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
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                },
				title:'Productos'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                },
				title:'Productos',
				pageSize: 'letter',				
            },
			{
                extend: 'print',
				text: 'Imprimir',
				title:'Productos',
				//autoPrint: false,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
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
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                }
            }			
		],
	columnDefs: [
	{
		orderable: false,
		targets:   [11]
	}],
    });
});
function modal_agr() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_producto.php' );
}
function modal_produc(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load( 'fichas/ver_editar_producto.php?id='+id);
}
function modal_descripcion(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_descripcion.php?id='+id);
}
function modal_img(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-lg" );
	$("#modal_det_iframe #ventana").load( 'fichas/agregar_img_producto.php?id='+id);
}
/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.categoria+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.linea+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.sublinea+'</td>'+
        '</tr>'+
		'<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.division+'</td>'+
        '</tr>'+
    '</table>';
}

//OFERTAR PRODUCTO
function ofertar(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea Ofertar este producto?',
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
								url:   '../../funciones_ajax/ofertar_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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

//ANULAR OFERTAR
function anu_ofertar(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea Anular la Oferta de este producto?',
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
								url:   '../../funciones_ajax/anu_ofertar_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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

//DESTACAR PRODUCTO
function destacar(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea Destacar este producto?',
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
								url:   '../../funciones_ajax/destacar_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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

//ANULAR DESTACAR PRODUCTO
function anu_destacar(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea Anular el Destacado de este producto?',
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
								url:   '../../funciones_ajax/anu_destacar_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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

//BLOQUEAR PRODUCTO
function bloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea bloquear este producto?',
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
								url:   '../../funciones_ajax/bloquear_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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

//DESBLOQUEAR PRODUCTO
function desbloquear(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea desbloquear este producto?',
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
								url:   '../../funciones_ajax/desbloquear_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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

//ELIMINAR PRODUCTO
function eliminar(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea eliminar este producto?',
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
								url:   '../../funciones_ajax/eliminar_productos.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										cambio('../pages/fichas/productos.php','cont');
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