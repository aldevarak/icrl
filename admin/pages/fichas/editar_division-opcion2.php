<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

echo $id;

$result = mysqli_query($link,"SELECT * FROM tg010_division WHERE co_division='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){
	$sql="UPDATE tg010_division SET co_sublineas='".$_POST['co_sublineas']."',nb_division='".$_POST['nb_division']."' WHERE co_division='".$id."'";
	mysqli_query($link,$sql);

	echo $sql;
	//echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/clasificaciones.php','cont');/script>";	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Division</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" type="text/css" href="../../css/bootstrap/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/select/bootstrap-select.css">-->
</head>

<body>
<form method="post" id="frm_editar" name="frm_editar" action="fichas/editar_division.php">
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
    <div class="form-group col-xs-12">
    <label for="">Línea</label>
      <select id="co_sublineas" name="co_sublineas" class="selectpicker" data-live-search="true" title="Seleccione Línea" data-width="100%">
      <?php
	  	$sql10="SELECT slin.*,lin.nb_linea FROM (tg009_sublineas AS slin INNER JOIN tg008_linea AS lin ON slin.co_linea=lin.co_linea) WHERE slin.in_estatus='1' ORDER BY slin.nb_sublineas";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_sublineas'].'" ';
			if ($cod['co_sublineas']==$row10['co_sublineas']){ $opcion_1.= 'selected';}
				$opcion_1.= ' data-subtext="'.$row10['nb_linea'].'">'.$row10['nb_sublineas'].'</option>';	
		}
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
      </div>
      <div class="form-group col-xs-12">
      <label for="nb_division">Nombre</label>
      <input type="text" class="form-control" id="nb_division" name="nb_division" value="<?php echo $cod['nb_division'];?>" required>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
    </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
<a href="javascript: submitform()">Search</a>
  <button type="submit" class="btn btn-default" data-dismiss="modal" id="btn_enviar" name="btn_enviar">Enviar</button>
  <button type="button" class="btn btn-primary" onClick="parent.$('#modal_editar_iframe').modal('hide');">Cancelar</button>
</div>
</form>

<!--<script src="../../js/jquery-1.11.1.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../../js/select/bootstrap-select.js"></script>-->
<script type="text/javascript">
$('.selectpicker').selectpicker({
      showSubtext: true
  });
function submitform()
{
  document.frm_editar.submit();
}
</script>
</body>
</html>