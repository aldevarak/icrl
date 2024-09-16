<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

	$sql3="INSERT INTO tg008_linea (co_categoria,nb_linea,in_estatus) VALUES (".$_POST['co_categoria'].",'".$_POST['nb_linea']."',1)";
	mysqli_query($link,$sql3);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Linea</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_agregar_linea" name="frm_agregar_linea">
<div class="modal-body">
    <div class="form-group col-xs-12">
    <label for="co_categoria">Categoria</label>
      <select id="co_categoria" name="co_categoria" class="selectpicker" data-live-search="true" title="Seleccione Categoria" data-width="99%">
      <?php
	  	$sql10="SELECT * FROM tg007_categoria WHERE in_estatus='1' AND in_eliminar='1' ORDER BY nb_categoria";
		$result10 = mysqli_query($link,$sql10);//para categoria 1
		
		while ($row10 = mysqli_fetch_array($result10)) {
			$opcion_1.= '<option value="'.$row10['co_categoria'].'" ';
			if ($cod['co_categoria']==$row10['co_categoria']){ $opcion_1.= 'selected';}
				$opcion_1.= ' >'.$row10['nb_categoria'].'</option>';	
		}
		
		echo $opcion_1;
	  ?>    
          <option value=''></option>
      </select>
      </div>
      <div class="form-group col-xs-12">
      <label for="nb_linea">Nombre</label>
      <input type="text" class="form-control" id="nb_linea" name="nb_linea" value="" required>
      </div>
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
$('#frm_agregar_linea').find('[name="co_categoria"]')
		.selectpicker({
			style: 'btn-default',
		})
		.change(function(e) {
			$('#frm_agregar_linea').formValidation('revalidateField', 'co_categoria');
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
			nb_linea: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_categoria: {
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
			$('#frm_agregar_linea').submit(function(event) {
				var formData = {
					'nb_linea'	: $('#nb_linea').val(),
					'co_categoria'	: $('#co_categoria').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_agregar_linea.php', // the url where we want to POST
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