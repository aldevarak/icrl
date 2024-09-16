<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
//echo $id;

$resulta = mysqli_query($link,"SELECT * FROM tr004_busqueda WHERE co_busqueda='".$id."'");
$cod = mysqli_fetch_array($resulta);	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Busqueda</title>
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
<form method="post" id="frm_agregar_producto" name="frm_agregar_producto">
<div class="modal-body">
      <div class='form-group col-xs-6'>
      	<label for="nb_marca">Marca</label>
      	<select class='selectpicker' data-live-search='true' name='co_marca' id='co_marca' data-width='100%'>
        <option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        <?php
              $sql="SELECT * FROM tg015_marca WHERE in_estatus='1' ORDER BY nb_marca";
              $result1 = mysqli_query($link,$sql);//para categoria 1
              
              while ($row1 = mysqli_fetch_array($result1)) {
                  $opcion_1.= '<option value="'.$row1['co_marca'].'" ';
                  if ($cod['co_marca']==$row1['co_marca']){ $opcion_1.= 'selected';}
                      $opcion_1.= ' >'.$row1['nb_marca'].'</option>';	
              }
              echo $opcion_1;
          ?>
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">Modelo</label>
      	<select class='selectpicker' data-live-search='true' name='co_modelo' id='co_modelo' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
            <?php
              $sql3="SELECT * FROM tg016_modelo WHERE in_estatus='1' AND co_marca='".$cod['co_marca']."' ORDER BY nb_modelo";
              $result13 = mysqli_query($link,$sql3);//para categoria 1
              
              while ($row13 = mysqli_fetch_array($result13)) {
                  $opcion_13.= '<option value="'.$row13['co_modelo'].'" ';
                  if ($cod['co_modelo']==$row13['co_modelo']){ $opcion_13.= 'selected';}
                      $opcion_13.= ' >'.$row13['nb_modelo'].'</option>';	
              }
              echo $opcion_13;
          	?>
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">Año</label>
      	<select class='selectpicker' data-live-search='true' name='co_ano' id='co_ano' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
            <?php
              $sql31="SELECT * FROM tg017_ano WHERE in_estatus='1' AND co_modelo='".$cod['co_modelo']."' ORDER BY nu_ano";
              $result131 = mysqli_query($link,$sql31);//para categoria 1
              
              while ($row131 = mysqli_fetch_array($result131)) {
                  $opcion_131.= '<option value="'.$row131['co_ano'].'" ';
                  if ($cod['co_ano']==$row131['co_ano']){ $opcion_131.= 'selected';}
                      $opcion_131.= ' >'.$row131['nu_ano'].'</option>';	
              }
              echo $opcion_131;
          	?>
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">Posición</label>
      	<select class='selectpicker' data-live-search='true' name='co_tp_pastilla' id='co_tp_pastilla' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
            <?php
              $sql311="SELECT * FROM tg018_tp_pastilla WHERE in_estatus='1' AND co_ano='".$cod['co_ano']."' ORDER BY nb_tp_pastilla";
              $result1311 = mysqli_query($link,$sql311);//para categoria 1
              
              while ($row1311 = mysqli_fetch_array($result1311)) {
                  $opcion_1311.= '<option value="'.$row1311['co_tp_pastilla'].'" ';
                  if ($cod['co_tp_pastilla']==$row1311['co_tp_pastilla']){ $opcion_1311.= 'selected';}
                      $opcion_1311.= ' >'.$row1311['nb_tp_pastilla'].'</option>';	
              }
              echo $opcion_1311;
          	?>
        </select>
      </div>
      
      <div class='form-group col-xs-12'>
      	<label for="nb_productos">Productos</label>
      	<select class='selectpicker' data-live-search='true' name='co_productos' id='co_productos' data-width='100%'>
        <option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        <?php
              $sql="SELECT * FROM tg013_productos WHERE in_estatus='1' ORDER BY nb_productos";
              $result8 = mysqli_query($link,$sql);//para categoria 1
              
              while ($row18 = mysqli_fetch_array($result8)) {
                  $opcion_8.= '<option value="'.$row18['co_productos'].'" ';
                  if ($cod['co_productos']==$row18['co_productos']){ $opcion_8.= 'selected';}
                      $opcion_8.= ' >'.$row18['nb_productos'].'</option>';	
              }
              echo $opcion_8;
          ?>
        </select>
      </div>
      
       <div class='form-group col-xs-12'>
     	 <label for="tx_descripcion">Observación:</label>
         <textarea class="form-control" rows="3" id="tx_observacion" name="tx_observacion"><?php echo $cod['tx_observacion'];?></textarea>
      </div>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
      <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
<div id="message"></div>
  <button type="button" class="btn btn-default" onClick="$('#modal_det_iframe').modal('hide');">Cancelar</button>
  <button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>

<script type="text/javascript">
	$('#frm_agregar_producto').on('init.field.fv', function(e, data) {
			var $parent = data.element.parents('.form-group'),
				$icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');
	
			$icon.on('click.clearing', function() {
				if ($icon.hasClass('glyphicon-remove')) {
					data.fv.resetField(data.element);
				}
			});
		})
		.find('[name="co_marca"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_marca").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_modelo.php", { id: id }, function(data){
					$("#co_modelo").html(data);
					$('#co_modelo').selectpicker('refresh');
					$('#co_modelo').selectpicker('render');
					
					$("#co_ano").html('<option value=""></option>');
					$('#co_ano').selectpicker('refresh');
					$('#co_ano').selectpicker('render');
					
					$("#co_tp_pastilla").html('<option value=""></option>');
					$('#co_tp_pastilla').selectpicker('refresh');
					$('#co_tp_pastilla').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_marca');
		})
		.end()

		.find('[name="co_modelo"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_modelo").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_ano.php", { id: id }, function(data){
					$("#co_ano").html(data);
					$('#co_ano').selectpicker('refresh');
					$('#co_ano').selectpicker('render');
					
					$("#co_tp_pastilla").html('<option value=""></option>');
					$('#co_tp_pastilla').selectpicker('refresh');
					$('#co_tp_pastilla').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_modelo');
		})
		.end()
		
		.find('[name="co_ano"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_ano").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_posicion.php", { id: id }, function(data){
					$("#co_tp_pastilla").html(data);
					$('#co_tp_pastilla').selectpicker('refresh');
					$('#co_tp_pastilla').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_ano');
		})
		.end()
		
		.find('[name="co_tp_pastilla"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_tp_pastilla").value;
				//alert(id);
				
				/*alert(data);*/
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_tp_pastilla');
		})
		.end()
		
		.find('[name="co_productos"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_productos").value;
				//alert(id);
				
				/*alert(data);*/
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_productos');
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
			co_marca: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_modelo: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_ano: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_tp_pastilla: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_productos: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
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
			$('#frm_agregar_producto').submit(function(event) {
				var formData = {
					'id'	: $('#id').val(),
					'co_marca'	: $('#co_marca').val(),
					'co_modelo'	: $('#co_modelo').val(),
					'co_ano'		: $('#co_ano').val(),
					'co_tp_pastilla'	: $('#co_tp_pastilla').val(),
					'co_productos'	: $('#co_productos').val(),
					'tx_observacion'	: $('#tx_observacion').val(),
				};
			
				// process the form
				$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_editar_buscar.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
					 console.log(url);
				   },
				   complete: function(){
					 console.log(formData);
					 parent.cambio('fichas/buscar_avan.php','cont');
					 $('#modal_det_iframe').modal('hide');
					 //$("#ventana").load( 'fichas/editores/fun_agregar_producto.php' );
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