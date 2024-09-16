<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['btn_enviar'])){
	$sql3="INSERT INTO tg013_productos (co_categoria,co_linea,co_sublineas,co_division,co_division2,co_division3,nb_productos,tx_descripcion,tx_descripcion_web,nu_stock,nu_precio1,nu_precio2,nu_precio3,nu_precio4,nu_precio5,fe_ini_p5,fe_fin_p5,nu_hits,in_destacado,in_oferta,in_bloqueado,in_estatus) VALUES (".$_POST['co_categoria'].",".$_POST['co_linea'].",".$_POST['co_sublineas'].",".$_POST['co_division'].",".$_POST['co_division2'].",".$_POST['co_division3'].",'".$_POST['nb_productos']."','".$_POST['tx_descripcion']."',NULL,'".$_POST['nu_stock']."','".$_POST['nu_precio1']."','".$_POST['nu_precio2']."','".$_POST['nu_precio3']."','".$_POST['nu_precio4']."','".$_POST['nu_precio5']."',NULL,NULL,0,0,0,0,1)";
	mysqli_query($link,$sql3);
	
	//echo $sql3;
	echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_agregar_iframe').modal('hide');parent.parent.parent.cambio('fichas/productos.php','cont');</script>";	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Producto</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/upload/fileinput.css">
<link rel="stylesheet" type="text/css" href="../../../css/select/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="../../../css/select/ajax-bootstrap-select.css">
<style type="text/css">
.modal-footer{
	padding-bottom:0;
	margin-bottom:0;
}
</style>

<script type="text/javascript" src="../../js/ajax_combos.js"></script>

</head>

<body>
<form method="post" id="frm_agregar" name="frm_agregar" action="agregar_producto.php">
<div class="modal-body">
      <div class="form-group col-xs-6">
        <label for="nb_productos">Nombre del Producto</label>
        <input type="text" class="form-control" id="nb_productos" name="nb_productos" placeholder="Producto" required>
      </div>
      <div class='form-group col-xs-12'>
          <label>Nombre de Categoria</label>
                <select class="selectpicker" id='co_categoria' name='co_categoria' data-live-search='true' onchange="load(this.value);" title="Por favor seleccione una Categoria">
                  <option value="0">Seleccione</option>
                  <?php
				  	$sql10="SELECT * FROM tg007_categoria WHERE in_estatus='1' ORDER BY nb_categoria";
					$result10 = mysqli_query($link,$sql10);//para categoria 1
					while ($row10 = mysqli_fetch_array($result10)) {
						$opcion_cat.= '<option value="'.$row10['co_categoria'].'" ';
						if ($cod['co_categoria']==$row10['co_categoria']){ $opcion_cat.= 'selected';}
							$opcion_cat.= ' >'.$row10['nb_categoria'].'</option>';	
					}
					echo $opcion_cat;
				  ?>
                </select>
      </div>
      
      <!--LINEAS--><!--LINEAS--><!--LINEAS--><!--LINEAS--><!--LINEAS--><!--LINEAS--><!--LINEAS-->
      <div class="form-group col-xs-12" id="co_linea1">
	      <label>Nombre de Linea</label>
          <select class="selectpicker" id='co_linea' name='co_linea' data-live-search='true'>
            <option value="">Aun no puede seleccionar una Linea</option>
          </select>
      </div>
      <!--SUB-LINEAS--><!--SUB-LINEAS--><!--SUB-LINEAS--><!--SUB-LINEAS--><!--SUB-LINEAS-->
      <div class="form-group col-xs-12" id="co_sublineas1">
          <label>Nombre de Sub-Linea</label>
          <select class="selectpicker" id='co_sublineas' name='co_sublineas' data-live-search='true'>
              <option value='Aun no puede seleccionar una Sub-Linea'></option>
          </select>
      </div>
      <!--DIVISION 1--><!--DIVISION 1--><!--DIVISION 1--><!--DIVISION 1--><!--DIVISION 1--><!--DIVISION 1-->
      <div class="form-group col-xs-12" id="co_division1">
          <label>Nombre de división:</label>
          <select class="selectpicker" id='co_division' name='co_division' data-live-search='true'>
              <option value='Aun no puede seleccionar una Division'></option>
          </select>
      </div>
      <!--DIVISION 2--><!--DIVISION 2--><!--DIVISION 2--><!--DIVISION 2--><!--DIVISION 2--><!--DIVISION 2-->
      <div class="form-group col-xs-12" id="co_division2">
          <label>Nombre de división 2:</label>
          <select class="selectpicker" id='co_division2' name='co_division2' data-live-search='true'>
              <option value='Aun no puede seleccionar una Division'></option>
          </select>
      </div>
      <!--DIVISION 3--><!--DIVISION 3--><!--DIVISION 3--><!--DIVISION 3--><!--DIVISION 3--><!--DIVISION 3-->
      <div class="form-group col-xs-12" id="co_division3">
          <label>Nombre de división 3:</label>
          <select class="selectpicker" id='co_division3' name='co_division3' data-live-search='true'>
              <option value='Aun no puede seleccionar una Division 3'></option>
          </select>
      </div>
      
      <div class="form-group col-xs-12">
        <label for="tx_descripcion">Descripción:</label>
        <textarea class="form-control" rows="3" id="tx_descripcion" name="tx_descripcion"></textarea>
      </div>
          <div class="clearfix"></div>
          <hr>
          
       <div class="form-group col-xs-4">
        <label for="nu_stock">Stock</label>
          <input type="text" class="form-control" id="nu_stock" name="nu_stock" aria-describedby="basic-addon1">
      </div>
      
      <h4>Sección de Precios </h4>
      <div class="form-group col-xs-4">
        <label for="nu_precio1">Precio 1</label>
          <input type="text" class="form-control" id="nu_precio1" name="nu_precio1" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio2">Precio 2</label>
          <input type="text" class="form-control" id="nu_precio2" name="nu_precio2" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio3">Precio 3</label>
          <input type="text" class="form-control" id="nu_precio3" name="nu_precio3" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio4">Precio 4</label>
          <input type="text" class="form-control" id="nu_precio4" name="nu_precio4" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio5">Precio 5 o Precio Oferta</label>
          <input type="text" class="form-control" id="nu_precio5" name="nu_precio5" aria-describedby="basic-addon1">
      </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary" data-dismiss="modal" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>

<script src="../../../js/jquery-1.11.1.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/upload/fileinput.min.js"></script>
<script src="../../../js/select/bootstrap-select.js"></script>
<script src="../../../js/select/ajax-bootstrap-select.min.js"></script>
<script type="text/javascript">
$('.selectpicker').selectpicker({style: 'btn-info',});
$('.modal-content #ventana').ready(function() {
	//alert('cargo');
	parent.document.getElementById('precarga').style.display='none';
});
</script>
</body>
</html>