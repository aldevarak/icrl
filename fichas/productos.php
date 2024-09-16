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
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Productos de la tienda</title>
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
	
    $sql_des="SELECT * FROM tg013_productos WHERE co_categoria='".$id."' AND in_estatus='1' ".$sql_stock."";
	$resultados_des = mysql_query($sql_des,$link);
	//echo $sql_des;
			
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
		
			$pro_des.="
			<div class='list-item'>
			  <div class='col-sm-3'>
				  <div class='col-item'>";
			
			if ($producto['in_oferta']=="1"){
				$pro_des.="<img src='../img/oferta.png' class='col-xs-7 etiqueta_produ' alt=''/>";
			}
			
			if ($producto['in_destacado']=="1"){
				$pro_des.="<img src='../img/destacado.png' class='col-xs-7 etiqueta_produ' alt=''/>";
			}			
			
			$nombre_fichero = '../img_productos/p'.$producto['co_productos'].'-1.jpg';
			
			if (file_exists($nombre_fichero)) {
				$nombre_fichero_new = '../img_productos/p'.$producto['co_productos'].'-1.jpg?x=='.md5(time());
				
				$pro_des.="<div class='photo'>
							  <img src='".$nombre_fichero_new."' class='img-responsive img_producto_mini' alt='a'/>
						  </div>";
			}else{
				$pro_des.="<div class='photo'>
							  <img src='../img_productos/defpro.gif' alt='Imagen no Disponible' class='img-responsive img_producto_mini'/>
						  </div>";
			}
			
			$pro_des.="			  
					  <div class='info'>
						  <div class='row'>
							  <div class='price col-md-12'>
								  <h5 id='nombre_pro' title='".$producto['nb_productos']."'>".$producto['nb_productos']."</h5>
								  <h5 class='text-success'>";
			
			$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
			if ($opc_precio=="1"){
				if ($producto['in_oferta']=="1"){
					$pro_des.="<small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><br>$ ".number_format($precio2,2,",",".")."</h5>";
				}else{
					$pro_des.="Precio ".number_format($precio1,2,",",".")." $</h5>";
				}
			}
			
			if ($opc_precio=="2"){
				if (isset($_SESSION['co_nivel_usuario'])){
					if ($producto['in_oferta']=="1"){
						$pro_des.="<small class='text-info'>Antes ".number_format($precio1,2,",",".")."</small><br>$ ".number_format($precio2,2,",",".")."</h5>";
					}else{
						$pro_des.="Precio ".number_format($precio1,2,",",".")." $</h5>";
					}
				}
			}
			
			$pro_des.="
							  </div>
						  </div>
						  <div class='separator clear-left'>
							  <p class='btn-add'>";
			
			if($producto['nu_stock']<=0){
				$pro_des.="
							  	  <span class='label label-danger'>Agotado</span></p>";
			}else{
				if (($opc_precio=="1")||($opc_precio=="2")){
					$pro_des.="<i class='fa fa-shopping-cart'></i><a class='hidden-xs btn-cambio' href='../fichas/carrito-total.php?id=".$producto['co_productos']."&modo=agregar'>Agregar</a></p>";
				}
			}
			
			$pro_des.="
							  <p class='btn-details'>
								  <i class='fa fa-list'></i><a class='hidden-xs btn-cambio' href='../fichas/detalles-pro.php?id=".$producto['co_productos']."'>Ver</a>
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
<script type="text/javascript">
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