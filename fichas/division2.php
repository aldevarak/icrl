<?php 
include ("../inic/dbcon.php");
@session_start();

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Division 2</title>
<link rel="stylesheet" type="text/css" href="../css/pagination/styles.css">
<style type="text/css">
.jplist-pagination-info{
			margin: 0 15px 0 40px;
	}
.jplist-pagination{
		    margin: 0;
	}
.jplist-panel{
	margin: 0 0 10px 0;
	}
.col-item .photo2
{
	height:180px;
	width:100%;
	float:right;
	background-position: center;
	background-size:contain !important;
	background-repeat:no-repeat;
}
</style>
</head>
<body>
<!-- main content -->
<div id="paginar">
	  
	<!-- PAGINADOR -->
	<div class="jplist-panel">
			<div class="row">
				<div class="col-md-5 text-center">
					<!-- pagination info label -->
					<div class="pull-left jplist-pagination-info text-center"
						data-type="<strong>Página {current} de {pages}</strong><br/> <small>{start} - {end} de {all} productos</small>" 
						data-control-type="pagination-info" 
						data-control-name="paging" 
						data-control-action="paging"></div>
								
					<!-- items per page dropdown -->
					<div 
						class="dropdown pull-left jplist-items-per-page"
						data-control-type="boot-items-per-page-dropdown" 
						data-control-name="paging" 
						data-control-action="paging">

                        <button 
							class="visible-xs-block col-xs-offset-5 btn btn-primary dropdown-toggle" 
							type="button" 
							data-toggle="dropdown" 
							id="dropdown-menu-1"
							aria-expanded="true">					
							<span data-type="selected-text">Productos por página</span>
							<span class="caret"></span>						
						</button>
                        <button 
							class="visible-md-block visible-lg-block col-md-offset-1 btn btn-primary dropdown-toggle" 
							type="button" 
							data-toggle="dropdown" 
							id="dropdown-menu-1"
							aria-expanded="true">					
							<span data-type="selected-text">Productos por página</span>
							<span class="caret"></span>						
						</button>

						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-menu-1">
							<?php
							if ($_SESSION['params']['nu_productos_pag']=="4"){
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='4' data-default='true'>Mostrar 4</a>
								</li>";
							}else{
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='4'>Mostrar 4</a>
								</li>";
							}
							if ($_SESSION['params']['nu_productos_pag']=="8"){
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='8' data-default='true'>Mostrar 8</a>
								</li>";
							}else{
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='8'>Mostrar 8</a>
								</li>";
							}
							if ($_SESSION['params']['nu_productos_pag']=="12"){
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='12' data-default='true'>Mostrar 12</a>
								</li>";
							}else{
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='12'>Mostrar 12</a>
								</li>";
							}
							if ($_SESSION['params']['nu_productos_pag']=="24"){
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='24' data-default='true'>Mostrar 24</a>
								</li>";
							}else{
								$paginador.="
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='24'>Mostrar 24</a>
								</li>";
							}
							$paginador.="
								<li role='presentation' class='divider'>
								<li role='presentation'>
									<a role='menuitem' tabindex='-1' href='#' data-number='all'>Ver Todo</a>
								</li>";
							echo $paginador;
							?>
						</ul>						  
					</div>
				</div>
                <div class="visible-md-block visible-lg-block col-md-6"> <!--NUMERO DE PAGINAS-->
					<!-- bootstrap pagination control -->
					<ul 
							class="pagination pull-left jplist-pagination"
							data-control-type="boot-pagination" 
							data-control-name="paging" 
							data-control-action="paging"
							data-range="9"
							data-mode="google-like">
					</ul>
				</div>
                <div class="visible-xs-block col-xs-offset-1 col-md-6"> <!--NUMERO DE PAGINAS-->
					<!-- bootstrap pagination control -->
					<ul 
							class="pagination pull-left jplist-pagination"
							data-control-type="boot-pagination" 
							data-control-name="paging" 
							data-control-action="paging"
							data-range="3"
							data-mode="google-like">
					</ul>
				</div>
			</div>
	</div>
	<!-- FIN PAGINADOR -->
    
	<div class="list">
    <?php
	if ($_SESSION['params']['in_stock_cero']=='0'){
		$sql_stock='AND nu_stock > 0';	
	}else{
		$sql_stock='';
	}
	
    $sql_des="SELECT * FROM tg013_productos WHERE co_division2='".$id."' AND in_estatus='1' ".$sql_stock."";
	$resultados_des = mysqli_query($link,$sql_des);
	//echo $sql_des;
			
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
		
			$pro_des.="
			<div class='list-item'>
			  <div class='col-sm-3'>
				  <div class='col-item'>";
			
			if ($producto['in_oferta']=="1"){
				$pro_des.="<div class='etiqueta_produc_oferta'></div>";
			}
			
			if ($producto['in_destacado']=="1"){
				$pro_des.="<div class='etiqueta_produc_desta'></div>";
			}			
			
			$nombre_fichero = '../img_productos/pmin'.$producto['co_productos'].'-1.jpg';
			
			if (file_exists($nombre_fichero)) {
				$nombre_fichero_new = '../img_productos/pmin'.$producto['co_productos'].'-1.jpg?x=='.md5(time());
				
				$pro_des.="
						<div class='photo2' style=\"background-image: url('".$nombre_fichero_new."');\"></div>";
			}else{
				$pro_des.="
						<div class='photo'></div>";
			}
			
			$pro_des.="			  
					  <div class='info'>
						  <div class='row'>
							  <div class='price col-md-12'>";
			
			$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
			if ($opc_precio=="0"){
				$pro_des.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5><br>";
			}
			
			if ($opc_precio=="1"){
				if ($producto['in_oferta']=="1"){
				$pro_des.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>
								  <small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><h5 class='text-success'>".$_SESSION['moneda']['di_simbolo']." ".number_format($precio2,2,",",".")."</h5>";
			}else{
				$pro_des.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>
								  <h5 class='text-success'>Precio ".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</h5><br>";
			}
			}
			
			if ($opc_precio=="2"){
				if (isset($_SESSION['co_nivel_usuario'])){
					if ($producto['in_oferta']=="1"){
				$pro_des.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>
								  <small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><h5 class='text-success'>".$_SESSION['moneda']['di_simbolo']." ".number_format($precio2,2,",",".")."</h5>";
					}else{
						$pro_des.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>
										  <h5 class='text-success'>Precio ".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</h5><br>";
					}
				}else{
					$pro_des.="<h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5><br>";
				}
			}
						
			$pro_des.="
							  </div>
						  </div>
						  <div class='separator clear-left'>";
			
			if($producto['nu_stock']<=0){
				$pro_des.="
							  	  <p class='btn-add'><span class='label label-danger'>Agotado</span></p>";
			}else{
				if (($opc_precio=="1")||($opc_precio=="2")){
					$pro_des.="
							  	  <p class='btn-add hidden-xs'><i class='fa fa-shopping-cart'></i><a class='hidden-xs' href='javaScript:;' onclick=\"parent.cambio('../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar',	'cont');\">Agregar</a></p>
								  <p class='btn-add visible-xs-block'><a class='visible-xs-block' href='javaScript:;' onclick=\"parent.cambio('../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar','cont');\" title='Agregar a carrito'><i class='fa fa-shopping-cart'></i></a></p>";
				}
			}
			
			$pro_des.="
							  <p class='btn-details'>
								  <i class='fa fa-list hidden-xs'></i><a class='hidden-xs' href='javaScript:;' onclick=\"parent.cambio('../fichas/detalles-pro.php?id=".$producto['co_productos']."','cont');\">Ver</a>
								  <a class='visible-xs-block' href='javaScript:;' onclick=\"parent.cambio('../fichas/detalles-pro.php?id=".$producto['co_productos']."','cont');\"><i class='fa fa-list'></i></a>
							  </p>
						  </div>
						  <div class='clearfix'></div>
					  </div>
				  </div>
			  </div>
			</div>
			";
	}
	echo $pro_des;
       ?>

      </div><!--FIN CONTENEDOR 1 DE ELEMENTOS-->			
</div><!--FIN CONTENEDOR 2 DE ELEMENTOS-->

<div class="holder"> </div>

<!--PUBLICIDAD --> 
<div class='clearfix'></div>
<?php
if ($_SESSION['params']['in_publicidad']=='1'){ 
    $img_publicidad=$_SESSION['params']['tx_imgpublicidad']."?x==".md5(time());
	
    $publicidad="<div class='container-fluid' id='publicidadinferior'><div class='row'><div class='col-lg-12'>
        <a href='".$_SESSION['params']['tx_linkpublicidad']."' target='_blank'><img src='../img/".$img_publicidad."' class='img-responsive' alt='Responsive image'></a>
    </div></div></div>";
	
	echo $publicidad;
}
?>
<!--/PUBLICIDAD -->   
<script src="../js/pagination/jPList-core.min.js"></script>
<script src="../js/pagination/jplist.boot-pagination-bundle.min.js"></script>
<script type="text/javascript">
	//$("div.paging").quickPager2({pagerLocation:"both"});
	$('document').ready(function () {
		    $('#paginar').jplist({
		        itemsBox: '.list'
				,itemPath: '.list-item'
				,panelPath: '.jplist-panel'
		    });
		});
</script>
</body>
</html>