<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg012_division3 WHERE co_division3='".$id."'");
$cod = mysqli_fetch_array($result);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Division 2</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_editar_division3" name="frm_editar_division3">
<div class="modal-body">
	<div class="form-group col-xs-12">
    <label for="">División</label>
      <select id="co_division2" name="co_division2" class="selectpicker" data-live-search="true" title="Seleccione División nivel 2" data-width="100%">
      <?php
	  	$sql10="SELECT div2.*,div1.nb_division FROM (tg011_division2 AS div2 INNER JOIN tg010_division AS div1 ON div2.co_division=div1.co_division) WHERE div2.in_estatus='1' ORDER BY div2.nb_division2";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_division2'].'" ';
			if ($cod['co_division2']==$row10['co_division2']){ $opcion_1.= 'selected';}
				$opcion_1.= ' data-subtext="'.$row10['nb_division'].'">'.$row10['nb_division2'].' - '.$row10['nb_division'].'</option>';	
		}
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
     </div>
	
    <div class="form-group col-xs-12">
      <label for="nb_division3">Nombre</label>
      <input type="text" class="form-control" id="nb_division3" name="nb_division3" value="<?php echo $cod['nb_division3'];?>" required>
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
$('#frm_editar_division3').formValidation({
		framework: 'bootstrap',
		excluded: ':disabled',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		locale: 'es_ES',
		fields: {
			co_division2: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			nb_division3: {
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
			$('#frm_editar_division3').submit(function(event) {
				var formData = {
					'co_division2'	: $('#co_division2').val(),
					'nb_division3'	: $('#nb_division3').val(),
					'id'	: $('#id').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_editar_division3.php', // the url where we want to POST
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