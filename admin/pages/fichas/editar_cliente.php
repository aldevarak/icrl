<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT cli.*,usu.co_usuario FROM tg005_clientes AS cli INNER JOIN th001_usuario AS usu ON cli.co_usuario=usu.co_usuario WHERE co_clientes='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){
	echo $id."<br>";
	
	$sql="UPDATE tg005_clientes SET nb_clientes='".$_POST['nb_clientes']."',nu_rif_cedula='".$_POST['nu_rif_cedula']."',nu_telefono='".$_POST['nu_telefono']."',tx_direccion_fiscal='".$_POST['tx_direccion_fiscal']."',tx_direccion_entrega='".$_POST['tx_direccion_entrega']."',co_tpcliente='".$_POST['co_tpcliente']."' WHERE co_clientes='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql."<br>";
	
	if($_POST['tx_clave']!=""){
		$tx_clave=$_POST['tx_clave'];
		$clave = md5($tx_clave);
		$sql4="UPDATE th001_usuario SET tx_clave='".$clave."' WHERE co_usuario='".$cod['co_usuario']."'";
		mysqli_query($link,$sql4);
		//echo $sql4."<br>";
	}
			
	echo "<script type='text/javascript' charset='utf-8'>parent.parent.parent.location.href='../index.php';parent.parent.parent.cambio('fichas/clientes.php','cont');parent.$('#modal_editar_iframe').modal('hide');</script>";	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" type="text/css" href="../../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../../css/upload/fileinput.css">
<link rel="stylesheet" type="text/css" href="../../../css/select/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="../../../css/select/ajax-bootstrap-select.css">-->
<style type="text/css">
.modal-footer{
	padding-bottom:0;
	margin-bottom:0;
}
</style>
</head>

<body>
<form method="post" id="frm_editar" name="frm_editar" action="fichas/editar_cliente.php">
<div class="modal-body">
      <div class="form-group col-xs-12">
        <label for="nb_clientes">Nombre /Razon Social</label>
        <input type="text" class="form-control" id="nb_clientes" name="nb_clientes" placeholder="Nombre" value="<?php echo $cod['nb_clientes'];?>" required>
      </div>
      <div class="form-group col-xs-6">
        <label for="nu_rif_cedula">Cédula / R.I.F:</label>
        <input type="text" class="form-control" id="nu_rif_cedula" name="nu_rif_cedula" placeholder="J-9856984-8 o 14851222" value="<?php echo $cod['nu_rif_cedula'];?>" required>
      </div>
      <div class="form-group col-xs-6">
        <label for="nu_telefono">Teléfonos:</label>
        <input type="text" class="form-control" id="nu_telefono" name="nu_telefono" placeholder="0212-5896956" value="<?php echo $cod['nu_telefono'];?>" required>
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_direccion_fiscal">Dirección Fiscal:</label>
        <textarea class="form-control" rows="3" id="tx_direccion_fiscal" name="tx_direccion_fiscal"><?php echo $cod['tx_direccion_fiscal'];?></textarea>
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_direccion_entrega">Dirección de Entrega:</label>
        <textarea class="form-control" rows="3" id="tx_direccion_entrega" name="tx_direccion_entrega"><?php echo $cod['tx_direccion_entrega'];?></textarea>
      </div>
      <div class="form-group col-xs-12">
        <select id="co_tpcliente" name="co_tpcliente" class="selectpicker" data-live-search="true" title="Seleccione Tipo de Cliente">
		  <?php
            $sql10="SELECT * FROM tg001_tpcliente";
            $result10 = mysqli_query($link,$sql10);//para categoria 1
            
            while ($row10 = mysqli_fetch_array($result10)) {
                $opcion_1.= '<option value="'.$row10['co_tpcliente'].'" ';
                if ($cod['co_tpcliente']==$row10['co_tpcliente']){ $opcion_1.= 'selected';}
                    $opcion_1.= ' >'.$row10['nb_tpcliente'].'</option>';	
            }
            echo $opcion_1;
          ?>    
          <option value=''></option>
      	</select>
      </div>
      <div class="form-group col-xs-6">
        <label for="tx_clave">Contraseña:</label>
        <input type="password" class="form-control" id="tx_clave" name="tx_clave" placeholder="Enter email">
      </div>
      <div class="form-group col-xs-6">En caso de que desee cambiar la contraseña del usuario escriba los valores respectivos en el campo de contraseña de lo contario deje el campo en blanco</div>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>

<!--<script src="../../../js/jquery-1.11.1.js"></script>
<script src="../../../js/bootstrap.min.js"></script>
<script src="../../../js/upload/fileinput.min.js"></script>
<script src="../../../js/select/bootstrap-select.js"></script>
<script src="../../../js/select/ajax-bootstrap-select.min.js"></script>-->
<script type="text/javascript">
$('.modal-content #ventana').ready(function() {
	//alert('cargo');
	parent.document.getElementById('precarga').style.display='none';
});
</script>
</body>
</html>