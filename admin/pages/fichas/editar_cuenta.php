<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg003_cuentas WHERE co_cuentas='".$id."'");
$cod = mysqli_fetch_array($result);	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Cuenta</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_editar_banco" name="frm_editar_banco">
<div class="modal-body">
      <div class="form-group col-xs-12">
        <label for="tp_cuentas">Tipo de Cuentas</label>
        <input type="text" class="form-control" id="tp_cuentas" name="tp_cuentas" placeholder="Ahorro/Corriente/Productiva/Global" value="<?php echo $cod['tp_cuentas'];?>" required>
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_banco">Nombre del Banco:</label>
        <input type="text" class="form-control" id="tx_banco" name="tx_banco" placeholder="nombre" value="<?php echo $cod['tx_banco'];?>" required>
      </div>
      <div class="form-group col-xs-12">
        <label for="nu_cuenta">Número de Cuenta:</label>
        <input type="text" class="form-control" id="nu_cuenta" name="nu_cuenta" placeholder="xxxxxxxxxxxxxxxxxxx" value="<?php echo $cod['nu_cuenta'];?>" required>
      </div>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary"id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>

<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
$('#frm_editar_banco').on('init.field.fv', function(e, data) {
			var $parent = data.element.parents('.form-group'),
				$icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
	
			$icon.on('click.clearing', function() {
				if ($icon.hasClass('glyphicon-remove')) {
					data.fv.resetField(data.element);
				}
			});
		})
		//.find('[name="nu_telefono"]').mask('(0000)000.00.00 / (0000)000.00.00',{placeholder: "(0000)000.00.00 / (0000)000.00.00 "}).end()
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
			tp_cuentas: {
					validators: {
						notEmpty: {
							message: 'Campo requerido'
						}
					}
				},
			tx_banco: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nu_cuenta: {
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
			$('#frm_agr_banco').submit(function(event) {
				var formData = {
					'tp_cuentas'	: $('#tp_cuentas').val(),
					'tx_banco'	: $('#tx_banco').val(),
					'nu_cuenta'	: $('#nu_cuenta').val()
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'editores/fun_agregar_cuenta.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 $("#ventana").load( 'editores/fun_editar_cuenta.php' );
				   }
				})
				// stop the form from submitting the normal way and refreshing the page
				event.preventDefault();
			});
            // Then submit the form as usual
            fv.defaultSubmit();
        });
</script>
</body>
</html>