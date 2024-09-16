<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");
	$sql3="INSERT INTO tg011_division2 (co_division,nb_division2,in_estatus) VALUES (".$_POST['co_division'].",'".$_POST['nb_division2']."',1)";
	mysqli_query($link,$sql3);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Division 2</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_agr_division2" name="frm_agr_division2">
<div class="modal-body">
    <div class="form-group col-xs-12">
    <label for="co_division">Division</label>
      <select id="co_division" name="co_division" class="selectpicker" data-live-search="true" title="Seleccione División" data-width="100%">
      <?php
	  	$sql10="SELECT div1.*,slin.nb_sublineas FROM (tg010_division AS div1 INNER JOIN tg009_sublineas AS slin ON div1.co_sublineas=slin.co_sublineas) WHERE div1.in_estatus='1' AND div1.in_eliminar='1' ORDER BY div1.nb_division";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_division'].'" ';
			if ($cod['co_division']==$row10['co_division']){ $opcion_1.= 'selected';}
				$opcion_1.= ' data-subtext="'.$row10['nb_sublineas'].'">'.$row10['nb_division'].'</option>';	
		}
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
      </div>
      <div class="form-group col-xs-12">
      <label for="nb_division2">Nombre</label>
      <input type="text" class="form-control" id="nb_division2" name="nb_division2" value="" required>
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
$('#frm_agr_division2').find('[name="co_division"]')
		.selectpicker({
			style: 'btn-default',
		})
		.change(function(e) {
			$('#frm_agr_division2').formValidation('revalidateField', 'co_division');
		})
		.end()
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
			co_division: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nb_division2: {
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
			$('#frm_agr_division2').submit(function(event) {
				var formData = {
					'co_division'	: $('#co_division').val(),
					'nb_division2'	: $('#nb_division2').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_agregar_division2.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
				   },
				   complete: function(){
					 console.log(formData);
					 parent.cambio('fichas/clasificaciones.php','cont');
					 $('#modal_det_iframe').modal('hide');
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