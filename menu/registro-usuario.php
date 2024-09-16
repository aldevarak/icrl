<?php 
include ("../inic/dbcon.php");
@session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro de Usuario</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
.has-feedback .form-control-feedback {
    top: 25px;
    right: 10px;
}
.form-horizontal .has-feedback .form-control-feedback {
    top: 0;
    right: -815px;
}
</style>
</head>
<body>
<form action="registro-usuario.php" method="post" id="frm_registro" name="frm_registro">
    <div class="modal-body">
    <div class="form-group col-xs-6">
            <label for="nb_usuario">Nombre del Cliente</label>
            <input type="text" class="form-control" id="nb_usuario" name="nb_usuario">
          </div>
          <div class="form-group col-xs-6">
            <label for="nu_rif_cedula">Cédula / Rif</label>
            <input type="text" class="form-control" id="nu_rif_cedula" name="nu_rif_cedula">
          </div>
          <div class="form-group col-xs-6">
            <label for="tx_email">E-mail</label>
            <input type="email" class="form-control" id="tx_email" name="tx_email" placeholder="mail@dominio.com">
          </div>
           <div class="form-group col-xs-6">
            <label for="tx_email2">Repetir E-mail</label>
            <input type="email" class="form-control" id="tx_email2" name="tx_email2" placeholder="mail@dominio.com">
          </div>
          <div class="form-group col-xs-6">
            <label for="tx_clave">Contraseña</label>
            <input type="password" class="form-control" id="tx_clave" name="tx_clave" placeholder="*******">
          </div>
          <div class="form-group col-xs-6">
            <label for="tx_clave2">Repetir Contraseña</label>
            <input type="password" class="form-control" id="tx_clave2" name="tx_clave2" placeholder="*******">
          </div>
          <div class="form-group col-xs-6">
            <label for="nu_telefono">Teléfono</label>
            <input type="text" class="form-control" id="nu_telefono" name="nu_telefono">
          </div>
          <div class="form-group col-xs-6">
            <label for="exampleInputEmail1">Dirección Fiscal / Principal</label>
            <textarea class="form-control" rows="3" id="tx_direccion_fiscal" name="tx_direccion_fiscal"></textarea >
          </div>
          <div class="form-group col-xs-12">
            <label for="exampleInputEmail1">Dirección de Entregas</label>
            <textarea class="form-control" rows="3" id="tx_direccion_entrega" name="tx_direccion_entrega"></textarea>
          </div>
    </div>
    <div class="clearfix"></div>
    <div class="modal-footer">
    <div class="form-group">
        <div class="col-xs-9 col-xs-offset-3">
            <div id="messages"></div>
        </div>
    </div>
        <button type="button" class="btn btn-default hide-modal" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="btn_registrarse" name="btn_registrarse">Registrarse</button>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
$("#ventana").ready(function() {
  $('#precarga').hide();
});
	$('#frm_registro').on('init.field.fv', function(e, data) {
			var $parent = data.element.parents('.form-group'),
				$icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
	
			$icon.on('click.clearing', function() {
				if ($icon.hasClass('glyphicon-remove')) {
					data.fv.resetField(data.element);
				}
			});
		})
		.find('[name="nu_telefono"]').mask('(0000)000.00.00 / (0000)000.00.00',{placeholder: "(0000)000.00.00 / (0000)000.00.00 "}).end()
		.find('[name="nu_rif_cedula"]').mask('Z-NNNNNNNF-E', {placeholder:"V-0000000 J-00000000-0", translation: {'Z': {pattern: /[V,v,j,J,G,g,e,E]/, optional: false},'N': {pattern: /[0-9]/},'F': {pattern: /[0-9]/, optional: true},'E': {pattern: /[0-9]/, optional: true}}}).end()
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
			nb_usuario: {
				validators: {
					notEmpty: {
						message: 'Agregue su nombre de Usuario'
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
						min: 9,
						message: 'Mínimo 10 caracteres con su prefijo V-J-G-E'
					},
					regexp: {
						regexp: /^[V,v,j,J,G,g,e,E]-[0-9]{8}-*?[0-9]*?$/i,
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
			  },
			tx_email2: {
				validators: {
					notEmpty: {
						message: 'Repita el correo'
					},
					identical: {
						field: 'tx_email',
						message: 'Deben coincidir ambos correos'
					}
				}
			},
			tx_clave: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 7,
							message: 'Mínimo 7 caracteres'
						}
					}
				},
			tx_clave2: {
				validators: {
					notEmpty: {
						message: 'Repita la contraseña'
					},
					identical: {
						field: 'tx_clave',
						message: 'Deben coincidir ambas contraseñas'
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
			$('#frm_registro').submit(function(event) {
				var formData = {
					'nb_usuario'	: $('#nb_usuario').val(),
					'nu_rif_cedula'	: $('#nu_rif_cedula').val(),
					'tx_email2'	: $('#tx_email2').val(),
					'tx_clave2'	: $('#tx_clave2').val(),
					'nu_telefono'	: $('#nu_telefono').val(),
					'tx_direccion_fiscal'	: $('#tx_direccion_fiscal').val(),
					'tx_direccion_entrega'	: $('#tx_direccion_entrega').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'editores/fun_registro_usuario.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 $("#ventana").load( 'editores/fun_registro_usuario.php' );
				   }
				})
				// stop the form from submitting the normal way and refreshing the page
				event.preventDefault();
			});
            // Then submit the form as usual
            fv.defaultSubmit();
        });
});
</script>
</body>
</html>