<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

	/*$sql3="INSERT INTO tg010_division (co_sublineas,nb_division,in_estatus) VALUES (".$_POST['co_sublineas'].",'".$_POST['nb_division']."',1)";
	mysqli_query($link,$sql3);

	$result34 = mysqli_query($link,"SELECT MAX(co_division) AS id FROM tg010_division WHERE in_estatus='1'");
	$code = mysqli_fetch_array($result34);

	//agregar division 2 automatica
	$sql39="INSERT INTO tg011_division2 (co_division2,nb_division2,in_eliminar,in_estatus) VALUES (".$code['id'].",'N/A',1,1)";
	mysqli_query($link,$sql39);
echo $sql39;

	$result45 = mysqli_query($link,"SELECT MAX(co_division2) AS divi FROM tg011_division2 WHERE in_estatus='1'");
	$code2 = mysqli_fetch_array($result45);
	
	//agregar division 3 automatica
	$sql391="INSERT INTO tg012_division3 (co_division2,nb_division3,in_eliminar,in_estatus) VALUES (".$code2['co_division2'].",'N/A',1,1)";
	mysqli_query($link,$sql391);

echo $sql391;*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar División</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_agr_division" name="frm_agr_division">
<div class="modal-body">
    <div class="form-group col-xs-12">
    <label for="">Sub - Línea</label>
      <select id="co_sublineas" name="co_sublineas" class="selectpicker" data-live-search="true" title="Seleccione Sub-Línea" data-width="100%">
      <?php
	  	$sql10="SELECT slin.*,lin.nb_linea FROM (tg009_sublineas AS slin INNER JOIN tg008_linea AS lin ON slin.co_linea=lin.co_linea) WHERE slin.in_estatus='1' AND slin.in_eliminar='1' ORDER BY slin.nb_sublineas";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_sublineas'].'" ';
			if ($cod['co_sublineas']==$row10['co_sublineas']){ $opcion_1.= 'selected';}
				$opcion_1.= ' data-subtext="'.$row10['nb_linea'].'">'.$row10['nb_sublineas'].'</option>';	
		}
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
      </div>
      <div class="form-group col-xs-12">
      <label for="nb_division">Nombre</label>
      <input type="text" class="form-control" id="nb_division" name="nb_division" value="" required>
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
$('#frm_agr_division').find('[name="co_sublineas"]')
		.selectpicker({
			style: 'btn-default',
		})
		.change(function(e) {
			$('#frm_agr_division').formValidation('revalidateField', 'co_sublineas');
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
			co_sublineas: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nb_division: {
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
			$('#frm_agr_division').submit(function(event) {
				var formData = {
					'co_sublineas'	: $('#co_sublineas').val(),
					'nb_division'	: $('#nb_division').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_agregar_division.php', // the url where we want to POST
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