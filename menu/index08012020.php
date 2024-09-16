<?php 
	include ("../inic/dbcon.php");
	@session_start();
	//echo $_SESSION['co_usuario'];
	//error_reporting(E_ALL ^ E_NOTICE);

if (isset($_GET['logout'])){
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
	$respar = mysqli_query($link,"SELECT * FROM tg004_configuracion");
	$_SESSION['params'] = mysqli_fetch_array($respar);
	//echo $_SESSION['params']['tx_tbanner1'];
	unset($_SESSION['moneda']);
	$moneda = mysqli_query($link,"SELECT * FROM tg0031_monedas WHERE co_monedas='".$_SESSION['params']['co_monedas']."'");
	$_SESSION['moneda'] = mysqli_fetch_array($moneda);
//}

foreach ((array) $_SESSION['carrito'] as $i => $value) {
	$cantidad_carrito=$cantidad_carrito+$_SESSION['item'][$i];
}
$total=number_format($_SESSION['total'][1],2,",",".");
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" charset="utf-8"/>
<title><?php echo $_SESSION['params']['tx_titulo_tienda'];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../img/iconBD.png" />
<link rel="stylesheet" type="text/css" href="../css/menu/reset.css">
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../css/dialogbox/bootstrap-dialog.css">
<link rel="stylesheet" type="text/css" href="../css/datatables/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/responsive.css">
<link rel="stylesheet" type="text/css" href="../css/menu/menu-style.css">
<link rel="stylesheet" type="text/css" href="../css/validator/formValidation.min.css">
<link rel="stylesheet" type="text/css" href="../css/tour/bootstrap-tour.min.css">
<style type="text/css">
.breadcrumb {
  margin-bottom: 10px;
}
</style>

</head>

<body>
<?php
if ($_SESSION['params']['in_categorias']=="1"){
	$categorias=$_SESSION['params']['tx_categorias'];
}else{
	$categorias="Categorias";
}
if ($_SESSION['params']['in_lineas']=="1"){
	$lineas=$_SESSION['params']['tx_lineas'];
}else{
	$lineas="Líneas";
}
if ($_SESSION['params']['in_sublineas']=="1"){
	$sublineas=$_SESSION['params']['tx_sublineas'];
}else{
	$sublineas="Sub-Lineas";
}
if ($_SESSION['params']['in_division1']=="1"){
	$division1=$_SESSION['params']['tx_division1'];
}else{
	$division1="Division 1";
}
if ($_SESSION['params']['in_division2']=="1"){
	$division2=$_SESSION['params']['tx_division2'];
}else{
	$division2="Division 2";
}
if ($_SESSION['params']['in_division3']=="1"){
	$division3=$_SESSION['params']['tx_division3'];
}else{
	$division3="Division 3";
}
?>
<div id="page-loader"><span class="preloader-interior"></span></div>
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container-fluid" style="background-color:#ffffff;">
        <div class="col-xs-9 col-sm-12 col-md-2 col-lg-2 text-center">
			<img alt="logotipo" src="../img/<?php echo $_SESSION['params']['tx_logo'].'?x=='.md5(time());?>" class="img-responsive" style="margin: 0 auto; padding:5px;"> <!--ESTE LO PUEDES BORRAR LUEGO-->
		</div>
        <div class="col-xs-3 visible-xs"><!--SOLO SE VE EN PEQUEÑO-->
              <div class="btn-group btn-group-vertical" role="group" aria-label="...">
                  <button type="button" class="btn btn-default"><i class="fa fa-facebook-square"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-twitter"></i></button>
                  <button type="button" class="btn btn-default"><i class="fa fa-instagram"></i></button>
              </div>
        </div>
        
        <!--PUBLICIDAD -->  
		<?php
        if ($_SESSION['params']['in_publicidad']=='1'){ 
			$img_publicidadnew2=$_SESSION['params']['tx_imgpublicidad2'].'?x=='.md5(time());
			$img_publicidadnew3=$_SESSION['params']['tx_imgpublicidad3'].'?x=='.md5(time());
			
            $publicidad="
			<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12' style='margin:0 0 10px 0;' id='publicidadessuperiores'>
				<a href='".$_SESSION['params']['tx_linkpublicidad2']."' target='_blank'>
					<img src='../img/".$img_publicidadnew2."' alt='' class='img-responsive'/>
				</a>
			</div>
			<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12' style='margin:0 0 10px 0;'>
				<a href='".$_SESSION['params']['tx_linkpublicidad3']."' target='_blank'>
					<img src='../img/".$img_publicidadnew3."' alt='' class='img-responsive'/>
				</a>
			</div>";
            
            echo $publicidad;
        }
        ?>
        <!--/PUBLICIDAD -->
     <div class="col-xs-12 col-md-10 col-lg-10">
     <nav class="navbar">
     	<div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      <div class="collapse navbar-collapse js-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" id="iniciodesesion" data-toggle="dropdown"> <?php
                    if (!isset($_SESSION['co_usuario'])){
                    	echo "Acceso / Registro";
                    }else{
                    	echo $_SESSION['nb_usuario'];
                    }
                    ?><span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
          <ul class="dropdown-menu">
                    <?php
                    if (!isset($_SESSION['co_usuario'])){
                        $estructura="
							<li>
									<a data-title='Inicio de Sesion' onclick=\"modal_sesion();\" href='javaScript:;' data-target='#modal_det_iframe' data-toggle='modal' data-width='100%'>Iniciar Sesión</a>
            				</li>
							<li>
									<a href='javaScript:;' onclick=\"modal_registrar();\" data-title='Registrar Usuario' data-toggle='modal' data-target='#modal_det_iframe' data-width='100%'>Registrarse</a>
            				</li>
							<li>
									<a class='btn btn-link' onclick=\"olvido_contra();\">¿Olvidó Contraseña?</a>
            				</li>";
                    }else{
                        if ($_SESSION['co_nivel_usuario']=="1"){
                            $estructura="
									<li class='dropdown-header'>Entrar</li>
									<li><a target='_blank' class='btn' href='../admin/pages/index.php'>Panel Administrativo</a></li>
									<li><a class='btn modalButton' href='../menu/index.php?logout=1'>Salir</a></li>";
                        }else{
                            $estructura="".$categorias['co_categoria']."";
							
							$estructura="
									  <li><a class='btn-cambio' href='../fichas/pedidos.php'>Ver Pedidos</a></li>
									  <li><a class='btn modalButton' href='../menu/index.php?logout=1'>Salir</a></li>";
                        }
                    }
                    echo $estructura;
                    ?>
          </ul>
        </li>
        <li class="dropdown">
        	<a id="tx_carrito" name="tx_carrito" class="dropdown-toggle btn-cambio" aria-expanded="false" href="../fichas/carrito-total.php"><i class="fa fa-shopping-cart"></i> <?php echo $cantidad_carrito;?> productos / <?php echo $total;?><?php echo $_SESSION['moneda']['di_simbolo'];?></a>
        </li>
			  <?php
                  if (($_SESSION['co_nivel_usuario']=="2")||($_SESSION['co_nivel_usuario']=="3")){
                      $btn_pedidos="
					  <li><a class='btn-cambio' href='../fichas/pedidos.php'>Ver Pedidos</a></li>
					   <li><a class='btn modalButton' href='../menu/index.php?logout=1'>Salir</a></li>";
                    
                    echo $btn_pedidos;	
                  }
              ?>
      </ul>
    </div>
    </nav>
    <!-- /.nav-collapse -->
</div><!-- /col -->
          </div><!-- /cont-fluid -->
          </nav><!--NAVEGADOR SUPERIOR-->
          <div class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="row" style="padding:10px 0;">
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                <div class="cd-dropdown-wrapper" style="background-color: #e01a08;">
			<button class="btn btn-default btn-block cd-dropdown-trigger" href="#0" id="productos">Productos</button> <!--BOTON-->
			<nav class="cd-dropdown">
				<h2><?php echo $_SESSION['params']['tx_titulo_tienda'];?></h2> <!--NOMBRE DE LA TIENDA-->
				<a href="#0" class="cd-close">Close</a>
				<ul class="cd-dropdown-content">
					
                    <?php
					$sql_cate="SELECT * FROM tg007_categoria WHERE in_estatus='1' AND in_eliminar='1'";
					$resultados_cate = mysqli_query($link,$sql_cate);
							
					while ($categorias = mysqli_fetch_array($resultados_cate)) {
						$menu_cat.="
						<li class='has-children'><!--MARCO DE ".$categorias['nb_categoria']."-->
						<a>".$categorias['nb_categoria']."</a>
							<ul class='cd-secondary-dropdown is-hidden'>
								<li class='go-back'><a href='#0'>Menu</a></li>
								<li class='see-all'><a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$categorias['co_categoria']."' onclick=\"menu_nav(".$categorias['co_categoria'].");close_menu();\">Todo en ".$categorias['nb_categoria']."</a></li>";
								
						$sql_lineas="SELECT * FROM tg008_linea WHERE co_categoria='".$categorias['co_categoria']."' AND in_estatus='1' AND in_eliminar='1'";
						$resultados_lineas = mysqli_query($link,$sql_lineas);
						//console.log($sql_lineas);
							
						while ($lineas = mysqli_fetch_array($resultados_lineas)) {	
							
							$menu_cat.="
							<li class='has-children'><!--MARCO DE LINEA-->
								<a>".$lineas['nb_linea']."</a>

								<ul class='is-hidden'>
									<li class='go-back'><a href='#0'>atras a ".$categorias['nb_categoria']."</a></li>
									<li class='see-all'><a class='btn-cambio' href='../fichas/lineas.php?id=".$lineas['co_linea']."'  onclick=\"menu_nav2(".$categorias['co_categoria'].",".$lineas['co_linea'].");close_menu();\">Todo en ".$lineas['nb_linea']."</a></li><!--APARECE AUTOMATICO-->";
						
							$sql_sublineas="SELECT * FROM tg009_sublineas WHERE co_linea='".$lineas['co_linea']."' AND in_estatus='1' AND in_eliminar='1'";
							$resultados_sublineas = mysqli_query($link,$sql_sublineas);
							//console.log($sql_sublineas);
								
							while ($sublineas = mysqli_fetch_array($resultados_sublineas)) {	
								
								$menu_cat.="
								<li class='has-children'>
										<a href='#0'>".$sublineas['nb_sublineas']."</a>
										
										<ul class='is-hidden'>
											<li class='go-back'><a href='#0'>atras a ".$lineas['nb_linea']."</a></li>
											<li class='see-all'><a class='btn-cambio' href='../fichas/sublineas.php?id=".$sublineas['co_sublineas']."' onclick=\"menu_nav3(".$categorias['co_categoria'].",".$lineas['co_linea'].",".$sublineas['co_sublineas'].");close_menu();\">Todo en ".$sublineas['nb_sublineas']."</a></li><!--APARECE AUTOMATICO-->";
								
								$sql_division="SELECT * FROM tg010_division WHERE co_sublineas='".$sublineas['co_sublineas']."' AND in_estatus='1' AND in_eliminar='1'";
								$resultados_division = mysqli_query($link,$sql_division);
								//console.log($sql_division);
									
								while ($division = mysqli_fetch_array($resultados_division)) {
									$menu_cat.="
									<li class='has-children'>
									<a href='#0'>".$division['nb_division']."</a>

									<ul class='is-hidden'>
										<li class='go-back'><a href='#0'>atras a ".$sublineas['nb_sublineas']."</a></li>
										<li class='see-all'><a class='btn-cambio' href='../fichas/division.php?id=".$division['co_division']."' onclick=\"menu_nav4(".$categorias['co_categoria'].",".$lineas['co_linea'].",".$sublineas['co_sublineas'].",".$division['co_division'].");close_menu();\">Todo en ".$division['nb_division']."</a></li><!--APARECE AUTOMATICO-->";
								
									$sql_division2="SELECT * FROM tg011_division2 WHERE co_division='".$division['co_division']."' AND in_estatus='1' AND in_eliminar='1'";
									$resultados_division2 = mysqli_query($link,$sql_division2);
									//console.log($sql_division2);
										
									while ($division2 = mysqli_fetch_array($resultados_division2)) {
										$menu_cat.="<li class='has-children'>
                                                    <a href='#0'>".$division2['nb_division2']."</a>
                                                    <ul class='is-hidden'>
														<li class='go-back'><a href='#0'>atras a ".$division['nb_division']."</a></li>
														<li class='see-all'><a class='btn-cambio list-group-item' href='../fichas/division2.php?id=".$division2['co_division2']."' onclick=\"menu_nav(".$categorias['co_categoria'].",".$lineas['co_linea'].",".$sublineas['co_sublineas'].",".$division['co_division'].",".$division2['co_division2'].");close_menu();\">Todo en ".$division2['nb_division2']."</a></li><!--APARECE AUTOMATICO-->";
										
										$sql_division3="SELECT * FROM tg012_division3 WHERE co_division2='".$division2['co_division2']."' AND in_estatus='1' AND in_eliminar='1'";
										$resultados_division3 = mysqli_query($link,$sql_division3);
										//console.log($sql_division3);
											
										while ($division3 = mysqli_fetch_array($resultados_division3)) {				
											$menu_cat.="<li><a class='btn-cambio list-group-item' href='../fichas/division3.php?id=".$division3['co_division3']."' onclick=\"menu_nav6(".$categorias['co_categoria'].",".$lineas['co_linea'].",".$sublineas['co_sublineas'].",".$division['co_division'].",".$division2['co_division2'].",".$division3['co_division3'].");close_menu();\">Todo en ".$division3['nb_division3']."</a></li><!--APARECE AUTOMATICO-->";		
										}//fin while division3
										
										$menu_cat.="</ul>
                                        </li>";
									
									}//fin while division2
									
									$menu_cat.="</ul>
                                    </li>";
								
								}//fin while de division
								
								$menu_cat.="</ul>
                                </li>";
							
							}//fin del while sublineas
							
							$menu_cat.="</ul>
                            </li>";
						
						}//fin while lineas
						$menu_cat.="
							</ul> <!-- .cd-secondary-dropdown -->
						</li><!-- .has-children -->";
						
					}//fin while categorias
					
					echo $menu_cat;
					?>
				</ul> <!-- .cd-dropdown-content -->
			</nav> <!-- .cd-dropdown -->
		</div>
</div>
            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-7">
                <div class="form-horizontal">
                    <div class="input-group">
                      <input type="text" id="tx_buscador" name="tx_buscador" class="form-control" aria-label="Buscador de elementos" onKeyPress="teclas(window.event.keyCode);"> <!--INPUT DE BUSCAR-->
                      <span class="input-group-btn">
                        <a class="btn btn-default btn-cambio" type="button" onclick="x=document.getElementById('tx_buscador').value;x=x.replace(/\s/g,'_');cambio('../fichas/buscar.php?bus='+x,'cont');" id="btn_buscar" name="btn_buscar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                      </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-4 text-center">
            	<div class="btn-group hidden-xs" role="group" aria-label="..." id="redessociales">
                      <button type="button" class="btn btn-default"><i class="fa fa-facebook-square"></i></button>
                      <button type="button" class="btn btn-default"><i class="fa fa-twitter"></i></button>
                      <button type="button" class="btn btn-default"><i class="fa fa-instagram"></i></button>
                </div>
                <!--<div class="clearfix"></div>-->
                <div class="btn-group hidden-xs" role="group" aria-label="..." id="contactoyterminos">
              	<a  class='btn btn-xs btn-default btn-cambio' href='../fichas/contacto.php'>Contactenos</a>                
                  <a data-title="Terminos y Condiciones" class='btn btn-xs btn-default' data-height='500px' href='javaScript:;' onclick="modal_terminos();" data-toggle='modal' data-target='#modal_det_iframe'>Términos y Condiciones</a>
               </div>
            </div>
        	</div>
            </div>
  </div>
<!--MENU-->
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-lg-12 col-md-12 hidden-xs hidden-sm" id="breadcrumbs">
                <ol class="breadcrumb" id="ol_bread" style="background-color: #e01a08;">
                  <li><a href="javaScript:;" onclick="location.reload();">Inicio</a></li>
                </ol><!--FIN DE LOS BREADCRUMBS--><!--FIN DE LOS BREADCRUMBS--><!--FIN DE LOS BREADCRUMBS-->
            </div>
        </div>
		<div class="row">
        <div class="col-lg-12 col-md-12">
        		<section class="section-white" id="bannersuperiores">
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
                          <a href="<?php echo $_SESSION['params']['tx_link1'];?>" target="_blank"><img src="../img/<?php echo $_SESSION['params']['tx_img1'].'?x=='.md5(time());?>" alt="..."></a>
                          <div class="carousel-caption">
                            <h2><?php echo $_SESSION['params']['tx_tbanner1'];?></h2>
                          </div>
                        </div>
                        <div class="item">
                          <a href="<?php echo $_SESSION['params']['tx_link2'];?>" target="_blank"><img src="../img/<?php echo $_SESSION['params']['tx_img2'].'?x=='.md5(time());?>" alt="..."></a>
                          <div class="carousel-caption">
                            <h2><?php echo $_SESSION['params']['tx_tbanner2'];?></h2>
                          </div>
                        </div>
                        <div class="item">
                          <a href="<?php echo $_SESSION['params']['tx_link3'];?>" target="_blank"><img src="../img/<?php echo $_SESSION['params']['tx_img3'].'?x=='.md5(time());?>" alt="..."></a>
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
        </div>
        <div class="col-sm-3 col-md-3">
        <!--AVISO DEL IVA-->
        <?php
		if ($_SESSION['params']['in_iva']=="0"){
			$men_iva="<div class='col-sm-12' id='ivaono'>
						<h5>Los Precios <span class='label label-default'>No Incluyen IVA</span></h5>
					</div>";	
		}else{
			$men_iva="<div class='col-sm-12' id='ivaono'>
						<h5>Los Precios <span class='label label-default'>Incluyen IVA</span></h5>
					</div>";
		}
		echo $men_iva;
		?>        
        <div class="clearfix"></div>
        <!--AVISO DEL IVA-->
        <!--LOS MAS VENDIDOS-->
        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" id="masvendidos">
        <div class="panel panel-default">
  			<div class="panel-heading"><h3 class="panel-title">Los más Vendido</h3></div>
            <div class="panel-body" style="padding-top:5px;">
            <?php
			$sql_div="SELECT t2.*, COUNT(t1.co_productos) AS total FROM tr002_reng_pedidos AS t1 INNER JOIN tg013_productos AS t2 ON t1.co_productos=t2.co_productos GROUP BY t1.co_productos ORDER BY total DESC LIMIT 3";
			$resultados_des= mysqli_query($link,$sql_div);
			
				while ($producto = mysqli_fetch_array($resultados_des)) {
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
				if($producto['in_excento']=="0"){
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
				}else{
					$iva1=0;
					$iva2=0;
					
					$precio1=$precio1;
					$precio2=$precio2;
				}
				//	
				
				$vendidos.="
					  <div class='col-sm-12'>
						  <div class='col-item'>";
					
					if ($producto['in_oferta']=="1"){
						$vendidos.="<div class='etiqueta_produc_oferta'></div>";
					}
					
					if ($producto['in_destacado']=="1"){
						$vendidos.="<div class='etiqueta_produc_desta'></div>";
					}			
					
					$nombre_fichero = '../img_productos/pmin'.$producto['co_productos'].'-1.jpg';
					
					if (file_exists($nombre_fichero)) {
						$nombre_fichero_menu = '../img_productos/pmin'.$producto['co_productos'].'-1.jpg?x=='.md5(time());
						
						$vendidos.="
								<div class='photo' style=\"background-image: url('".$nombre_fichero_menu."');\"></div>";
					}else{
						$vendidos.="
								<div class='photo'></div>";
					}
					
					$vendidos.="			  
							  <div class='info'>
								  <div class='row'>
									  <div class='price col-md-12 col-xs-12'>";
					
					$vendidos.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>";
					
					$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
					if ($opc_precio=="1"){
						if ($producto['in_oferta']=="1"){
							$vendidos.="<small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><h5 class='text-success'>".$_SESSION['moneda']['di_simbolo']." ".number_format($precio2,2,",",".")."</h5>";
						}else{
							$vendidos.="<h5 class='text-success'>Precio ".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</h5><br>";
						}
					}
					
					if ($opc_precio=="2"){
						if (isset($_SESSION['co_nivel_usuario'])){
							if ($producto['in_oferta']=="1"){
								$vendidos.="<small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><h5 class='text-success'>".$_SESSION['moneda']['di_simbolo']." ".number_format($precio2,2,",",".")."</h5>";
							}else{
								$vendidos.="<h5 class='text-success'>Precio ".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</h5><br>";
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
										  <p class='btn-add hidden-xs' id='agregarcar'><i class='fa fa-shopping-cart'></i><a class='hidden-xs btn-cambio' href='../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar'>Agregar</a></p>
										  <p class='btn-add visible-xs-block' id='agregarcar'><a class='visible-xs-block btn-cambio' href='../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar' title='Agregar a carrito'><i class='fa fa-shopping-cart'></i></a></p>";
						}
					}
					
					$vendidos.="
									  <p class='btn-details' id='verdetalles'>
										  <i class='fa fa-list hidden-xs'></i><a class='hidden-xs btn-cambio' href='../fichas/detalles-pro.php?id=".$producto['co_productos']."'>Ver</a>
										  <a class='visible-xs-block btn-cambio' id='verdetalles' href='../fichas/detalles-pro.php?id=".$producto['co_productos']."'><i class='fa fa-list'></i></a>
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
        </div>
        </div> <!--/col del menu-->
        <div class="col-lg-9 col-md-9">
            <div id="cont"></div>
        </div><!--/col cuerpo-->
    </div> <!--/row de la web-->
</div> <!--/container-->
<footer class="footer">
  <div class="container">
      <div class="row">
      	<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <p class="text-muted pull-left"><?php echo $_SESSION['params']['tx_nombre_empresa']." - ".$_SESSION['params']['tx_rif']." - ".$_SESSION['params']['tx_pie'];?>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="contactosinferiores">
            <address class="text-muted pull-left"><abbr title="Phone / Teléfono">Telf:</abbr> <?php echo $_SESSION['params']['tx_telefono'];?><abbr title="Email"> Email:</abbr> <?php echo $_SESSION['params']['tx_mail'];?></address></p>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <!--/*<p class="text-muted pull-right"><small>Tienda desarrollada por <a href="http://disenosos.com/" target="_blank">SOS Diseño</a></small></p>*/-->
        </div>
      </div>
  </div>
</footer>
<div id="funciones"></div>
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
<script src="../js/menu/modernizr.js"></script>
<script src="../js/jquery-1.11.1.js"></script>
<script src="../js/nav-main.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu/jquery.menu-aim.js"></script>
<script src="../js/menu/menu-main.js"></script>
<script src="../js/datatables/datatables.min.js"></script>
<script src="../js/dialogbox/bootstrap-dialog.js"></script>
<script src="../js/validator/formValidation.min.js"></script>
<script src="../js/validator/formValidation.min.js"></script>
<script src="../js/validator/language/es_ES.js"></script>
<script src="../js/validator/framework/bootstrap.min.js"></script>
<script src="../js/mask/jquery.mask.min.js"></script>
<script src="../js/tour/bootstrap-tour.min.js"></script>
<script src="../js/tour/tour.js"></script>
<script src="../js/main.js"></script>
<script type="text/javascript">
/*function cambioInicial(ruta,contenedor) {
	  $( "#cont" ).load( ruta, function() {});
};*/

$(document).ready(function() {
	$('#page-loader').fadeOut(500);
});
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
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'registro-usuario.php' );
};
function modal_sesion() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'sesion-usuario.php' );
};
function modal_sesionxs() {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( 'sesion-usuario.php' );
};
function modal_perfil(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( '../fichas/ver_editar_cliente.php?id='+id );
};
function modal_terminos(id) {
	//alert(id);
	$(".modal-dialog").addClass( "modal-md" );
	$("#modal_det_iframe #ventana").load( '../fichas/terminos.php' );
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
						email=document.getElementById("tx_email2").value;
						
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
										olvido_contra_exito();
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

function menu_nav(id) {
	$.post("div_categoria.php", { id: id }, function(data){
		$("#ol_bread").html(data);
		//console.log(data);
	});
}
function menu_nav2(cat,lin) {
	$.post("div_linea.php", { cat: cat, lin: lin }, function(data){
		$("#ol_bread").html(data);
		//console.log(data);
	});
}
function menu_nav3(cat,lin,slin) {
	$.post("div_sublinea.php", { cat: cat, lin: lin, slin: slin }, function(data){
		$("#ol_bread").html(data);
		//console.log(data);
	});
}
function menu_nav4(cat,lin,slin,div) {
	$.post("div_division1.php", { cat: cat, lin: lin, slin: slin, div: div }, function(data){
		$("#ol_bread").html(data);
		//console.log(data);
	});
}
function menu_nav5(cat,lin,slin,div,div2) {
	$.post("div_division2.php", { cat: cat, lin: lin, slin: slin, div: div, div2: div2 }, function(data){
		$("#ol_bread").html(data);
		//console.log(data);
	});
}
function menu_nav6(cat,lin,slin,div,div2,div3) {
	$.post("div_division3.php", { cat: cat, lin: lin, slin: slin, div: div, div2: div2, div3: div3 }, function(data){
		$("#ol_bread").html(data);
		//console.log(data);
	});
}
function olvido_contra_exito() {
	BootstrapDialog.show({
	title: 'Registro sin exito',
	type: BootstrapDialog.TYPE_INFO,
	message: 'Le fue enviado un correo con su nueva contraseña (revisar los spam)',
	buttons: [{
		  label: 'OK',
		  action: function(dialogItself){
			  dialogItself.close();
			  location.reload();
			  }
	  }]
	});
}

function registro_exito() {
	BootstrapDialog.show({
	title: 'Registro con exito',
	type: BootstrapDialog.TYPE_SUCCESS,
	message: 'Ya se proceso su registro y le fue enviado un correo (revisar los spam)',
	buttons: [{
		  label: 'OK',
		  action: function(dialogItself){
			  dialogItself.close();
			  location.reload();
			  }
	  }]
	});
}

function registro_no_exito() {
	BootstrapDialog.show({
	title: 'Registro sin exito',
	type: BootstrapDialog.TYPE_DANGER,
	message: 'No se puedo realizar su registro, intente de nuevo mas tarde',
	buttons: [{
		  label: 'OK',
		  action: function(dialogItself){
			  dialogItself.close();
			  location.reload();
			  }
	  }]
	});
}
</script>
</body>
</html>