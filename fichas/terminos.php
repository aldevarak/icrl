<?php 
include ("../inic/dbcon.php");
@session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Terminos y condiciones</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
</style>
</head>

<body>
<div class="modal-body">
<?php
echo $_SESSION['params']['tx_contenidos'];
?>
<!--AQUI VA EL CONTENIDO-->
</div>
<script type="text/javascript">
$("#ventana").ready(function() {
  $('#precarga').hide();
});
</script>
</body>
</html>