<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT pos.*,ano.nu_ano,modelo.nb_modelo FROM ((tg018_tp_pastilla AS pos INNER JOIN tg017_ano AS ano ON pos.co_ano=ano.co_ano) INNER JOIN tg016_modelo AS modelo ON ano.co_modelo=modelo.co_modelo) WHERE pos.co_tp_pastilla='".$id."'");
$cod = mysqli_fetch_array($result);	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Marca</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_editar_linea" name="frm_editar_linea">
<div class="modal-body">
	<div class="form-group col-xs-12">
    <label for="">Marca</label>
      <select id="co_ano" name="co_ano" class="selectpicker" data-live-search="true" title="Seleccione Marca" data-width="100%">
      <?php
	  	$sql10="SELECT pos.*,ano.nu_ano,modelo.nb_modelo FROM ((tg018_tp_pastilla AS pos INNER JOIN tg017_ano AS ano ON pos.co_ano=ano.co_ano) INNER JOIN tg016_modelo AS modelo ON ano.co_modelo=modelo.co_modelo)";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_ano'].'" ';
			if ($cod['co_ano']==$row10['co_ano']){ $opcion_1.= 'selected';}
				$opcion_1.= ' >'.$row10['nu_ano'].' - '.$row10['nb_modelo'].'</option>';	
		}
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
      </div>
	
    <div class="form-group col-xs-12">
      <label for="nb_linea">Nombre</label>
      <input type="text" class="form-control" id="nb_tp_pastilla" name="nb_tp_pastilla" value="<?php echo $cod['nb_tp_pastilla'];?>" required>
	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
    </div>
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
$('.selectpicker').selectpicker({
      showSubtext: true
});
$('#frm_editar_linea').formValidation({
		framework: 'bootstrap',
		excluded: ':disabled',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		locale: 'es_ES',
		fields: {
			co_ano: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nb_tp_pastilla: {
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
			$('#frm_editar_linea').submit(function(event) {
				var formData = {
					'co_ano' : $('#co_ano').val(),
					'nb_tp_pastilla' : $('#nb_tp_pastilla').val(),
					'id'	: $('#id').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_editar_posicion.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 parent.cambio('fichas/divisiones.php','cont');
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