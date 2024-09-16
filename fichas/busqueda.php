<?php 
include ("../inic/dbcon.php");
@session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Busqueda Avanzada</title>
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
	<div class="col-xs-9 col-sm-12 col-md-2 col-lg-2 text-center">
			<img alt="logotipo" src="../img/<?php echo $_SESSION['params']['tx_logo'].'?x=='.md5(time());?>" class="img-responsive" style="margin: 0 auto; padding:5px;"> <!--ESTE LO PUEDES BORRAR LUEGO-->
	</div> 
       
    <div class='form-group col-xs-5'>
      	<label for="nb_marca">Categoría</label>
      	<select class='selectpicker' data-live-search='true' name='co_marca' id='co_marca' data-width='100%'>
        <option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        <?php
              $sql="SELECT * FROM tg015_marca WHERE in_estatus='1' ORDER BY nb_marca";
              $result = mysqli_query($link,$sql);//para categoria 1
              
              while ($row1 = mysqli_fetch_array($result)) {
                  $opcion_1.= '<option value="'.$row1['co_marca'].'" ';
                  if ($row['co_marca']==$row1['co_marca']){ $opcion_1.= 'selected';}
                      $opcion_1.= ' >'.$row1['nb_marca'].'</option>';	
              }
              echo $opcion_1;
          ?>
        </select>
      </div>
      
      <div class='form-group col-xs-5'>
      	<label for="nb_productos">Linea</label>
      	<select class='selectpicker' data-live-search='true' name='co_modelo' id='co_modelo' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      
      <div class='form-group col-xs-5'>
      	<label for="nb_productos">Marca</label>
      	<select class='selectpicker' data-live-search='true' name='co_ano' id='co_ano' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      
      <div class='form-group col-xs-5'>
      	<label for="nb_productos">Color</label>
      	<select class='selectpicker' data-live-search='true' name='co_tp_pastilla' id='co_tp_pastilla' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      <div class='form-group col-xs-12'>
     	 <div name='tx_busca' id='tx_busca'></div>
      </div>
      
      <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
<div id="message"></div>
  <button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Buscar</button>
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
				
				$.post("../funciones_ajax/combos/combo_modelo.php", { id: id }, function(data){
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
				
				$.post("../funciones_ajax/combos/combo_ano.php", { id: id }, function(data){
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
				
				$.post("../funciones_ajax/combos/combo_posicion.php", { id: id }, function(data){
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
			
        }
	}).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $(e.target).data('formValidation');

            // Do whatever you want here ...
			$('#frm_agregar_producto').submit(function(event) {
				/*var formData = {
					'co_marca'	: $('#co_marca').val(),
					'co_modelo'	: $('#co_modelo').val(),
					'co_ano'		: $('#co_ano').val(),
					'co_tp_pastilla'	: $('#co_tp_pastilla').val(),
				};*/
			
				co_marca=document.getElementById("co_marca").value;
				co_modelo=document.getElementById("co_modelo").value;
				co_ano=document.getElementById("co_ano").value;
				co_tp_pastilla=document.getElementById("co_tp_pastilla").value;
				//alert(id);
				
				$.post("../fichas/editores/busqueda_avanzada.php", { co_marca: co_marca, co_modelo: co_modelo, co_ano: co_ano, co_tp_pastilla: co_tp_pastilla }, function(data){
					$("#tx_busca").html(data);
					
					document.getElementById("referido").click();
				}); 
				
				
				
				// process the form
				/*$.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'fichas/editores/fun_agregar_producto.php', // the url where we want to POST
					data        : formData, // our data object
					dataType    : 'json', // what type of data do we expect back from the server
					encode      : true,
					ajaxStart : function(){
					 console.log(formData);
					 console.log(url);
				   },
				   complete: function(){
					 console.log(formData);
					 parent.cambio('fichas/productos.php','cont');
					 $('#modal_det_iframe').modal('hide');
					 //$("#ventana").load( 'fichas/editores/fun_agregar_producto.php' );
				   }
				})*/
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