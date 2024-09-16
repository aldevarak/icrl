<?php
error_reporting(E_ALL ^ E_NOTICE);
@session_start();

if (isset($_POST['enviado'])){ $enviado = $_POST['enviado'];}
if (isset($_GET['enviado'])){ $enviado = $_GET['enviado'];}

if ($enviado=='1'){
	$mensaje="<div>Mensaje Enviado</div>";
	echo $mensaje;	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Contacto</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    
  </head>
  <body>
<div class="container-fluid">
      <address class="col-md-5">
          <div id="address" class="col-md-12">
            <h2>Nuestra Ubicación</h2>
            <address>
            <strong>Dirección</strong><br>
                <?php echo $_SESSION['params']['tx_direccion'];?>
                <a data-title='Nuestra Ubicación' class='btn btn-xs btn-default' data-height='650px' href='javaScript:;' onclick="modal_mapa();" data-toggle='modal' data-target='#modal_det_iframe'>Ver en Mapa</a><br>
                <abbr>Telf:</abbr> <?php echo $_SESSION['params']['tx_telefono'];?>
           </address>
          </div>
      </address>
  <div class="col-md-7">
  <form class="form-horizontal" name="commentform">
        <div class="form-group">
        	<div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" id="tx_nombre" name="tx_nombre" placeholder="Nombre" required/>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="tx_telefono" name="tx_telefono" placeholder="Teléfono"/>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" id="tx_email" name="tx_email" placeholder="Su correo" required>
                </div>
        	</div>
        </div>
        <div class="form-group">
        	<div class="row">
                <div class="col-md-12">
                    <textarea rows="6" class="form-control" id="tx_mensaje" name="tx_mensaje" placeholder="Su mensaje"></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <button type="button" value="Submit" id="btn_correo" name="btn_correo" class="btn btn-warning pull-right" onClick="correo();">Enviar</button>
            </div>
        </div>

        <iframe src="<?php echo $_SESSION['params']['tx_coordenadas'];?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


    </form>
    </div><!-- /col -->
</div><!-- /col -->
<div id="funciones"></div>
<!-- MODAL --> 
<div class="modal fade" id="modal_mapa_iframe" name="modal_mapa_iframe" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
         <div class="modal-content">
			<div class='modal-header'>
             	<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            	<h4 class='modal-title' id='myModalLabel'>Google Maps</h4>
			</div>
            <!--<div id="loadImg"><div class="modal-body"><p class="text-center"><i class="fa fa-refresh fa-spin fa-4x"></i></p></div></div>-->
        	<iframe id="terminos" frameborder="0" width="100%"></iframe>
        </div>
    </div>
</div>
<!--HASTA AQUI LA MODAL-->
<script type="text/javascript">
function modal_mapa() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( '../fichas/googlemaps.php' );
};

function correo() {
	nombre=document.getElementById('tx_nombre').value;
	telefono=document.getElementById('tx_telefono').value;
	email=document.getElementById('tx_email').value;
	mensaje=document.getElementById('tx_mensaje').value;
	
	var parametros = {
			"nombre": nombre,
			"telefono": telefono,
			"email": email,
			"mensaje" : mensaje
	};
	
	$.ajax({
			data:  parametros,
			url:   '../funciones_ajax/enviar_correo.php?nombre='+nombre+'&telefono='+telefono+'&email='+email+'&mensaje='+mensaje,
			type:  'post',
			beforeSend: function () {
					$("#funciones").html("Procesando, espere por favor...");
			},
			success:  function (response) {
					$("#funciones").html(response);
					parent.cambio('../fichas/contacto.php?enviado=1','cont');
			}
	});
}
</script>
  </body>
</html>
