<?php 
	include ("../inic/dbcon.php");
	@session_start();
	
	//echo $_SESSION['co_usuario'];
	
if ($_GET['logout']) {
   unset($_GET['logout']);
   session_unset();
   session_destroy();
   //header("Refresh: 2; URL=../admin/index.php");
	echo '<div style="width:400px; height:140px; position:fixed; top:50%; left:50%; margin-left: -200px; margin-top: -70px;"><img src="../img/cerrarsesion.gif" width="400px" height="139px"></div>';
	echo "<script type='text/javascript'> window.location='../index.php';</script>";
	exit();	   
}

//if (!isset($_SESSION['params']['co_configuracion'])) {
	unset($_SESSION['params']);
	$respar = mysql_query("SELECT * FROM tg004_configuracion",$link);
	$_SESSION['params'] = mysql_fetch_array($respar);
	//echo $_SESSION['params']['tx_tbanner1'];
//}

foreach ((array) $_SESSION['carrito'] as $i => $value) {
	$cantidad_carrito=$cantidad_carrito+$_SESSION['item'][$i];
}
$total=number_format($_SESSION['total'][1],2,",",".");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $_SESSION['params']['tx_titulo_tienda'];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../img/iconBD.png" />
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/dialogbox/bootstrap-dialog.css">
<link rel="stylesheet" type="text/css" href="../css/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/validator/formValidation.min.css">
<style type="text/css">
.breadcrumb {
  margin-bottom: 10px;
}
</style>
<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/nav-main.js"></script>
</head>

<body>
<div id="page-loader"><span class="preloader-interior"></span></div>
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
        <!--<div class="col-xs-10 col-sm-12 col-md-2 col-lg-2 text-center" style=\"background-image: url('".$nombre_fichero."');\"> AQUI COLOCA LA RUTA DEL LOGO QUE SE CARGARIA--> 
        <div class="col-xs-10 col-sm-12 col-md-2 col-lg-2 text-center">
			<img alt="Brand" src="../img/<?php echo $_SESSION['params']['tx_logo'];?>" class="img-responsive" style="margin: 0 auto; padding:5px;"> <!--ESTE LO PUEDES BORRAR LUEGO-->
		</div>
        <div class="col-xs-2 visible-xs"><!--SOLO SE VE EN PEQUEÑO-->
              <div class="btn-group btn-group-vertical" role="group" aria-label="...">
                  <button type="button" class="btn btn-default"><i class="fa fa-facebook-square"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-twitter"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-instagram"></i></button>
              </div>
        </div>
        <div class="col-xs-12 col-md-10 col-lg-10">
        <div class="navbar-header">
          <div class="row">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menusuperior">
                  	<span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              </button>
              <div class="col-xs-3 visible-xs">
                <a data-title='Inicio de Sesion' id='modalButtonsesionxs' name='modalButtonsesionxs' onclick="modal_sesionxs();" class='btn btn-link modalButton' href='javaScript:;' data-target='#modal_frame_sm' data-toggle='modal' data-height='265px' data-width='100%'><i class="fa fa-user"></i> Entrar</a>
              </div>
              <div class="col-xs-6 visible-xs">
                    <div class="btn-group">
                            <a type="button" id="tx_carrito" name="tx_carrito" class="btn btn-default btn-xs btn-cambio" aria-expanded="false" href="../fichas/carrito-total.php"><i class="fa fa-shopping-cart"></i> Ver Carrito</a>
                            
                            <?php
                            if (($_SESSION['co_nivel_usuario']=="2")||($_SESSION['co_nivel_usuario']=="3")){
                                $btn_pedidos="<button type='button' class='btn btn-danger btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                <span class='caret'></span>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                              <ul class='dropdown-menu dropdown-menu-right' role='menu'>
                                <li><a class='btn-cambio' href='../fichas/pedidos.php'>Ver Pedidos</a></li>
                              </ul>";
                              
                              echo $btn_pedidos;	
                            }
                            ?>
                    </div>
          	</div>
          </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menusuperior" style="padding-top:10px;">
                    <div class="nav">
                    <div class="row">
                    	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-horizontal">
                                <div class="input-group">
                                  <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Categorías <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                    <?php
										$sql_cate="SELECT * FROM tg007_categoria WHERE in_estatus='1'";
										$resultados_cate = mysql_query($sql_cate,$link);
										//echo $sql_des;
												
										while ($categorias = mysql_fetch_array($resultados_cate)) {
											$menu_cat.="<li><a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$categorias['co_categoria']."' onclick=\"lineas('div_linea.php?id=".$categorias['co_categoria']."','linea');$('#sublinea').empty();$('#division1').empty();$('#division2').empty();$('#division3').empty();menu_nav('".$categorias['nb_categoria']."')\">".$categorias['nb_categoria']."</a></li>";
										}
										echo $menu_cat;
									?>
                                    </ul>
                                  </div><!-- /btn-group -->
                                  <input type="text" id="tx_buscador" name="tx_buscador" class="form-control" aria-label="Buscador de elementos" onKeyPress="teclas(window.event.keyCode);"> <!--INPUT DE BUSCAR-->
                                  <span class="input-group-btn">
                                    <a class="btn btn-default btn-cambio" type="button" onclick="x=document.getElementById('tx_buscador').value;cambio('../fichas/buscar.php?bus='+x,'cont');" id="btn_buscar" name="btn_buscar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                  </span>
                                </div>
                            </div>
                        </div>
                    	<div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                        
                        <div class="btn-group">
                            <a type="button" id="tx_carrito" name="tx_carrito" class="btn btn-default btn-cambio" aria-expanded="false" href="../fichas/carrito-total.php"><i class="fa fa-shopping-cart"></i> Carrito <small><?php echo $cantidad_carrito;?> productos / <?php echo $total;?>Bsf</small></a>
                            
                            <?php
							if (($_SESSION['co_nivel_usuario']=="2")||($_SESSION['co_nivel_usuario']=="3")){
								$btn_pedidos="<button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                <span class='caret'></span>
                                <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                              <ul class='dropdown-menu dropdown-menu-right' role='menu'>
                                <li><a class='btn-cambio' href='../fichas/pedidos.php'>Ver Pedidos</a></li>
                              </ul>";
							  
							  echo $btn_pedidos;	
							}
							?>
                        </div>
                        	
                        </div>
                        <div class="col-sm-2 col-md-2 hidden-xs">
                            <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Acceso <span class="caret"></span>
                            </button>
                                <ul class="dropdown-menu" role="menu">
                                <?php
                                if (!isset($_SESSION['co_usuario'])){
									$estructura="<li><a data-title='Inicio de Sesion' id='modalButtonsesion' name='modalButtonsesion' onclick=\"modal_sesion();\" class='btn btn-link modalButton' href='javaScript:;' data-target='#modal_frame_sm' data-toggle='modal' data-height='265px' data-width='100%'>Iniciar Sesión</a></li>
                                <li class='divider'></li>
								<li><a onclick=\"modal_registrar();\" data-title='Registrar Usuario' id='modalButtonregi' name='modalButtonregi' class='btn btn-link modalButton' data-toggle='modal' data-target='#modal_frame_md' data-height='315px' data-width='100%'>Registrarse</a></li>
								<li>
								<a class='btn btn-link' onclick=\"olvido_contra();\">¿Olvidó Contraseña?</a>
								</li>";
								}else{
									if ($_SESSION['co_nivel_usuario']=="1"){
										$estructura="
								<li><a target='_blank' class='btn' href='../admin/pages/index.php'>Panel Administrativo</a></li>
								<li class='divider'></li>
								<li><a class='btn modalButton' href='../menu/index.php?logout=1'>Salir</a></li>
								";
									}else{
										$estructura="
										<li><a data-title='Perfil del Usuario' id='modalButtonperf' name='g' class='modalButtonperf' data-height='500px' href='javaScript:;' onclick=\"modal_perfil(".$_SESSION['co_usuario'].");\" data-toggle='modal' data-target='#modal_frame_lg'>Ver Perfil</a></li>
										<li class='divider'></li>
										<li><a href='../menu/index.php?logout=1'>Salir</a></li>";
									}
								}
								echo $estructura;
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                </div><!-- /.navbar-collapse -->
          </div><!-- /col -->
          </div>
          </nav>
          <div class="navbar navbar-default navbar-static-top">
            <div class="container">
            <div class="row" style="padding-top:10px;">
            <div class="col-lg-9 col-ms-10 col-sm-7" id="breadcrumbs">
                <ol class="breadcrumb hidden-xs hidden-sm">
                  <li><a href="javaScript:;" onclick="location.reload();">Inicio</a></li>
                </ol><!--FIN DE LOS BREADCRUMBS--><!--FIN DE LOS BREADCRUMBS--><!--FIN DE LOS BREADCRUMBS-->
            </div>
            <div class="col-lg-3 col-md-2 col-xs-12 text-center">
            	<div class="btn-group hidden-xs" role="group" aria-label="...">
                      <button type="button" class="btn btn-default"><i class="fa fa-facebook-square"></i></button>
                      <button type="button" class="btn btn-default"><i class="fa fa-twitter"></i></button>
                      <button type="button" class="btn btn-default"><i class="fa fa-instagram"></i></button>
                </div>
                <!--<div class="clearfix"></div>-->
                <div class="btn-group-vertical" role="group" aria-label="...">
              	<a  class='btn btn-xs btn-default btn-cambio' href='../fichas/contacto.php'>Contactenos</a>                
                  <a data-title="Terminos y Condiciones" id='modalButtonterms' name='modalButtonterms' class='btn btn-xs btn-default' data-height='500px' href='javaScript:;' onclick="modal_terminos();" data-toggle='modal' data-target='#modal_frame_lg'>Términos y Condiciones</a>
               </div>
            </div>
        	</div>
            </div>
  </div>
<!--MENU-->
	<div class="container">
		<div class="row">
        <div class="col-sm-3 col-md-3">
        
        <!--AVISO DEL IVA-->
        <?php
		if ($_SESSION['params']['in_iva']=="0"){
			$men_iva="<div class='col-sm-12'>
						<h5>Los Precios <span class='label label-default'>No Incluyen IVA</span></h5>
					</div>";	
		}else{
			$men_iva="<div class='col-sm-12'>
						<h5>Los Precios <span class='label label-default'>Incluyen IVA</span></h5>
					</div>";
		}
		echo $men_iva;
		?>        
        <div class="clearfix"></div>
        <!--AVISO DEL IVA-->
        
        <div id="MainMenu">
            <div>
            	<div class="list-group">
                      <div class="list-group-item active">Lineas</div>
                      <div id="linea">
                      </div>
                </div>
                <div class="list-group">
                      <div class="list-group-item active">Sub-Lineas</div>
                      <div id="sublinea">
                      </div>
                </div>
                <div class="list-group">
                      <div class="list-group-item active">Division 1</div>
                      <div id="division1">
                      </div>
                </div>
                <div class="list-group">
                      <div class="list-group-item active">Division 2</div>
                      <div id="division2">
                      </div>
                </div>
                <div class="list-group">
                      <div class="list-group-item active">Division 3</div>
                      <div id="division3">
                      </div>
                </div>
            </div>
        </div>
        <!--LOS MAS VENDIDOS-->
        <div class="col-md-12">
        <div class="panel panel-default">
  			<div class="panel-heading"><h3 class="panel-title">Los más Vendido</h3></div>
            <div class="panel-body" style="padding-top:5px;">
            <?php
			$sql_div="SELECT t2.*, COUNT(t1.co_productos) AS total FROM tr002_reng_pedidos AS t1 INNER JOIN tg013_productos AS t2 ON t1.co_productos=t2.co_productos GROUP BY t1.co_productos ORDER BY total DESC LIMIT 3";
			$resultados_des= mysql_query($sql_div,$link);
			
				while ($producto = mysql_fetch_array($resultados_des)) {
					//precio del producto
				if (isset($_SESSION['co_nivel_usuario'])){
					if ($_SESSION['co_nivel_usuario']=="1"){
						$precio1=$producto['nu_precio1'];
					}
					
					if ($_SESSION['co_nivel_usuario']=="2"){
						if ($_SESSION['cliente']['co_tpcliente']=='1'){
							$precio1=$producto['nu_precio1'];
						}
						if ($_SESSION['cliente']['co_tpcliente']=='2'){
							$precio1=$producto['nu_precio2'];
						}
						if ($_SESSION['cliente']['co_tpcliente']=='3'){
							$precio1=$producto['nu_precio3'];
						}
						if ($_SESSION['cliente']['co_tpcliente']=='4'){
							$precio1=$producto['nu_precio4'];
						}
					}
					
					if ($_SESSION['co_nivel_usuario']=="3"){
						$precio1=$producto['nu_precio1'];
					}
				}else{
					$precio1=$producto['nu_precio1'];	
				}
			
				$precio2=$producto['nu_precio5'];
				//hasta aqui determinar precio
				
				//determinar iva
				if($_SESSION['params']['in_iva']=="0"){
					$iva1=($precio1*$_SESSION['params']['tx_iva'])/100;
					$iva1=number_format($iva1,2);
					
					$iva2=($precio2*$_SESSION['params']['tx_iva'])/100;
					$iva2=number_format($iva2,2);
					
					$precio1=$precio1-$iva1;
					$precio2=$precio2-$iva2;
				}else{
					$iva1=($precio1*$_SESSION['params']['tx_iva'])/100;
					$iva1=number_format($iva1,2);
					
					$iva2=($precio2*$_SESSION['params']['tx_iva'])/100;
					$iva2=number_format($iva2,2);
					
					$precio1=$precio1+$iva1;
					$precio2=$precio2+$iva2;
				}
				//	
				
				$vendidos.="
					  <div class='col-sm-12'>
						  <div class='col-item'>";
					
					if ($producto['in_oferta']=="1"){
						$vendidos.="<img src='../img/oferta.png' class='col-xs-4 col-sm-7 etiqueta_produ' alt=''/>";
					}
					
					if ($producto['in_destacado']=="1"){
						$vendidos.="<img src='../img/destacado.png' class='col-xs-4 col-sm-7 etiqueta_produ' alt=''/>";
					}			
					
					$nombre_fichero = '../img_productos/p'.$producto['co_productos'].'-1.jpg';
					
					if (file_exists($nombre_fichero)) {
						$nombre_fichero_new = '../img_productos/p'.$producto['co_productos'].'-1.jpg?x=='.md5(time());
						
						$vendidos.="
								<div class='photo' style=\"background-image: url('".$nombre_fichero_new = '../img_productos/p'.$producto['co_productos'].'-1.jpg?x=='.md5(time())."');\"></div>";
					}else{
						$vendidos.="
								<div class='photo'></div>";
					}
					
					$vendidos.="			  
							  <div class='info'>
								  <div class='row'>
									  <div class='price col-md-12'>";
					
					$vendidos.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>";
					
					$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
					if ($opc_precio=="1"){
						if ($producto['in_oferta']=="1"){
							$vendidos.="<small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><h5 class='text-success'>Bs.F ".number_format($precio2,2,",",".")."</h5>";
						}else{
							$vendidos.="<h5 class='text-success'>Precio ".number_format($precio1,2,",",".")." Bs.F</h5><br>";
						}
					}
					
					if ($opc_precio=="2"){
						if (isset($_SESSION['co_nivel_usuario'])){
							if ($producto['in_oferta']=="1"){
								$vendidos.="<small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><h5 class='text-success'>Bs.F ".number_format($precio2,2,",",".")."</h5>";
							}else{
								$vendidos.="<h5 class='text-success'>Precio ".number_format($precio1,2,",",".")." Bs.F</h5><br>";
							}
						}
					}
					
					$vendidos.="
									  </div>
								  </div>
								  <div class='separator clear-left'>";
					
					if($producto['nu_stock']<=0){
						$vendidos.="
										  <p class='btn-add'><span class='label label-danger'>Agotado</span></p>";
					}else{
						if (($opc_precio=="1")||($opc_precio=="2")){
							$vendidos.="
										  <p class='btn-add hidden-xs'><i class='fa fa-shopping-cart'></i><a class='hidden-xs btn-cambio' href='../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar'>Agregar</a></p>
										  <p class='btn-add visible-xs-block'><a class='visible-xs-block btn-cambio' href='../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar' title='Agregar a carrito'><i class='fa fa-shopping-cart'></i></a></p>";
						}
					}
					
					$vendidos.="
									  <p class='btn-details'>
										  <i class='fa fa-list hidden-xs'></i><a class='hidden-xs btn-cambio' href='../fichas/detalles-pro.php?id=".$producto['co_productos']."'>Ver</a>
										  <a class='visible-xs-block btn-cambio' href='../fichas/detalles-pro.php?id=".$producto['co_productos']."'><i class='fa fa-list'></i></a>
									  </p>
								  </div>
								  <div class='clearfix'></div>
							  </div>
						  </div>
					</div>
					";	
			}
			echo $vendidos;
			?>
        </div> <!--/panel body-->
        </div> <!--/panel-->
        </div>
        </div> <!--/col del menu-->
        <div class="col-sm-9 col-md-9">
                <section class="section-white">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      </ol>
                
                      <!-- IMAGENES DEL BANNERS -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <a class="btn-cambio" href="<?php echo $_SESSION['params']['tx_link1'];?>" target="_blank"><img src="../img/<?php echo $_SESSION['params']['tx_img1'].'?x=='.md5(time());?>" alt="..."></a>
                          <div class="carousel-caption">
                            <h2><?php echo $_SESSION['params']['tx_tbanner1'];?></h2>
                          </div>
                        </div>
                        <div class="item">
                          <a class="btn-cambio" href="<?php echo $_SESSION['params']['tx_link2'];?>" target="_blank"><img src="../img/<?php echo $_SESSION['params']['tx_img2'].'?x=='.md5(time());?>" alt="..."></a>
                          <div class="carousel-caption">
                            <h2><?php echo $_SESSION['params']['tx_tbanner2'];?></h2>
                          </div>
                        </div>
                        <div class="item">
                          <a class="btn-cambio" href="<?php echo $_SESSION['params']['tx_link3'];?>" target="_blank"><img src="../img/<?php echo $_SESSION['params']['tx_img3'].'?x=='.md5(time());?>" alt="..."></a>
                          <div class="carousel-caption">
                            <h2><?php echo $_SESSION['params']['tx_tbanner3'];?></h2>
                          </div>
                        </div>
                      </div>
                
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                    </div>
                </section>
            <div id="cont"></div>
        </div><!--/col cuerpo-->
    </div> <!--/row de la web-->
</div> <!--/container-->
<footer class="footer">
  <div class="container">
	<p class="text-muted pull-left"><?php echo $_SESSION['params']['tx_nombre_empresa']." - ".$_SESSION['params']['tx_rif']." - ".$_SESSION['params']['tx_pie'];?></p>
    <!--<p class="text-muted pull-right"><small>Tienda desarrollada por <a href="http://disenosos.com/" target="_blank">SOS Diseño</a></small></p>-->
  </div>
</footer>
<div id="funciones"></div>
<!-- MODAL --> 
<div class="modal fade" id="modal_frame_sm" name="modal_frame" tabindex="-1" role="dialog"  aria-labelledby="modal_frame" aria-hidden="true">
    <div class="modal-dialog modal-sm">
         <div class="modal-content">
			<div class='modal-header'>
             	<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            	<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
            <div class="modal-body"><div id="precarga"><p class="text-center"><i class="fa fa-refresh fa-spin fa-4x"></i></p></div>
        	<iframe id="ventana" frameborder="0" width="100%"></iframe>
            </div>
        </div>
    </div>
</div>
<!--HASTA AQUI LA MODAL-->
<!-- MODAL --> 
<div class="modal fade" id="modal_frame_md" name="modal_frame" tabindex="-1" role="dialog"  aria-labelledby="modal_frame" aria-hidden="true">
    <div class="modal-dialog modal-md">
         <div class="modal-content">
			<div class='modal-header'>
             	<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            	<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
            <div class="modal-body"><div id="precarga"><p class="text-center"><i class="fa fa-refresh fa-spin fa-4x"></i></p></div>
        	<iframe id="ventana" frameborder="0" width="100%"></iframe>
            </div>
        </div>
    </div>
</div>
<!--HASTA AQUI LA MODAL-->
<!-- MODAL --> 
<div class="modal fade" id="modal_frame_lg" name="modal_frame" tabindex="-1" role="dialog"  aria-labelledby="modal_frame" aria-hidden="true">
    <div class="modal-dialog modal-lg">
         <div class="modal-content">
			<div class='modal-header'>
             	<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
            	<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
            <div class="modal-body"><div id="precarga"><p class="text-center"><i class="fa fa-refresh fa-spin fa-4x"></i></p></div>
        	<iframe id="ventana" frameborder="0" width="100%"></iframe>
            </div>
        </div>
    </div>
</div>
<!--HASTA AQUI LA MODAL-->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables/jquery.dataTables.min.js"></script>
<script src="../js/datatables/dataTables.bootstrap.js"></script>
<script src="../js/dialogbox/bootstrap-dialog.js"></script>
<script src="../js/validator/formValidation.min.js"></script>
<script type="text/javascript">
function cambioInicial(ruta,contenedor) {
	  $( "#cont" ).load( ruta, function() {});
};

$(document).ready(function() {
	$('#page-loader').fadeOut(500);
	cambioInicial('../fichas/inicio.php','cont');
	$('body').on('hidden.bs.modal', function (e) {
		$('.modal-content #ventana').attr('src', "");
		document.getElementById("precarga").style.display='block';
		//alert('limpio modal');
	});
});
//funcion para el enter
function teclas(tecla) {
	if (tecla == 13) {
		x=document.getElementById('tx_buscador').value;
		//alert(x);
		//direccion='../fichas/buscar.php?bus='+x;
		cambio('../fichas/buscar.php?bus='+x,'cont');
		exit;
		//$("#btn_buscar").click();
	}
}
//hasta aqui

function lineas(ruta,contenedor) {
	  $( "#linea" ).load( ruta, function() {});
	  //parent.$("#division1").empty();
	  //parent.document.getElementById("division1").innerHTML="";
};
function sublineas(ruta,contenedor) {
	  $( "#sublinea" ).load( ruta, function() {});
};
function division1(ruta,contenedor) {
	  $( "#division1" ).load( ruta, function() {});
};
function division2(ruta,contenedor) {
	  $( "#division2" ).load( ruta, function() {});
};
function division3(ruta,contenedor) {
	  $( "#division3" ).load( ruta, function() {});
};
function modal_registrar() {
	//alert(id);
	var height = document.querySelector("a[id=modalButtonregi]").getAttribute("data-height");
	var titulo = document.querySelector("a[id=modalButtonregi]").getAttribute("data-title");
	$(".modal-title").text(titulo);
	$("#modal_frame_md iframe").attr({'src':'../menu/registro-usuario.php',
		'height': height});
};
function modal_sesion() {
	//alert(id);
	var height = document.querySelector("a[id=modalButtonsesion]").getAttribute("data-height");
	var titulo = document.querySelector("a[id=modalButtonsesion]").getAttribute("data-title");
	$(".modal-title").text(titulo);
	$("#modal_frame_sm iframe").attr({'src':'../menu/sesion-usuario.php',
		'height': height});
};
function modal_sesionxs() {
	//alert(id);
	var height = document.querySelector("a[id=modalButtonsesionxs]").getAttribute("data-height");
	var titulo = document.querySelector("a[id=modalButtonsesionxs]").getAttribute("data-title");
	$(".modal-title").text(titulo);
	$("#modal_frame_sm iframe").attr({'src':'../menu/sesion-usuario.php',
		'height': height});
};
function modal_perfil(id) {
	//alert(id);
	var height = document.querySelector("a[id=modalButtonperf]").getAttribute("data-height");
	var titulo = document.querySelector("a[id=modalButtonperf]").getAttribute("data-title");
	$(".modal-title").text(titulo);
	$("#modal_frame_lg iframe").attr({'src':'../fichas/ver_editar_cliente.php?id='+id,
		'height': height});
};
function modal_terminos() {
	//alert(id);
	var height = document.querySelector("a[id=modalButtonterms]").getAttribute("data-height");
	var titulo = document.querySelector("a[id=modalButtonterms]").getAttribute("data-title");
	$(".modal-title").text(titulo);
	$("#modal_frame_lg iframe").attr({'src':'../fichas/terminos.php',
		'height': height});
};
	
$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
});

function olvido_contra() {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Recuperar Contraseña',
            message: $('<input type="email" class="form-control" id="tx_email" name="tx_email" placeholder="Ingresar Email">'),
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Recuperar',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						//alert(id);
						email=document.getElementById("tx_email").value;
						
						var parametros = {
								"email" : email
						};

						$.ajax({
								data:  parametros,
								url:   'olvidar-usuario.php?email='+email,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										window.location='index.php';
								}
						});
						dialogItself2.close();
					}
			}, {
					label: 'Cancelar',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });
	
}



function menu_nav(nombre) {
	//alert(nombre);
	$("#breadcrumbs").html("<ol class='breadcrumb hidden-xs hidden-sm'><li><a href='javaScript:;' onclick=\"location.reload();\">Inicio</a></li><li><a>"+nombre+"</a></li></ol>");
}
</script>

<?php
if ($_GET['log']=="1") {
	echo "<script type='text/javascript'> alert();</script>";
	echo "<script type='text/javascript'> cambio('../fichas/productos.php','cont');</script>";
}
if ($_GET['log']=="2") {
	echo "<script type='text/javascript'> alert();</script>";
	echo "<script type='text/javascript'> cambio('../fichas/terminos.php','cont');</script>";
}
?>
</body>
</html>