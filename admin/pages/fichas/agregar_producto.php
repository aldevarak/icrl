<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Producto</title>
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
      <div class="form-group col-xs-12">
        <label for="nb_productos">Nombre del Producto</label>
        <input type="text" class="form-control" id="nb_productos" name="nb_productos" placeholder="Producto">
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">Categoría</label>
      	<select class='selectpicker' data-live-search='true' name='co_categoria' id='co_categoria' data-width='100%'>
        <option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        <?php
              $sql="SELECT * FROM tg007_categoria WHERE in_estatus='1' AND in_eliminar='1' ORDER BY nb_categoria";
              $result = mysqli_query($link,$sql);//para categoria 1
              
              while ($row1 = mysqli_fetch_array($result)) {
                  $opcion_1.= '<option value="'.$row1['co_categoria'].'" ';
                  if ($row['co_categoria']==$row1['co_categoria']){ $opcion_1.= 'selected';}
                      $opcion_1.= ' >'.$row1['nb_categoria'].'</option>';	
              }
              echo $opcion_1;
          ?>
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">Línea</label>
      	<select class='selectpicker' data-live-search='true' name='co_linea' id='co_linea' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">Sub-Línea</label>
      	<select class='selectpicker' data-live-search='true' name='co_sublineas' id='co_sublineas' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">División:</label>
      	<select class='selectpicker' data-live-search='true' name='co_division' id='co_division' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">División 2:</label>
      	<select class='selectpicker' data-live-search='true' name='co_division2' id='co_division2' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
      
      <div class='form-group col-xs-6'>
      	<label for="nb_productos">División 3:</label>
      	<select class='selectpicker' data-live-search='true' name='co_division3' id='co_division3' data-width='100%'>
        	<option value=""></option><!--NECESITO ESTE VALOR PARA VALIDAR QUE NO QUEDE EN BLANCO-->
        </select>
      </div>
	
      
      <div class="form-group col-xs-8">
        <label for="tx_descripcion">Descripción:</label>
        <textarea class="form-control" rows="3" id="tx_descripcion" name="tx_descripcion"></textarea>
      </div>
      <div class="form-group col-xs-4">
        <input type='checkbox' id='in_excento' name='in_excento'> Producto Excento de Iva
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_stock">Stock</label>
          <input type="text" class="form-control" id="nu_stock" name="nu_stock" aria-describedby="basic-addon1" required>
      </div>
          <div class="clearfix"></div>
      <hr>
      <h4>Sección de Precios </h4>
      <div class="form-group">
          <div class="col-xs-4">
            <label for="nu_precio1">Precio 1</label>
              <input type="text" class="form-control" id="nu_precio1" name="nu_precio1" aria-describedby="basic-addon1" required>
          </div>
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio2">Precio 2</label>
          <input type="text" class="form-control" id="nu_precio2" name="nu_precio2" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio3">Precio 3</label>
          <input type="text" class="form-control" id="nu_precio3" name="nu_precio3" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio4">Precio 4</label>
          <input type="text" class="form-control" id="nu_precio4" name="nu_precio4" aria-describedby="basic-addon1">
      </div>
      <div class="form-group col-xs-4">
        <label for="nu_precio5">Precio 5 o Precio Oferta</label>
          <input type="text" class="form-control" id="nu_precio5" name="nu_precio5" aria-describedby="basic-addon1">
      </div>
      <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
<div id="message"></div>
  <button type="button" class="btn btn-default" onClick="$('#modal_agregar_iframe').modal('hide');">Cancelar</button>
  <button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Agregar</button>
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
		.find('[name="co_categoria"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_categoria").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_linea.php", { id: id }, function(data){
					$("#co_linea").html(data);
					$('#co_linea').selectpicker('refresh');
					$('#co_linea').selectpicker('render');
					
					$("#co_sublineas").html('<option value=""></option>');
					$('#co_sublineas').selectpicker('refresh');
					$('#co_sublineas').selectpicker('render');
					
					$("#co_division").html('<option value=""></option>');
					$('#co_division').selectpicker('refresh');
					$('#co_division').selectpicker('render');

					$("#co_division2").html('<option value=""></option>');
					$('#co_division2').selectpicker('refresh');
					$('#co_division2').selectpicker('render');
					
					$("#co_division3").html('<option value=""></option>');
					$('#co_division3').selectpicker('refresh');
					$('#co_division3').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_categoria');
		})
		.end()

		.find('[name="co_linea"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_linea").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_sublinea.php", { id: id }, function(data){
					$("#co_sublineas").html(data);
					$('#co_sublineas').selectpicker('refresh');
					$('#co_sublineas').selectpicker('render');
					
					$("#co_division").html('<option value=""></option>');
					$('#co_division').selectpicker('refresh');
					$('#co_division').selectpicker('render');

					$("#co_division2").html('<option value=""></option>');
					$('#co_division2').selectpicker('refresh');
					$('#co_division2').selectpicker('render');
					
					$("#co_division3").html('<option value=""></option>');
					$('#co_division3').selectpicker('refresh');
					$('#co_division3').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_linea');
		})
		.end()
		
		.find('[name="co_sublineas"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_sublineas").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_division.php", { id: id }, function(data){
					$("#co_division").html(data);
					$('#co_division').selectpicker('refresh');
					$('#co_division').selectpicker('render');
					
					$("#co_division2").html('<option value=""></option>');
					$('#co_division2').selectpicker('refresh');
					$('#co_division2').selectpicker('render');
					
					$("#co_division3").html('<option value=""></option>');
					$('#co_division3').selectpicker('refresh');
					$('#co_division3').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_sublineas');
		})
		.end()
		
		.find('[name="co_division"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_division").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_division2.php", { id: id }, function(data){
					$("#co_division2").html(data);
					$('#co_division2').selectpicker('refresh');
					$('#co_division2').selectpicker('render');
					
					$("#co_division3").html('<option value=""></option>');
					$('#co_division3').selectpicker('refresh');
					$('#co_division3').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_division');
		})
		.end()
		
		.find('[name="co_division2"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
				id=document.getElementById("co_division2").value;
				//alert(id);
				
				$.post("../../funciones_ajax/combos/combo_division3.php", { id: id }, function(data){
					$("#co_division3").html(data);
					$('#co_division3').selectpicker('refresh');
					$('#co_division3').selectpicker('render');
					//alert(data);
				}); 
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_division2');
		})
		.end()
		.find('[name="co_division3"]')
            .selectpicker({
				  style: 'btn-default',
				  showSubtext: true
			})
            .change(function(e) {
                $('#frm_agregar_producto').formValidation('revalidateField', 'co_division3');
		})
		.end()
		.find('#nu_precio1, #nu_precio2, #nu_precio3, #nu_precio4, #nu_precio5').mask('000000000000000.00', {reverse: true}).end()
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
			nb_productos: {
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
			},
			co_linea: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_sublineas: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_division: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			/*co_division2: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},
			co_division3: {
				validators: {
					notEmpty: {
						message: 'Campo requerido'
					}
				}
			},*/
			nu_stock: {
				  validators: {
					  integer: {
						  message: 'Solo números enteros',
					  },
					  notEmpty: {
							message: 'Campo requerido'
						}
				  }
			  },
			nu_precio1: {
				  validators: {
					  notEmpty: {
							message: 'Campo requerido'
					  }
				  }
			},
			nu_precio2: {
				  validators: {
					  notEmpty: {
							message: 'Campo requerido'
					  }
				  }
			},
			nu_precio3: {
				  validators: {
					  notEmpty: {
							message: 'Campo requerido'
					  }
				  }
			},
			nu_precio4: {
				  validators: {
					  notEmpty: {
							message: 'Campo requerido'
					  }
				  }
			},
			nu_precio5: {
				  validators: {
					  notEmpty: {
							message: 'Campo requerido'
					  }
				  }
			},
			tx_descripcion: {
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
			$('#frm_agregar_producto').submit(function(event) {
				var formData = {
					'nb_productos'	: $('#nb_productos').val(),
					'co_categoria'	: $('#co_categoria').val(),
					'co_linea'		: $('#co_linea').val(),
					'co_sublineas'	: $('#co_sublineas').val(),
					'co_division'	: $('#co_division').val(),
					/*'co_division2'	: $('#co_division2').val(),
					'co_division3'	: $('#co_division3').val(),*/
					'tx_descripcion': $('#tx_descripcion').val(),
					'in_excento'	: $('#in_excento').val(),
					'nu_stock'		: $('#nu_stock').val(),
					'nu_precio1'	: $('#nu_precio1').val(),
					'nu_precio2'	: $('#nu_precio2').val(),
					'nu_precio3'	: $('#nu_precio3').val(),
					'nu_precio4'	: $('#nu_precio4').val(),
					'nu_precio5'	: $('#nu_precio5').val(),
				};
			
				// process the form
				$.ajax({
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