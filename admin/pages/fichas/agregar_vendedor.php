<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Vendedor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_agregar_vendedor" name="frm_agregar_vendedor">
<div class="modal-body">
      <div class="form-group col-xs-12">
        <label for="nb_vendedor">Nombre</label>
        <input type="text" class="form-control" id="nb_vendedor" name="nb_vendedor" placeholder="Nombre">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_cedula">Cédula / R.I.F:</label>
        <input type="text" class="form-control" id="nu_cedula" name="nu_cedula" placeholder="J-9856984-8 o 14851222">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_telefono">Teléfonos:</label>
        <input type="text" class="form-control" id="nu_telefono" name="nu_telefono" placeholder="0212-5896956">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_comision">Comisión:</label>
        <input type="text" class="form-control" id="nu_comision" name="nu_comision" placeholder="0.25">
      </div>
      <div class="form-group col-xs-6">
        <label for="nb_usuario">Email / Nombre de Usuario:</label>
        <input type="email" class="form-control" id="nb_usuario" name="nb_usuario" placeholder="Introducir email">
      </div>
      <div class="form-group col-xs-6">
        <label for="tx_clave">Contraseña:</label>
        <input type="password" class="form-control" id="tx_clave" name="tx_clave" placeholder="Clave">
      </div>
      <div class="form-group col-xs-6">En caso de que desee cambiar la contraseña del usuario escriba los valores respectivos en el campo de contraseña de lo contario deje el campo en blanco</div>
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
$('#frm_agregar_vendedor').on('init.field.fv', function(e, data) {
			var $parent = data.element.parents('.form-group'),
				$icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
	
			$icon.on('click.clearing', function() {
				if ($icon.hasClass('glyphicon-remove')) {
					data.fv.resetField(data.element);
				}
			});
		})
		.find('[name="nu_telefono"]').mask('(0000)000.00.00 / (0000)000.00.00',{placeholder: "(0000)000.00.00 / (0000)000.00.00 "}).end()
		.find('[name="nu_cedula"]').mask('Z-NNNNNNNF-E', {placeholder:"V-0000000 J-00000000-0", translation: {'Z': {pattern: /[V,v,j,J,G,g,e,E]/, optional: false},'N': {pattern: /[0-9]/},'F': {pattern: /[0-9]/, optional: true},'E': {pattern: /[0-9]/, optional: true}}}).end()
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
					},
					stringLength: {
						min: 4,
						message: 'Debe escribir un nombre válido'
					}
				}
			},
			nu_cedula: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				},
				stringLength: {
					min: 9,
					message: 'Mínimo 10 caracteres con su prefijo V-J-G-E'
				},
				regexp: {
					regexp: /^[V,v,j,J,G,g,e,E]-[0-9]{8}-*?[0-9]*?$/i,
					message: 'Agregue un rif con su prefijo V-J-G-E'
				}
			},
			nu_telefono: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					},
					stringLength: {
						min: 15,
						message: 'Debe escribir un nombre válido'
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
					},
					stringLength: {
						min: 4,
						message: 'Debe escribir un nombre válido'
					}
				}
			},
			tx_clave: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					},
					stringLength: {
						min: 7,
						message: 'Mínimo 7 caracteres'
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
			$('#frm_agregar_vendedor').submit(function(event) {
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
					url         : 'fichas/editores/fun_agregar_vendedor.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 $('#modal_det_iframe').modal('hide');
					 parent.cambio('fichas/vendedores.php','cont');
					 //$("#ventana").load( 'fichas/editores/fun_agregar_vendedor.php' );
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