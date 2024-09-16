<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$id."'");
$row = mysqli_fetch_array($result);

$cantidad_img=$_SESSION['params']['nu_imagenes_pro'];
$suma=0;
for ($i = 2; $i <= $cantidad_img; $i++){
  $nombre_fichero = '../../../img_productos/p'.$id.'-'.$i.'.jpg';
  if (file_exists($nombre_fichero)) {
	  $suma=$suma+1;
  }
}
$suma=$suma+1;//por la imagen numero 1 la principal
$cantidad=$cantidad_img-$suma;
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Agregar imagen producto</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" id="frm_agregar" name="frm_agregar">
<div class="modal-body">
      <!--IMAGENES-->
      <h4>Imagen Principal</h4>
      <div class="form-group col-xs-9">
		<input type="file" id="img_principal" name="img_principal"> 
        <div id="erroralcargar"></div>
        <div id="status"></div>
      </div>
      <?php
	  	$nombre_fichero1 = '../../../img_productos/p'.$id.'-1.jpg';
		if (file_exists($nombre_fichero1)) {
			$nombre_fichero1="p".$id."-1.jpg"."?x==".md5(time());
			$nombre_fichero12="p".$id."-1.jpg";
			$principal="<div class='form-group col-xs-3'><button type='button' class='btn btn-xs btn-danger' style='position: absolute; top: 5px; left:5px;' onclick=\"eliminar_princ('".$nombre_fichero12."',1,".$id.");\">Eliminar</button><img src='../../img_productos/".$nombre_fichero1."' class='img-responsive' style='max-height:100px;'/></div>";
		}else{
			$nombre_fichero1="defpro.gif";
			$principal="<div class='form-group col-xs-3'><img src='../../../img_productos/".$nombre_fichero1."' class='img-responsive' style='max-height:100px;'/></div>";
		}
		
		echo $principal;
	  
	  if ($cantidad>=1){
		  $estructura="<div class='clearfix'></div><hr></hr><h4>Otras Imagenes</h4>
					  <div class='form-group col-xs-12'>
							<input id='images' name='images[]' type='file' multiple=true class='file-loading'>
							<div id='erroralcargar2' class='help-block'></div>
					  </div>";
					  
		echo $estructura;
	  }
	  
			for ($i = 2; $i <= $cantidad_img; $i++){
				$nombre_fichero = '../../../img_productos/p'.$id.'-'.$i.'.jpg';
				$archivo="p".$id."-".$i.".jpg";
					if (file_exists($nombre_fichero)) {
						//echo "El fichero ".$nombre_fichero." existe";
						$nombre_fichero2 = '../../img_productos/p'.$id.'-'.$i.'.jpg'."?x==".md5(time());
						$nombre_fichero22 = '../../img_productos/p'.$id.'-'.$i.'.jpg';
						
						$imagenes.="<div class='form-group col-xs-3'>
									  <button type='button' class='btn btn-xs btn-danger' style='position: absolute; top: 5px; left:5px;'  onclick=\"eliminar('".$nombre_fichero22."',".$i.",".$id.");\">Eliminar</button>
										<img src='".$nombre_fichero2."' class='img-responsive' style='max-height:100px;'/>           
									  </div>";
					}else{
						//echo "El fichero ".$nombre_fichero." no existe";
						$imagenes.="<div class='form-group col-xs-3'>
									  <img src='../../img_productos/defpro.gif' class='img-responsive' style='max-height:100px;'/>
									</div>";
					}
			}
			echo $imagenes;
		?>
      <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" onClick="$('#modal_det_iframe').modal('hide');">Cancelar</button>
<!--  <button type="submit" class="btn btn-primary" data-dismiss="modal" id="btn_enviar" name="btn_enviar">Agregar</button>-->
</div>
<div id="funciones"></div>
</form>
<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
$("#images").fileinput({
	showCaption: false,
	previewFileType: "image",
	browseClass: "btn btn-success",
	browseLabel: " Buscar Foto",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i> ',
	uploadClass: "btn btn-info",
	uploadLabel: "Cargar",
	uploadIcon: '<i class="glyphicon glyphicon-upload"></i> ',
	allowedFileExtensions: ["jpg","png","gif","bmp"],
	elErrorContainer: "#erroralcargar2",
	removeLabel: "Quitar",
	msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
	mainClass: "input-group-sm",
	//maxFileSize: 100,
	maxFileCount: <?php echo $cantidad;?>,
	msgLoading: 'Cargando &hellip;',
	msgProgress: 'Cargando archivo {index} de {files} - {name} - {percent}% completado.',
	uploadAsync: false,
	uploadUrl: "fichas/procesarArchivos.php",
	uploadExtraData: function() {
            return {
				id: $("#id").val(),
                opc: "varios"
            };
     },
	fileActionSettings:     {
    uploadClass: 'btn btn-xs btn-default hidden',
    uploadTitle: 'Upload file',
    }	 
});
$('#images').on('filebatchuploadcomplete', function(event, files, extra) {
	id=document.getElementById('id').value;
	location.href='../pages/index.php';
	parent.parent.parent.cambio('fichas/productos.php','cont');
	console.log('File batch upload complete');
});


$("#img_principal").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: "fichas/procesarArchivos.php",
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status',
maxFileCount: '1',
msgFilesTooMany:'El numero de imagenes a cargar ({n}) supera el limite maximo de {m}. Reintente nuevamente',
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
uploadExtraData: function() {
            return {
				id: $("#id").val(),
                opc: "unico"
            };
     }
});
$('#img_principal').on('filebatchuploadcomplete', function(event, files, extra) {
	id=document.getElementById('id').value;
	location.href='../pages/index.php';
	parent.parent.parent.cambio('fichas/productos.php','cont');
	console.log('File batch upload complete');
});

//ELIMINAR IMAGENES
function eliminar(nombre,num,id) {
	//alert(num);
	//alert(nombre);
	//alert(id);
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea eliminar la imagen de este producto?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						//alert("si");
						id=document.getElementById('id').value;
						
						var parametros = {
								"nombre" : nombre,
								"id" : id,
								"num" : num
						};

						$.ajax({
								data:  parametros,
								url:   '../../funciones_ajax/eliminar_img_productos.php?num='+num+'&nombre='+nombre+'&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										//alert("borrado");
										parent.cambio('fichas/productos.php','cont');
									
										$('#modal_det_iframe #ventana').load('fichas/agregar_img_producto.php?id='+id);
								}
						});
						dialogItself2.close();
					}
			}, {
					label: 'No',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });
}
//ELIMINAR IMAGENES
function eliminar_princ(nombre,num,id) {
	//alert(num);
	//alert(nombre);
	//alert(id);
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_INFO,
			title: 'Confirmación',
            message: '¿Seguro desea eliminar la imagen principal?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						//alert("si");
						id=document.getElementById('id').value;
						//location.href='agregar_img_producto.php?id='+id;
						var parametros = {
								"nombre" : nombre,
								"id" : id,
								"num" : num
						};

						$.ajax({
								data:  parametros,
								url:   '../../funciones_ajax/eliminar_img_productos_princ.php?num='+num+'&nombre='+nombre+'&id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										//alert("borrado");
										//parent.cambio('fichas/productos.php','cont');
										$('#modal_det_iframe #ventana').load('fichas/agregar_img_producto.php?id='+id);
								}
						});
						dialogItself2.close();
					}
			}, {
					label: 'No',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });
}
</script>
</body>
</html>