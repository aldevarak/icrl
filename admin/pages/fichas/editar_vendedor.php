<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT ven.* FROM tg002_vendedor AS ven INNER JOIN th001_usuario AS usu ON ven.co_usuario=usu.co_usuario WHERE co_vendedor='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){
	$sql="UPDATE tg002_vendedor SET nb_vendedor='".$_POST['nb_vendedor']."',nu_cedula='".$_POST['nu_cedula']."',nu_telefono='".$_POST['nu_telefono']."',nu_comision='".$_POST['nu_comision']."' WHERE co_vendedor='".$id."'";
	mysqli_query($link,$sql);
	
	if($_POST['tx_clave']!=""){
		$tx_clave=$_POST['tx_clave'];
		$clave = md5($tx_clave);
		$sql4="UPDATE th001_usuario SET tx_clave='".$clave."' WHERE co_usuario='".$cod['co_usuario']."'";
		mysqli_query($link,$sql4);
	}
			
	//echo $sql;
	echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/vendedores.php','cont');</script>";	
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Vendedor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</style>
</head>

<body>
<form method="post" id="frm_editar_vendedor" name="frm_editar_vendedor">
<div class="modal-body">
      <div class="form-group col-xs-4">
        <label for="nb_vendedor">Nombre</label>
        <input type="text" class="form-control" id="nb_vendedor" name="nb_vendedor" placeholder="Nombre" value="<?php echo $cod['nb_vendedor'];?>">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_cedula">Cédula / R.I.F:</label>
        <input type="text" class="form-control" id="nu_cedula" name="nu_cedula" placeholder="J-9856984-8 o 14851222" value="<?php echo $cod['nu_cedula'];?>">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_telefono">Teléfonos:</label>
        <input type="text" class="form-control" id="nu_telefono" name="nu_telefono" placeholder="0212-5896956" value="<?php echo $cod['nu_telefono'];?>">
      </div>
      <div class="form-group col-xs-12">
        <label for="nu_comision">Comisión:</label>
        <input type="text" class="form-control" id="nu_comision" name="nu_comision" placeholder="0.25" value="<?php echo $cod['nu_comision'];?>">
      </div>
      <div class="form-group col-xs-6">
        <label for="tx_clave">Contraseña:</label>
        <input type="password" class="form-control" id="tx_clave" name="tx_clave" placeholder="Cambio de contraseña">
      </div>
      <div class="form-group col-xs-6">En caso de que desee cambiar la contraseña del usuario escriba los valores respectivos en el campo de contraseña de lo contario deje el campo en blanco</div>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary" data-dismiss="modal" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>
<script type="text/javascript">
$('#frm_editar_vendedor').on('init.field.fv', function(e, data) {
			var $parent = data.element.parents('.form-group'),
				$icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
	
			$icon.on('click.clearing', function() {
				if ($icon.hasClass('glyphicon-remove')) {
					data.fv.resetField(data.element);
				}
			});
		})
		.formValidation({
		framework: 'bootstrap',
		excluded: ':disabled',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		locale: 'es_ES',
		fields: {
			nb_vendedor: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nu_cedula: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nu_telefono: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nu_comision: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nb_usuario: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			}
        }
	}).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');

            // Do whatever you want here ...
			$('#frm_editar_vendedor').submit(function(event) {
				var formData = {
					'nb_vendedor'	: $('#nb_vendedor').val(),
					'nu_cedula'	: $('#nu_cedula').val(),
					'nu_telefono'	: $('#nu_telefono').val(),
					'nu_comision'	: $('#nu_comision').val(),
					'nb_usuario'	: $('#nb_usuario').val(),
					'tx_clave'	: $('#tx_clave').val()
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_editar_vendedor.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 $('#modal_agregar_iframe').modal('hide');
					 //$("#ventana").load( 'fichas/editores/fun_editar_vendedor.php' );
				   }
				})
				// stop the form from submitting the normal way and refreshing the page
				event.preventDefault();
			});
            // Then submit the form as usual
            fv.defaultSubmit();
        });
$("#ventana").ready(function() {
  $('#precarga').hide();
});
</script>
</body>
</html>