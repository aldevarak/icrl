<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg008_linea WHERE co_linea='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){
	$sql="UPDATE tg008_linea SET co_categoria='".$_POST['co_categoria']."',nb_linea='".$_POST['nb_linea']."' WHERE co_linea='".$id."'";
	mysqli_query($link,$sql);

	//echo $sql;
	echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/clasificaciones.php','cont');</script>";	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Linea</title>
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
</head>

<body>
<form method="post" id="frm_editar" name="frm_editar" action="editar_linea.php">
<div class="modal-body">
    <div class="form-group col-xs-12">
    <label for="">Categoria</label>
      <select id="co_categoria" name="co_categoria" class="selectpicker" data-live-search="true" title="Seleccione Categoria" data-width="100%">
      <?php
	  	$sql10="SELECT * FROM tg007_categoria WHERE in_estatus='1' ORDER BY nb_categoria";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_categoria'].'" ';
			if ($cod['co_categoria']==$row10['co_categoria']){ $opcion_1.= 'selected';}
				$opcion_1.= ' >'.$row10['nb_categoria'].'</option>';	
		}
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
      </div>
      <div class="form-group col-xs-12">
      <label for="nb_linea">Nombre</label>
      <input type="text" class="form-control" id="nb_linea" name="nb_linea" value="<?php echo $cod['nb_linea'];?>" required>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
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
$('.selectpicker').selectpicker({
      showSubtext: true
  });
$('.modal-content #ventana').ready(function() {
	//alert('cargo');
	parent.document.getElementById('precarga').style.display='none';
});
</script>
</body>
</html>