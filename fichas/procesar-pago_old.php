<?php 
include ("../inic/dbcon.php");
@session_start();

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id."<br>";
$hoy=date('Y-m-d H:i:s');

$result = mysqli_query($link,"SELECT * FROM tr001_pedidos WHERE co_pedidos='".$id."'");
$cod = mysqli_fetch_array($result);

$sql2="SELECT * FROM tr003_pagos WHERE co_pedidos='".$id."' AND in_estatus='1'";
$res2=mysqli_query($link,$sql2);

while ($row2 = mysqli_fetch_array($res2)) {
	$suma_pago=$suma_pago+$row2['nu_monto'];	
}

$deuda=$cod['nu_total']-$suma_pago;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/select/bootstrap-select.css">
<style type="text/css">
.modal-footer{
	padding-bottom:0;
	margin-bottom:0;
}
</style>
</head>
<body>
<form action="procesar-pago.php" method="post" id="frm_pago" name="frm_pago">
    <div class="modal-body">
    <div class='form-group col-xs-12'>
            <label for="tp_pagos">Forma de pago</label>
            <select class='selectpicker' name='tp_pagos' id='tp_pagos' data-width='100%'>
                <option value='0'>Seleccione...</option>
                <option value='1'>Depósito</option>
                <option value='2'>Transferencia</option>
        	</select>
          </div>
          <div class='form-group col-xs-12'>
            <label for="cuentabancaria">Cuenta donde pago</label>
            <select class='selectpicker' name='co_cuentas' id='co_cuentas' data-width='100%'>
                <option value=''>Seleccione un Banco</option>
                <?php 
				$sql="SELECT * FROM tg003_cuentas WHERE in_activa='1'";
				$res=mysqli_query($link,$sql);

				while ($row = mysqli_fetch_array($res)) {
					$opcion_1.= '<option value="'.$row['co_cuentas'].'" ';
					if ($cod['co_cuentas']==$row['co_cuentas']){ $opcion_1.= 'selected';}
					$opcion_1.= '>'.$row['tx_banco'].' / '.$row['nu_cuenta'].' / '.$row['tp_cuentas'].'</option>';
				}
				
				echo $opcion_1;
				?>
        	</select>
          </div>
          <div class='form-group col-xs-12' id='hidden_div' style="display: none;">
            <label for="banco-emisor">Banco Emisor</label>
            <input type='text' class='form-control' id='tx_banco' name="tx_banco" placeholder="Banco desde donde pagó">
          </div>
          <div class="form-group col-xs-12">
            <label for="transferencia">Nº Transferencia o Depósito</label>
            <input type='text' class='form-control' id='nu_transaccion' name="nu_transaccion" placeholder="Nº Deposito o transferencia" required>
          </div>
          <div class="form-group col-xs-12">
            <label for="titular">Depositante</label>
            <input type='text' class='form-control' id='tx_depositante' name="tx_depositante" placeholder="Nombre de quien paga" required>
          </div>
          <div class='form-group col-xs-6'>
				<label><input type="radio" name="pago" value="pago_t" checked> Pago total</label>
                <input type='text' class='form-control' id='pagototal' name="pagototal" placeholder="Pago total" value="<?php echo $deuda;?>" readonly>
          </div>
          <div class='form-group col-xs-6'>
                <label><input type="radio" name="pago" value="pago_p"> Pago parcial</label>
                <input type='text' class='form-control' id='pagoparcial' name="pagoparcial" placeholder="Pago parcial" readonly>
          </div>  
    <div class="clearfix"></div>
    <div class="modal-footer">
    <div class="form-group">
        <div class="col-xs-9 col-xs-offset-3">
            <div id="messages"></div>
        </div>
    </div>
        <input type='hidden' class='form-control' id='id' name="id" value='<?php echo $id;?>'>
          <button type="button" class="btn btn-default" onClick="parent.$('#modal_det_iframe').modal('hide');">Cancelar</button>
          
		<button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Notificar</button>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$('#precarga').hide();
	$('.selectpicker').selectpicker({});
	
	var $radios = $('input:radio[name=pago]');
		if($radios.is(':checked') === false) {
			$radios.filter('[value=pago_t]').prop('checked', true);
		};
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="pago_t"){
                $("#pagototal").attr("readonly", true);
				$("#pagoparcial").attr("readonly", true);
				$("#pagoparcial").val("");
            }
            if($(this).attr("value")=="pago_p"){
				$("#pagoparcial").attr("readonly", false);
				$("#pagoparcial").val("");
            }
        });
	});
});
	
$('#frm_pago').on('init.field.fv', function(e, data) {
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
			tp_pagos: {
					validators: {
						notEmpty: {
							message: 'Seleccione un tipo de pago'
						}
						
					}
			},
			co_cuentas: {
				validators: {
					notEmpty: {
						message: 'Seleccione una Cuenta'
					}
				}
			},
			tx_banco: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Banco Emisor'
					}
				}
			},
			nu_transaccion: {
				validators: {
					notEmpty: {
						message: 'Agregue el Número de la Transaccion'
					},
					stringLength: {
						min: 4,
						message: 'Debe escribir al menos 4 Números'
					}
				}
			},
			tx_depositante: {
				validators: {
					notEmpty: {
						message: 'Agregue el nombre del Depositante'
					},
					stringLength: {
						min: 6,
						message: 'Debe escribir al menos 6 Caracteres'
					}
				}
			},
        }
	}).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');

            // Do whatever you want here ...
			$('#frm_pago').submit(function(event) {
				var formData = {
					'id'	: $('#id').val(),
					'tp_pagos'	: $('#tp_pagos').val(),
					'co_cuentas'	: $('#co_cuentas').val(),
					'tx_banco'	: $('#tx_banco').val(),
					'nu_transaccion'	: $('#nu_transaccion').val(),
					'tx_depositante'	: $('#tx_depositante').val(),
					'pagototal'	: $('#pagototal').val(),
					'pagoparcial'	: $('#pagoparcial').val(),
					'pago'	: $('#pago').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'editores/fun_noti_pago.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 $("#ventana").load( 'editores/fun_noti_pago.php' );
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