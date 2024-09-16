<?php 
include ("../inic/dbcon.php");
include ("../inic/session.php");


if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id;

$result = mysqli_query($link,"SELECT cli.* FROM tg005_clientes AS cli INNER JOIN th001_usuario AS usu ON cli.co_usuario=usu.co_usuario WHERE cli.co_usuario='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){
	$sql="UPDATE tg005_clientes SET nb_clientes='".$_POST['nb_clientes']."',nu_rif_cedula='".$_POST['nu_rif_cedula']."',nu_telefono='".$_POST['nu_telefono']."',tx_direccion_fiscal='".$_POST['tx_direccion_fiscal']."',tx_direccion_entrega='".$_POST['tx_direccion_entrega']."' WHERE co_usuario='".$id."'";
	mysqli_query($link,$sql);
	
	if($_POST['tx_clave']!=""){
		$tx_clave=$_POST['tx_clave'];
		$clave = md5($tx_clave);
		$sql4="UPDATE th001_usuario SET tx_clave='".$clave."' WHERE co_usuario='".$cod['co_usuario']."'";
		mysqli_query($link,$sql4);
	}
			
	//echo $sql;
	echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_perfil_iframe').modal('hide');</script>";	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ver y Editar Cliente</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/validator/formValidation.min.css">
<style type="text/css">
.modal-footer{
	padding-bottom:0;
	margin-bottom:0;
}
</style>
</head>

<body>
<form method="post" id="frm_editar" name="frm_editar" action="ver_editar_cliente.php">
<div class="modal-body">
      <div class="form-group col-xs-4">
        <label for="nb_clientes">Nombre /Razon Social</label>
        <input type="text" class="form-control" id="nb_clientes" name="nb_clientes" value="<?php echo $cod['nb_clientes'];?>">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_rif_cedula">Cédula / R.I.F:</label>
        <input type="text" class="form-control" id="nu_rif_cedula" name="nu_rif_cedula" value="<?php echo $cod['nu_rif_cedula'];?>">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_telefono">Teléfonos:</label>
        <input type="text" class="form-control" id="nu_telefono" name="nu_telefono" value="<?php echo $cod['nu_telefono'];?>">
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_direccion_fiscal">Dirección Fiscal:</label>
        <textarea class="form-control" rows="3" id="tx_direccion_fiscal" name="tx_direccion_fiscal"><?php echo $cod['tx_direccion_fiscal'];?></textarea>
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_direccion_entrega">Dirección de Entrega:</label>
        <textarea class="form-control" rows="3" id="tx_direccion_entrega" name="tx_direccion_entrega"><?php echo $cod['tx_direccion_entrega'];?></textarea>
      </div>
      <?php
	  if($_SESSION['params']['in_generar_clave']=="1"){
		$form_contrasena="
			<div class='form-group col-xs-6'>
			<label for='tx_clave'>Contraseña:</label>
			<input type='password' class='form-control' id='tx_clave' name='tx_clave' placeholder='Contraseña'>
		  </div>
		  <div class='form-group col-xs-6'>En caso de que desee cambiar la contraseña del usuario escriba los valores respectivos en el campo de contraseña de lo contario deje el campo en blanco</div>";
	  }else{
		 $form_contrasena="
			<input type='hidden' class='form-control' id='tx_clave' name='tx_clave' placeholder='Contraseña'>";
	  }
	  echo $form_contrasena;
	  ?>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <button type="submit" class="btn btn-default" data-dismiss="modal" id="btn_enviar" name="btn_enviar">Enviar</button>
  <button type="button" class="btn btn-primary" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
</div>
</form>

<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/validator/formValidation.min.js"></script>
<script src="../js/validator/language/es_ES.js"></script>
<script src="../js/validator/framework/bootstrap.min.js"></script>
<script src="../js/mask/jquery.mask.min.js"></script>
<script type="text/javascript">
	$('.modal-content #ventana').ready(function() {
		parent.document.getElementById('precarga').style.display='none';
	$('#frm_editar').formValidation({
		locale: 'es_ES',
		fields: {
			nb_clientes: {
				validators: {
					notEmpty: {
						message: 'Agregue su razon social'
					},
					stringLength: {
						min: 4,
						message: 'Debe escribir un nombre válido'
					}
				}
			},
			tx_direccion_fiscal: {
				validators: {
					notEmpty: {
						message: 'Agregue su dirección fiscal'
					},
					stringLength: {
						min: 4,
						message: 'Debe escribir una dirección válida'
					}
				}
			},
			nu_rif_cedula: {
				validators: {
					notEmpty: {
						message: 'Es obligatorio un rif o cédula'
					},
					stringLength: {
						min: 10,
						message: 'Mínimo 10 caracteres con su prefijo V-J-G-E'
					},
					regexp: {
						regexp: /^[j,J,V,v,G,g]-[0-9]{8}-*?[0-9]*?$/i,
						message: 'Agregue un rif con su prefijo V-J-G-E'
					}
				}
			},
			tx_email: {
				  validators: {
					  notEmpty: {
						  message: 'Agregue un correo'
					  },
					  emailAddress: {
						  message: 'No es un correo válido'
					  }
				  }
			  }
        }
	})
	.find('[name="nu_telefono"]').mask('(0000)000.00.00 / (0000)000.00.00',{placeholder: "(0000)000.00.00 / (0000)000.00.00 "}).end()
	.find('[name="nu_rif_cedula"]').mask('Z-NNNNNNNN-E', {translation: {'Z': {pattern: /[V,v,j,J,G,g,e,E]/, optional: false},'N': {pattern: /[0-9]/},'E': {pattern: /[0-9]/, optional: true}}})	
	});
</script>
</body>
</html>