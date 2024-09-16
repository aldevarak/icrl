<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Descripcion del producto</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_agregar_desc" name="frm_agregar_desc">
<div class="modal-body">
	<div class="form-group">
      <label for="nb_sector">Escribir Descripción</label>
      <textarea name="tx_descripcion_web" id="tx_descripcion_web" class="summernote"><?php echo $row['tx_descripcion_web'];?></textarea>
    </div>
    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" onClick="$('#modal_det_iframe').modal('hide');">Cancelar</button>
	<button type="submit" class="btn btn-primary" id="btn_enviar" name="btn_enviar">Guardar</button>
</div>
</form>
<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
$("#tx_descripcion_web")
.summernote({
codemirror: {
  theme: 'monokai'
},
  toolbar: [
	// [groupName, [list of button]]
	['style', ['bold', 'italic', 'underline', 'clear']],
	['fontsize', ['fontsize']],
	['color', ['color']],
	['para', ['ul', 'ol', 'paragraph']],
	['height', ['height']]
  ],
  height: 300,                 // set editor height

  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor

  focus: true,  
  lang: 'es-ES',               // set focus to editable area after initializing summernote
  onkeydown:function(e){
		var num = $('.summernote').code().replace(/(<([^>]+)>)/ig,"").length;
		var key = e.keyCode;
		allowed_keys = [8, 37, 38, 39, 40, 46]
		if($.inArray(key, allowed_keys) != -1)
			return true
		else if(num > 10){
			e.preventDefault();
			e.stopPropagation()
			}
		}
})
$('#frm_agregar_desc').submit(function(event) {
	var formData = {
		'tx_descripcion_web'	: $('#tx_descripcion_web').val(),
		'id'	: $('#id').val(),
	};

	// process the form
	$.ajax({
		type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url         : 'fichas/editores/fun_agregar_descripcion.php', // the url where we want to POST
		data        : formData, // our data object
		dataType    : 'json', // what type of data do we expect back from the server
		encode      : true,
		ajaxStart : function(){
		 console.log(formData);
	   },
	   complete: function(){
		 parent.cambio('fichas/productos.php','cont');
		 console.log('aqui completo');
		 //$('#modal_agregar_iframe').modal('hide');
		 //$("#ventana").load( 'fichas/editores/fun_agregar_vendedor.php' );
	   }
	})
	// stop the form from submitting the normal way and refreshing the page
	event.preventDefault();
});
</script>
</body>
</html>