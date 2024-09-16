<?php 
//include ("../../../inic/dbcon.php");
//include ("../../../inic/session.php");
	
if (isset($_POST['sw'])){ $sw = $_POST['sw'];}
if (isset($_GET['sw'])){ $sw = $_GET['sw'];}
//echo $sw;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Estadisticas</title>
<style>

</style>
</head>
<body>
<div class="container-fluid">
  <h2>Estadisticas</h2>
    <ul class="nav nav-tabs" id="myTab">
      <li><a href="#tab1" data-toggle="tab">Productos Mas vendidos</a></li>
      <li><a href="#tab2" data-toggle="tab">Ventas</a></li>
      <li><a href="#tab3" data-toggle="tab">Pedidos</a></li>
    </ul>
    
    <!--TABLA Mas vendidos-->
      <div class="tab-content">
		  <?php 
          if ($sw==0){
            $estructura1="<div class='tab-pane active' id='tab1'>"; 
          }else{
             $estructura1="<div class='tab-pane' id='tab1'>"; 
          }
          echo $estructura1;
          ?>
          <!--<div class="tab-pane active" id="tab1">-->
          	  <div style="padding:5px;"></div>
              <div id="cont_mas_vendido">
                <?php 
                if ($sw==0){
					include ("ficha_pro_vendidos.php");
                }
                ?>
              </div>
          </div>
          
          <!--TABLA asignar Ventas-->
          <?php 
          if ($sw==1){
            $estructura2="<div class='tab-pane active' id='tab2'>"; 
          }else{
             $estructura2="<div class='tab-pane' id='tab2'>"; 
          }
          echo $estructura2;
          ?>
          <!--<div class="tab-pane" id="tab2">-->
              <div style="padding:5px;"></div>
              <div id="cont_ventas">
                <?php 
                if ($sw==1){
                   include ("ficha_ventas.php"); 
                }
                ?>
              </div>
          </div>
          
          <!--TABLA pendiente de Pedidos-->
          <?php 
          if ($sw==2){
            $estructura3="<div class='tab-pane active' id='tab3'>"; 
          }else{
             $estructura3="<div class='tab-pane' id='tab3'>"; 
          }
          echo $estructura3;
          ?>
          <!--<div class="tab-pane" id="tab3">-->
              <div style="padding:5px;"></div>
              <div id="cont_pedidos">
                <?php 
                if ($sw==2){
                    include ("ficha_pedidos.php");
                }
                ?>
              </div>
          </div>
      </div>
      <div id="funciones"></div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
		var pestana=e.target;
		//alert(pestana);
		micadena=String(e.target);
		//alert(micadena);
		longitud=micadena.length;
		//longitud=longitud-4;
		res= micadena.substring(longitud-4,longitud);
		console.log(res);
	
		if (res=="tab1"){
			cambio_serv('../pages/fichas/ficha_pro_vendidos.php','cont_mas_vendido');
		}
		if (res=="tab2"){
			cambio_serv('../pages/fichas/ficha_ventas.php','cont_ventas');
		}
		if (res=="tab3"){
			cambio_serv('../pages/fichas/ficha_pedidos.php','cont_pedidos');
		}
	});
	$('#myTab li:eq(<?php echo $sw;?>) a').tab('show');
	
	function cambio_serv(ruta,contenedor) {
		$( "#"+contenedor ).load( ruta, function() {
			$('#page-loader').fadeOut(500);
			console.log('cambio');
		});
	};	
});
</script>
</body>
</html>