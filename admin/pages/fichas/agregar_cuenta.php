<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Cuenta Bancaria</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
#frm_agregar .selectContainer .form-control-feedback {
    /* Adjust feedback icon position */
    right: -15px;
}
.has-feedback .form-control-feedback {
    top: 25px;
    right: 10px;
}
</style>
</head>

<body>
<form method="post" id="frm_agr_banco" name="frm_agr_banco">
<div class="modal-body">
      <div class="form-group col-xs-12">
        <label for="tp_cuentas">Tipo de Cuentas</label>
        <input type="text" class="form-control" id="tp_cuentas" name="tp_cuentas" placeholder="Ahorro/Corriente/Productiva/Global">
      </div>
      <div class="form-group col-xs-12">
        <label for="tx_banco">Nombre del Banco:</label>
        <input type="text" class="form-control" id="tx_banco" name="tx_banco" placeholder="nombre">
      </div>
      <div class="form-group col-xs-12">
        <label for="nu_cuenta">Número de Cuenta:</label>
        <input type="text" class="form-control" id="nu_cuenta" name="nu_cuenta" placeholder="xxxxxxxxxxxxxxxxxxx">
      </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>
<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
$('#frm_agr_banco').on('init.field.fv', function(e, data) {
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
					url         : 'fichas/editores/fun_agregar_cuenta.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
					 console.log(url);
				   },
				   complete: function(){
					 console.log(formData);
					 parent.cambio('fichas/banca.php','cont');
					 $('#modal_det_iframe').modal('hide');
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