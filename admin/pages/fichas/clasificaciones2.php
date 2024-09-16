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
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Categorias</strong>
  <a href="#" class="btn btn-default modalButtonagregar btn-sm pull-right" data-src='fichas/agregar_categorias.php' data-toggle='modal' data-target='#modal_editar_iframe' data-height='150px' data-width='100%'>Agregar Categoria</a></div>
  <div class="panel-body">
	<table id="example" class="table table-striped table-bordered calificaciones" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Categorías</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT * FROM tg007_categoria";
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
									<li><a class='modalButtoncat' data-height='150px' href='javaScript:;' onclick=\"modal_cat(".$row['co_categoria'].");\" data-toggle='modal' data-target='#modal_editar_iframe'>Ver y Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_cat(".$row['co_categoria'].");\">Bloquear</a></li>
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
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Lineas</strong><a href="#" class="btn btn-default modalButtonagregar btn-sm pull-right" data-src='fichas/agregar_linea.php' data-toggle='modal' data-target='#modal_editar_iframe' data-height='230px' data-width='100%'>Agregar Línea</a></div>
  <div class="panel-body">
	<table id="example" class="table table-striped table-bordered calificaciones" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Categoría</th>
                <th>Lineas</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT lin.*,cat.nb_categoria FROM tg008_linea AS lin INNER JOIN tg007_categoria AS cat ON lin.co_categoria=cat.co_categoria";
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
									<li><a class='modalButtonlin' data-height='230px' href='javaScript:;' onclick=\"modal_lin(".$row['co_linea'].");\" data-toggle='modal' data-target='#modal_editar_iframe'>Ver y Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_lin(".$row['co_linea'].");\">Bloquear</a></li>
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
<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading"><strong>Sub-lineas</strong><a href="#" class="btn btn-default modalButtonagregar btn-sm pull-right" data-src='fichas/agregar_sublinea.php' data-toggle='modal' data-target='#modal_editar_iframe' data-height='230px' data-width='100%'>Agregar Sub-linea</a></div>
  <div class="panel-body">   
	<table id="example" class="table table-striped table-bordered calificaciones" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Linea</th>
                <th>Sub-linea</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT slin.*,lin.nb_linea FROM tg009_sublineas AS slin INNER JOIN tg008_linea AS lin ON slin.co_linea=lin.co_linea";
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
									<li><a class='modalButtonsub' data-height='230px' href='javaScript:;' onclick=\"modal_sublin(".$row['co_sublineas'].");\" data-toggle='modal' data-target='#modal_editar_iframe'>Ver y Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_slin(".$row['co_sublineas'].");\">Bloquear</a></li>
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
    <div class="col-md-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Division 1</strong><a href="#" class="btn btn-default modalButtonagregar btn-sm pull-right" data-src='fichas/agregar_division.php' data-toggle='modal' data-target='#modal_editar_iframe' data-height='230px' data-width='100%'>Agregar División</a></div>
  <div class="panel-body">
	<table id="example" class="table table-striped table-bordered calificaciones" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Sub-linea</th>
                <th>División 1</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT divi.*,slin.nb_sublineas FROM tg010_division AS divi INNER JOIN `tg009_sublineas` AS slin ON divi.co_sublineas=slin.co_sublineas";
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
									<li><a class='modalButtondiv1' data-height='230px' href='javaScript:;' onclick=\"modal_div1(".$row['co_division'].");\" data-toggle='modal' data-target='#modal_editar_iframe'>Ver y Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_div(".$row['co_division'].");\">Bloquear</a></li>
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
<div class="col-md-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Division 2</strong><a href="#" class="btn btn-default modalButtonagregar btn-sm pull-right" data-src='fichas/agregar_division2.php' data-toggle='modal' data-target='#modal_editar_iframe' data-height='230px' data-width='100%'>Agregar División 2</a></div>
  <div class="panel-body">
	<table id="example" class="table table-striped table-bordered calificaciones" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>División 1</th>
                <th>Division 2</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT divi2.*,div1.nb_division FROM tg011_division2 AS divi2 INNER JOIN tg010_division AS div1 ON divi2.co_division=div1.co_division";
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
									<li><a class='modalButtondiv2' data-height='230px' href='javaScript:;' onclick=\"modal_div2(".$row['co_division2'].");\" data-toggle='modal' data-target='#modal_editar_iframe'>Ver y Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_div2(".$row['co_division2'].");\">Bloquear</a></li>
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
<div class="col-md-12">
  <div class="panel panel-default">
  <div class="panel-heading"><strong>Division 3</strong><a href="#" class="btn btn-default modalButtonagregar btn-sm pull-right" data-src='fichas/agregar_division3.php' data-toggle='modal' data-target='#modal_editar_iframe' data-height='230px' data-width='100%'>Agregar División 3</a></div>
  <div class="panel-body">
	<table id="example" class="table table-striped table-bordered calificaciones" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>División 2</th>
                <th>División 3</th>
                <th></th>
            </tr>
        </thead> 
        <tbody>
        <?php
				$sql="SELECT divi3.*,div2.nb_division2 FROM tg012_division3 AS divi3 INNER JOIN `tg011_division2` AS div2 ON divi3.co_division2=div2.co_division2";
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
									<li><a class='modalButtondiv3' data-height='230px' href='javaScript:;' onclick=\"modal_div3(".$row['co_division3'].");\" data-toggle='modal' data-target='#modal_editar_iframe'>Ver y Editar</a></li>
									<li class='divider'></li>
									<li><a href='#' onclick=\"bloquear_div3(".$row['co_division3'].");\">Bloquear</a></li>
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
<!-- MODAL --> 
<div class="modal fade" id="modal_editar_iframe" name="modal_editar_iframe" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
         <div class="modal-content">
			<div class='modal-header'>
             	<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            	<h4 class='modal-title' id='myModalLabel'>Editar / Agregar Clasificación</h4>
			</div>
            <div id="loadImg"><div class="modal-body"><p class="text-center"><i class="fa fa-refresh fa-spin fa-4x"></i></p></div></div>
        	<iframe id="ventana" frameborder="0" width="100%"></iframe>
        </div>
    </div>
</div>
<!--HASTA AQUI LA MODAL-->
<script type="text/javascript">
$(document).ready(function() { $('.calificaciones').dataTable();
		$('body').on('hidden.bs.modal', function (e) {
			$('.modal-content #ventana').attr('src', "");
			document.getElementById('loadImg').style.display='block';
			//alert('limpio');
 		});
});
function modal_cat(id) {
	//alert(id);
	document.getElementById('loadImg').style.display='block';
	var height = document.querySelector("a[class=modalButtoncat]").getAttribute("data-height");
	$("#modal_editar_iframe iframe").attr({'src':'fichas/editar_categorias.php?id='+id,
		'height': height});
}
function modal_lin(id) {
	//alert(id);
	document.getElementById('loadImg').style.display='block';
	var height = document.querySelector("a[class=modalButtonlin]").getAttribute("data-height");
	$("#modal_editar_iframe iframe").attr({'src':'fichas/editar_linea.php?id='+id,
		'height': height});
}
function modal_sublin(id) {
	//alert(id);
	document.getElementById('loadImg').style.display='block';
	var height = document.querySelector("a[class=modalButtonsub]").getAttribute("data-height");
	$("#modal_editar_iframe iframe").attr({'src':'fichas/editar_sublinea.php?id='+id,
		'height': height});
}
function modal_div1(id) {
	//alert(id);
	document.getElementById('loadImg').style.display='block';
	var height = document.querySelector("a[class=modalButtondiv1]").getAttribute("data-height");
	$("#modal_editar_iframe iframe").attr({'src':'fichas/editar_division.php?id='+id,
		'height': height});
}
function modal_div2(id) {
	//alert(id);
	document.getElementById('loadImg').style.display='block';
	var height = document.querySelector("a[class=modalButtondiv2]").getAttribute("data-height");
	$("#modal_editar_iframe iframe").attr({'src':'fichas/editar_division2.php?id='+id,
		'height': height});
}
function modal_div3(id) {
	//alert(id);
	document.getElementById('loadImg').style.display='block';
	var height = document.querySelector("a[class=modalButtondiv3]").getAttribute("data-height");
	$("#modal_editar_iframe iframe").attr({'src':'fichas/editar_division3.php?id='+id,
		'height': height});
}
$('a.modalButtonagregar').on('click', function(e) {
	var src = $(this).attr('data-src');
	var height = $(this).attr('data-height');
	var width = $(this).attr('data-width');
	
	$("#modal_editar_iframe iframe").attr({'src':src,
						'height': height,
						'width': width});
});
//FUNCIONES DE BLOQUEO Y DESBLOQUEO CATEGORIAS
function bloquear_cat(id) {
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


</script>
</body>
</html>