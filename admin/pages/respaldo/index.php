<?php 
	include ("../../inic/dbcon.php");
	//include ("../../inic/session.php");
	@session_start();
	
	if ($_SESSION['co_nivel_usuario']!='1'){	
		header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."/menu");
	}
	
if (isset($_POST['btn_general'])) {
	$sql="UPDATE tg004_configuracion SET tx_titulo_tienda='".$_POST['tx_titulo_tienda']."',tx_nombre_empresa='".$_POST['tx_nombre_empresa']."',tx_rif='".$_POST['tx_rif']."',tx_pie='".$_POST['tx_pie']."',co_monedas='".$_POST['co_monedas']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_clientes'])) {
	if ($_POST['in_nuevos_clientes']=="on"){
		$in_nuevos_clientes=1;
	}else{
		$in_nuevos_clientes=0;
	}
	
	if ($_POST['in_generar_clave']=="on"){
		$in_generar_clave=1;
	}else{
		$in_generar_clave=0;
	}
	
	if ($_POST['in_usuarios_anonimos']=="on"){
		$in_usuarios_anonimos=1;
	}else{
		$in_usuarios_anonimos=0;
	}
	
	$sql="UPDATE tg004_configuracion SET in_nuevos_clientes='".$in_nuevos_clientes."',tx_formato='".$_POST['tx_formato']."',co_tpcliente='".$_POST['co_tpcliente']."',co_vendedor='".$_POST['co_vendedor']."',in_generar_clave='".$in_generar_clave."',in_usuarios_anonimos='".$in_usuarios_anonimos."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_productos'])) {
	if ($_POST['in_destacados']=="on"){
		$in_destacados=1;
	}else{
		$in_destacados=0;
	}
	
	if ($_POST['in_stock_cero']=="on"){
		$in_stock_cero=1;
	}else{
		$in_stock_cero=0;
	}
	
	$sql="UPDATE tg004_configuracion SET nu_mostrar_precios='".$_POST['nu_mostrar_precios']."',nu_mostrar_cantidad='".$_POST['nu_mostrar_cantidad']."',nu_cantidad_stock='".$_POST['nu_cantidad_stock']."',tx_etiqueta_cero='".$_POST['tx_etiqueta_cero']."',tx_etiqueta_critico='".$_POST['tx_etiqueta_critico']."',tx_etiqueta_superior='".$_POST['tx_etiqueta_superior']."',in_destacados='".$in_destacados."',nu_destacados='".$_POST['nu_destacados']."',nu_imagenes_pro='".$_POST['nu_imagenes_pro']."',nu_productos_pag='".$_POST['nu_productos_pag']."',in_stock_cero='".$in_stock_cero."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_division'])) {
	if ($_POST['in_categorias']=="on"){
		$in_categorias=1;
	}else{
		$in_categorias=0;
	}
	if ($_POST['in_lineas']=="on"){
		$in_lineas=1;
	}else{
		$in_lineas=0;
	}
	if ($_POST['in_sublineas']=="on"){
		$in_sublineas=1;
	}else{
		$in_sublineas=0;
	}
	
	$sql="UPDATE tg004_configuracion SET in_categorias='".$in_categorias."',in_lineas='".$in_lineas."',in_sublineas='".$in_sublineas."',tx_categorias='".$_POST['tx_categorias']."',tx_lineas='".$_POST['tx_lineas']."',tx_sublineas='".$_POST['tx_sublineas']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_carrito'])) {
	if ($_POST['in_img_productocarrito']=="on"){
		$in_img_productocarrito=1;
	}else{
		$in_img_productocarrito=0;
	}
	if ($_POST['in_iva']=="on"){
		$in_iva=1;
	}else{
		$in_iva=0;
	}
	if ($_POST['in_deposito']=="on"){
		$in_deposito=1;
	}else{
		$in_deposito=0;
	}
	if ($_POST['in_credito']=="on"){
		$in_credito=1;
	}else{
		$in_credito=0;
	}
	
	$sql="UPDATE tg004_configuracion SET in_img_productocarrito='".$in_img_productocarrito."',in_iva='".$in_iva."',in_deposito='".$in_deposito."',in_credito='".$in_credito."',tx_correo_pedidos='".$_POST['tx_correo_pedidos']."',tx_formato_pedido='".$_POST['tx_formato_pedido']."',tx_condicion_pago='".$_POST['tx_condicion_pago']."',tx_iva='".$_POST['tx_iva']."',tx_titular='".$_POST['tx_titular']."',tx_vencimiento='".$_POST['tx_vencimiento']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;
	
	$result5 = mysqli_query($link,"UPDATE tg003_cuentas SET in_activa=0");
	//$cod5 = mysql_fetch_array($result5);
	mysqli_query($link,$result5);
	
	for ($i =0; $i <= count($_POST['co_cuentas']); $i++) {			
			$sql2="UPDATE tg003_cuentas SET in_activa=1 WHERE co_cuentas='".$_POST['co_cuentas'][$i]."'";
			mysqli_query($link,$sql2);
			//echo "<br>".$sql2;
	}
}

if (isset($_POST['btn_contacto'])) {
	if ($_POST['in_mapa']=="on"){
		$in_mapa=1;
	}else{
		$in_mapa=0;
	}
	
	$sql="UPDATE tg004_configuracion SET in_mapa='".$in_mapa."',tx_direccion='".$_POST['tx_direccion']."',tx_telefono='".$_POST['tx_telefono']."',tx_correo_contacto='".$_POST['tx_correo_contacto']."',tx_coordenadas='".$_POST['tx_coordenadas']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_contenido_terminos'])) {
	$sql="UPDATE tg004_configuracion SET tx_contenidos='".$_POST['tx_contenidos']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_publicidad'])) {
	if ($_POST['in_publicidad']=="on"){
		$in_publicidad=1;
	}else{
		$in_publicidad=0;
	}
	
	$sql="UPDATE tg004_configuracion SET in_publicidad='".$in_publicidad."',tx_linkpublicidad='".$_POST['tx_linkpublicidad']."',tx_linkpublicidad2='".$_POST['tx_linkpublicidad2']."',tx_linkpublicidad3='".$_POST['tx_linkpublicidad3']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_sliders'])) {
	$sql="UPDATE tg004_configuracion SET tx_link1='".$_POST['tx_link1']."',tx_tbanner1='".$_POST['tx_tbanner1']."',tx_link2='".$_POST['tx_link2']."',tx_tbanner2='".$_POST['tx_tbanner2']."',tx_link3='".$_POST['tx_link3']."',tx_tbanner3='".$_POST['tx_tbanner3']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}

if (isset($_POST['btn_resalta_cat'])) {
	$sql="UPDATE tg004_configuracion SET nu_categorias='".$_POST['nu_categorias']."',co_cat1='".$_POST['co_cat1']."',co_cat2='".$_POST['co_cat2']."',co_cat3='".$_POST['co_cat3']."',co_cat4='".$_POST['co_cat4']."',co_cat5='".$_POST['co_cat5']."',co_cat6='".$_POST['co_cat6']."',tx_descat1='".$_POST['tx_descat1']."',tx_descat2='".$_POST['tx_descat2']."',tx_descat3='".$_POST['tx_descat3']."',tx_descat4='".$_POST['tx_descat4']."',tx_descat5='".$_POST['tx_descat5']."',tx_descat6='".$_POST['tx_descat6']."' WHERE co_configuracion ='1'";	
	mysqli_query($link,$sql);
	//echo $sql;	
}
	unset($_SESSION['params']);
	$respar = mysqli_query($link,"SELECT * FROM tg004_configuracion");
	$_SESSION['params'] = mysqli_fetch_array($respar);
?>

<!doctype html>
<html><head>
<meta charset="utf-8">
<title>.::Admin Panel::. <?php echo $_SESSION['params']['tx_titulo_tienda'];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../../img/iconBD.png" />
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../css/upload/fileinput.css">
<link rel="stylesheet" type="text/css" href="../../css/select/bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="../../css/select/ajax-bootstrap-select.css">
<link rel="stylesheet" type="text/css" href="../../css/datatables/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../../css/dialogbox/bootstrap-dialog.min.css">
<link rel="stylesheet" type="text/css" href="../../css/editor/summernote.css">
<link rel="stylesheet" type="text/css" href="../../css/validator/formValidation.min.css">
<link rel="stylesheet" type="text/css" href="../../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="../css/morris.css">
<style type="text/css">
body { padding-bottom: 70px;
 }
</style>
</head>

<body>
<nav class="navbar navbar-default navbar-static-top"><!--BOTONERA DE Usuario-->
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-usuario">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand"><i class="fa fa-shopping-cart"></i> <?php echo $_SESSION['params']['tx_nombre_empresa'];?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menu-usuario">
		<div class="" role="group" aria-label="Menu del Usuario">
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/inicio.php','cont');">
          <i class="fa fa-cogs fa-2x"></i> <h5>Configuración</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/clientes.php','cont');">
          <i class="fa fa-users fa-2x"></i> <h5>Clientes</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/pedidos.php','cont');">
          <i class="fa fa-tablet fa-2x"></i> <h5>Pedidos</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/clasificaciones.php','cont');">
          <i class="fa fa-sitemap fa-2x"></i> <h5>Clasificaciones</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/productos.php','cont');">
          <i class="fa fa-archive fa-2x"></i> <h5>Productos</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/vendedores.php','cont');">
          <i class="fa fa-male fa-2x"></i> <h5>Vendedores</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/banca.php','cont');">
          <i class="fa fa-money fa-2x"></i> <h5>Banca</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/transporte.php','cont');">
          <i class="fa fa-car fa-2x"></i> <h5>Transporte</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/divisiones.php','cont');">
          <i class="fa fa-sitemap fa-2x"></i> <h5>Divisiones</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/buscar_avan.php','cont');">
          <i class="fa fa-search fa-2x"></i> <h5>Búsqueda</h5>
          </button>
          <button type="button" class="btn btn-default navbar-btn" href="javaScript:;" onclick="cambio('fichas/estadisticas.php','cont');">
          <i class="fa fa-line-chart fa-2x"></i> <h5>Estadísticas</h5>
          </button>
        </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<nav class="navbar navbar-default navbar-static-top" id="barrasupgeneral" style="margin-bottom:10px;">
  <div class="container">
    <p class="navbar-text navbar-left">Panel de Administración</p>
    <p class="navbar-text navbar-right">Sesión de EL NOMBRE</p>
  </div>
</nav>

<div class="container-fluid" id="cont"><!--CUERPO DE LA PAGINA--><div id="messages"></div></div>

<nav class="navbar navbar-default navbar-fixed-bottom"><!--BOTONERA DE BYDIGITAL-->
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-bydigital">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand"><i class="fa fa-shopping-cart"></i> <?php echo $_SESSION['params']['tx_titulo_tienda'];?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="menu-bydigital">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ByDigital <span class="caret"></span></a>
          <!--<ul class="dropdown-menu" role="menu">
            <li><a data-title='Contacto a Disenosos.com' data-height='420px' href='javaScript:;' onclick="modal_contacto_sos();" data-toggle='modal' data-target='#modal_det_iframe'>Contactenos</a></li>
          </ul>-->
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Usuario<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a class='btn modalButton' href='../../menu/index.php?logout=1'>Salir</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- MODAL --> 
<div class="modal fade" id="modal_det_iframe" tabindex="-1" role="dialog" aria-labelledby="modal_det_iframe">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
		</div>
        <div id="precarga"><div class="modal-body"><p class="text-center"><i class="fa fa-refresh fa-spin fa-4x"></i></p></div></div>
        <div id="ventana"></div>
    </div>
  </div>
</div>
<!--HASTA AQUI LA MODAL-->
<script src="../js/charts/raphael-min.js"></script>
<script src="../../js/jquery-1.11.1.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/select/bootstrap-select.js"></script>
<script src="../../js/select/ajax-bootstrap-select.min.js"></script>
<script src="../../js/dialogbox/bootstrap-dialog.min.js"></script>
<script src="../../js/datatables/datatables.min.js"></script>
<script src="../../js/mask/jquery.mask.min.js"></script>
<script src="../../js/editor/summernote.min.js"></script>
<script src="../../js/editor/lang/summernote-es-ES.min.js"></script>
<script src="../js/charts/morris.min.js"></script>
<script src="../../js/validator/formValidation.min.js"></script>
<script src="../../js/validator/framework/bootstrap.min.js"></script>
<script src="../../js/validator/language/es_ES.js"></script>
<script type="text/javascript">
$('#modal_det_iframe').on('hidden.bs.modal', function () {
	$('#precarga').show();
	$(".modal-dialog").removeClass( "modal-md modal-lg modal-sm" );
	$(".modal-dialog").addClass( "modal-md" );
	$('#modal_det_iframe').modal('hide');
	$( "#ventana" ).empty();
	console.log('modal closed')
});
$('#modal_det_iframe').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var titulo = button.data('title')
	var modal = $(this)
	modal.find('.modal-title').text(titulo)
});
function cambio(ruta,contenedor) {
	  $( "#cont" ).load( ruta, function() {
		  if($(window).width() <= 1024){
			  $('.row-offcanvas').toggleClass('active');
			  $('.left-side').removeClass("collapse-left");
			  $(".right-side").removeClass("strech");
			  $('.row-offcanvas').toggleClass("relative");
			  //alert('1');
		  }
	  });
};
function modal_contacto_sos() {
		$(".modal-dialog").addClass( "modal-md" );
		$("#modal_det_iframe iframe").attr({'src':'fichas/escribir_mensaje_sos.php'});
	}
$(document).ready(function() {
	cambio('fichas/inicio.php','cont');
});
	//MASCARA
	$('#tx_rif').mask('Z-NNNNNNNN-N', {translation: {'Z': {pattern: /[V,v,j,J,G,g,e,E]/, optional: false},'N': {pattern: /[0-9]/}}});
	$('#tx_formato_pedido').mask('ZZZZZ-NNNNN', {translation: {'Z': {pattern: /[A-Za-z]/, optional: false},'N': {pattern: /[0]/}}});
	$('#tx_telefono').mask('(0000)000.00.00 / (0000)000.00.00 / (0000)000.00.00 / (0000)000.00.00')
</script>
<script src="../../js/upload/fileinput.min.js"></script>
<script src="../../js/upload/es.js"></script>
</body>
</html>