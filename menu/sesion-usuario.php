<?php
include ("../inic/config.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inicio de Sesion</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<form method="post" action="sesion-usuario.php" id="frm_login" name="frm_login">
    <div class="modal-body">
    <?php
	if($error==1){
	 echo $mensaje="<div class='alert alert-danger aviso-error'>Clave o Contraseña Incorrecta</div>";	//coloca aqui mensaje de entrada erronea
	}
	?>
          <div class="form-group">
          	<div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <label for="nb_usuario">E-mail</label>
                    <input type="text" class="form-control" id="nb_usuario" name="nb_usuario" placeholder="Enter email" required>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <label for="tx_clave">Contraseña</label>
                    <input type="password" class="form-control" id="tx_clave" name="tx_clave" placeholder="Password" required>
                    <a class='btn btn-link' onclick="olvido_contra();">¿Olvidó Contraseña?</a>
                  </div>
          	</div>
          </div>
    </div>
    <div class="clearfix"></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default hide-modal" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="login" name="login">Entrar</button>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	setTimeout(function(){
	  $("div.aviso-error").fadeOut("slow", function () {
	  $("div.aviso-error").remove();
		setTimeout(function () {
				$(".form-group").show();
			}, 2000);
		  });
		
	}, 2000);
});
$("#ventana").ready(function() {
  $('#precarga').hide();
});
function error_contrasena() {
	$(".form-group").hide();
}
</script>
</body>
</html>