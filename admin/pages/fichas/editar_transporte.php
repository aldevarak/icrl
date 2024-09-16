<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg014_transporte WHERE co_transporte='".$id."'");
$cod = mysqli_fetch_array($result);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Transporte</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form id="frm_editar_transporte" name="frm_editar_transporte">
<div class="modal-body">
      <div class="form-group col-xs-6">
        <label for="nb_clientes">Nombre del transporte</label>
        <input type="text" class="form-control" id="nb_transporte" name="nb_transporte" placeholder="Nombre" value="<?php echo $cod['nb_transporte'];?>" required>
      </div>
      <div class="form-group col-xs-6">
        <label for="nu_telefono">Teléfonos:</label>
        <input type="text" class="form-control" id="nu_telefono" name="nu_telefono" placeholder="0212-5896956" value="<?php echo $cod['nu_telefono'];?>" required>
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_direccion_fiscal">Descripción:</label>
        <textarea class="form-control" rows="3" id="tx_descripcion" name="tx_descripcion"><?php echo $cod['tx_descripcion'];?></textarea>
      </div>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>
<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
$('#frm_editar_transporte')
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
			nb_transporte: {
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
			}
        }
	}).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');

            // Do whatever you want here ...
			$('#frm_editar_transporte').submit(function(event) {
				var formData = {
					'nb_transporte'	: $('#nb_transporte').val(),
					'nu_telefono'	: $('#nu_telefono').val(),
					'tx_descripcion'	: $('#tx_descripcion').val(),
					'id'	: $('#id').val()
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_editar_transporte.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 parent.cambio('fichas/transporte.php','cont');
					 $('#modal_det_iframe').modal('hide');
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