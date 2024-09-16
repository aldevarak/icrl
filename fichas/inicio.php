<?php 
include ("../inic/dbcon.php");
@session_start();
//echo $_SESSION['params']['nu_categorias'];

$result1 = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$_SESSION['params']['co_cat1']."'");
$cat1 = mysqli_fetch_array($result1);
$result2 = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$_SESSION['params']['co_cat2']."'");
$cat2 = mysqli_fetch_array($result2);
$result3 = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$_SESSION['params']['co_cat3']."'");
$cat3 = mysqli_fetch_array($result3);
$result4 = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$_SESSION['params']['co_cat4']."'");
$cat4 = mysqli_fetch_array($result4);
$result5 = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$_SESSION['params']['co_cat5']."'");
$cat5 = mysqli_fetch_array($result5);
$result6 = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE co_categoria='".$_SESSION['params']['co_cat6']."'");
$cat6 = mysqli_fetch_array($result6);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inicio</title>
</head>

<body>
    <!--CATEGORIAS RESALTANTES-->
    <?php
	if ($_SESSION['params']['nu_categorias']>="2"){
	//valor de imagenes sin cache
	$imgcat1=$_SESSION['params']['tx_imgcat1'].'?x=='.md5(time());	
	$imgcat2=$_SESSION['params']['tx_imgcat2'].'?x=='.md5(time());	
	$imgcat3=$_SESSION['params']['tx_imgcat3'].'?x=='.md5(time());	
	$imgcat4=$_SESSION['params']['tx_imgcat4'].'?x=='.md5(time());	
	$imgcat5=$_SESSION['params']['tx_imgcat5'].'?x=='.md5(time());	
	$imgcat6=$_SESSION['params']['tx_imgcat6'].'?x=='.md5(time());	
		
	$categorias_esp.="
		<div class='col-md-12' id='categoriasdestacadas'>
            <div class='back_cat_des' style=\"background-image: url('../img/".$imgcat1."');\">
				<div class='cont_back_cat_des'>
					<a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$_SESSION['params']['co_cat1']."'>
						<h4 class='media-heading'>".$cat1['nb_categoria']."</h4>
						<div class='hidden-xs'>".$_SESSION['params']['tx_descat1']."</div>
					</a>
				</div>
            </div>
			<div class='back_cat_des' style=\"background-image: url('../img/".$imgcat2."');\">
				<div class='cont_back_cat_des'>
					<a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$_SESSION['params']['co_cat2']."'>
						<h4 class='media-heading'>".$cat2['nb_categoria']."</h4>
						<div class='hidden-xs'>".$_SESSION['params']['tx_descat2']."</div>
					</a>
				</div>
            </div>
        </div>
	";	
	}
	
	if ($_SESSION['params']['nu_categorias']>="4"){
	$categorias_esp.="
		<div class='col-md-12'>
            <div class='back_cat_des' style=\"background-image: url('../img/".$imgcat3."');\">
				<div class='cont_back_cat_des'>
					<a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$_SESSION['params']['co_cat3']."'>
						<h4 class='media-heading'>".$cat3['nb_categoria']."</h4>
						<div class='hidden-xs'>".$_SESSION['params']['tx_descat3']."</div>
					</a>
				</div>
            </div>
			<div class='back_cat_des' style=\"background-image: url('../img/".$imgcat4."');\">
				<div class='cont_back_cat_des'>
					<a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$_SESSION['params']['co_cat4']."'>
						<h4 class='media-heading'>".$cat4['nb_categoria']."</h4>
						<div class='hidden-xs'>".$_SESSION['params']['tx_descat4']."</div>
					</a>
				</div>
            </div>
        </div>
	";	
	}
	
	if ($_SESSION['params']['nu_categorias']>="6"){
	$categorias_esp.="
		<div class='col-md-12'>
            <div class='back_cat_des' style=\"background-image: url('../img/".$imgcat5."');\">
				<div class='cont_back_cat_des'>
					<a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$_SESSION['params']['co_cat5']."'>
						<h4 class='media-heading'>".$cat5['nb_categoria']."</h4>
						<div class='hidden-xs'>".$_SESSION['params']['tx_descat5']."</div>
					</a>
				</div>
            </div>
			<div class='back_cat_des' style=\"background-image: url('../img/".$imgcat6."');\">
				<div class='cont_back_cat_des'>
					<a class='btn-cambio' href='../fichas/categorias_destacadas.php?id=".$_SESSION['params']['co_cat6']."'>
						<h4 class='media-heading'>".$cat6['nb_categoria']."</h4>
						<div class='hidden-xs'>".$_SESSION['params']['tx_descat6']."</div>
					</a>
				</div>
            </div>
        </div>
	";	
	}
	
	echo $categorias_esp;
	?>
	<!--/CATEGORIAS RESALTANTES-->

<!--PRODUCTOS DESTACADOS-->
<?php
if ($_SESSION['params']['in_destacados']=='1'){
	$pro_des.="
	<div class='col-xs-12 col-sm-9 col-md-12' id='productosdestacados'
		<div>
			<h3>Productos Destacados</h3>";
	  
	$sql_des="SELECT * FROM tg013_productos WHERE in_destacado='1' AND in_bloqueado='0'";
	$resultados_des = mysqli_query($link,$sql_des);
			
	$contar=1;
	while ($destacar = mysqli_fetch_array($resultados_des)) {
		
		//precio del producto
		if (isset($_SESSION['co_nivel_usuario'])){
			if ($_SESSION['co_nivel_usuario']=="1"){
				$precio1=$destacar['nu_precio1'];
			}
			
			if ($_SESSION['co_nivel_usuario']=="2"){
				if ($_SESSION['cliente']['co_tpcliente']=='1'){
					$precio1=$destacar['nu_precio1'];
				}
				if ($_SESSION['cliente']['co_tpcliente']=='2'){
					$precio1=$destacar['nu_precio2'];
				}
				if ($_SESSION['cliente']['co_tpcliente']=='3'){
					$precio1=$destacar['nu_precio3'];
				}
				if ($_SESSION['cliente']['co_tpcliente']=='4'){
					$precio1=$destacar['nu_precio4'];
				}
			}
			
			if ($_SESSION['co_nivel_usuario']=="3"){
				$precio1=$destacar['nu_precio1'];
			}
		}else{
			$precio1=$destacar['nu_precio1'];	
		}
	
		$precio2=$destacar['nu_precio5'];
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
			$pro_des.="
			<div class='no-gutter item'>
			  <div class='col-lg-2 col-md-3 col-sm-4 col-xs-12'>
				  <div class='col-item'>";
				  
			if ($destacar['in_oferta']=="1"){
				$pro_des.="<div class='etiqueta_produc_oferta'></div>";
			}
			
			if ($destacar['in_destacado']=="1"){
				$pro_des.="<div class='etiqueta_produc_desta'></div>";
			}
			
			$nombre_fichero = '../img_productos/pmin'.$destacar['co_productos'].'-1.jpg';
			
			if (file_exists($nombre_fichero)) {
				$nombre_fichero_new = '../img_productos/pmin'.$destacar['co_productos'].'-1.jpg?x=='.md5(time());
				
				$pro_des.="<div class='photo' style=\"background-image: url('".$nombre_fichero_new."');\"></div>";
			}else{
				$pro_des.="<div class='photo'></div>";
			}
			
			$pro_des.="
					  <div class='info'>
						  <div class='row'>
							  <div class='price col-md-12 col-xs-10'>
								  <h5 id='nombre_pro' title='".$destacar['nb_productos']."'>".$destacar['nb_productos']."</h5>
								  <h5 class='text-success'>";
								  
			$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
			if ($opc_precio=="1"){
				if ($destacar['in_oferta']=="1"){
					$pro_des.="<div class='precio_antes'>".number_format($precio1,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div><div class='precio_new'>".number_format($precio2,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div>";
				}else{
					$pro_des.="<div class='precio_new'>".number_format($precio1,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div>";
				}
			}
			
			if ($opc_precio=="2"){
				if (isset($_SESSION['co_nivel_usuario'])){
					if ($destacar['in_oferta']=="1"){
						$pro_des.="<div class='precio_antes'>".number_format($precio1,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div><div class='precio_new'>".number_format($precio2,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div>";
					}else{
						$pro_des.="<div class='precio_new'>".number_format($precio1,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div>";
					}
				}
			}
			
			$pro_des.="
							  </div>
						  </div>
						  <div class='separator clear-left'>";
			
			if (($opc_precio=="1")||($opc_precio=="2")){
				$pro_des.="
								  <p class='btn-add'>
									  <i class='fa fa-shopping-cart'></i><a class='btn-cambio' href='../fichas/carrito-total.php?id=".$destacar['co_productos']."&modo=agregar'>Agregar</a></p>";
			}
			
			$pro_des.="
							  <p class='btn-details'>
								  <i class='fa fa-list'></i><a class='btn-cambio' href='../fichas/detalles-pro.php?id=".$destacar['co_productos']."' title='".$destacar['nb_productos']."'>Ver</a>
							  </p>
						  </div>
						  <div class='clearfix'>
						  </div>
					  </div>
				  </div>
			  </div>
			</div>
			";
		}
	}
	
 $pro_des.="
   </div><!--aqui terminan los cuadros-->
</div>"; 
 
 echo $pro_des;
?>
<!--/PRODUCTOS DESTACADOS-->
    
<!--PRODUCTOS EN OFERTA-->
<?php
	$pro_oferta.="
	<div class='col-xs-12 col-sm-9 col-md-12' id='productosenoferta'>
		<div>
		<h3>Productos en Ofertas</h3>";
	  
	$sql_oferta="SELECT * FROM tg013_productos WHERE in_oferta='1' AND in_bloqueado='0'";
	$resultados_oferta = mysqli_query($link,$sql_oferta);
			
	$contar=1;
	while ($ofertar = mysqli_fetch_array($resultados_oferta)) {
		
		  if (isset($_SESSION['co_nivel_usuario'])){
			  if ($_SESSION['co_nivel_usuario']=="1"){
				  $precio1=$ofertar['nu_precio1'];
			  }
			  
			  if ($_SESSION['co_nivel_usuario']=="2"){
				  if ($_SESSION['cliente']['co_tpcliente']=='1'){
					  $precio1=$ofertar['nu_precio1'];
				  }
				  if ($_SESSION['cliente']['co_tpcliente']=='2'){
					  $precio1=$ofertar['nu_precio2'];
				  }
				  if ($_SESSION['cliente']['co_tpcliente']=='3'){
					  $precio1=$ofertar['nu_precio3'];
				  }
				  if ($_SESSION['cliente']['co_tpcliente']=='4'){
					  $precio1=$ofertar['nu_precio4'];
				  }
			  }
			  
			  if ($_SESSION['co_nivel_usuario']=="3"){
				  $precio1=$ofertar['nu_precio1'];
			  }
		  }else{
			  $precio1=$ofertar['nu_precio1'];	
		  }
	  
		  $precio2=$ofertar['nu_precio5'];
		  
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
			$pro_oferta.="
			<div class='no-gutter item'>
			  <div class='col-lg-2 col-md-3 col-sm-4 col-xs-12'>
				  <div class='col-item'>";
				  
			if ($ofertar['in_oferta']=="1"){
				$pro_oferta.="<div class='etiqueta_produc_oferta' id='etiquetaoferta'></div>";
			}
			
			if ($ofertar['in_destacado']=="1"){
				$pro_oferta.="<div class='etiqueta_produc_desta'id='etiquetadesta'></div>";
			}
			
			$nombre_fichero = '../img_productos/pmin'.$ofertar['co_productos'].'-1.jpg';
			
			if (file_exists($nombre_fichero)) {
				$nombre_fichero_oferta = '../img_productos/pmin'.$ofertar['co_productos'].'-1.jpg?x=='.md5(time());
				
				$pro_oferta.="<div class='photo' style=\"background-image: url('".$nombre_fichero_oferta."');\"></div>";
			}else{
				$pro_oferta.="<div class='photo'></div>";
			}
			
			$pro_oferta.="
					  <div class='info'>
						  <div class='row'>
							  <div class='price col-md-12'>
								  <h4 id='nombre_pro' title='".$ofertar['nb_productos']."'>".$ofertar['nb_productos']."</h4>
								  ";
			
			$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
			if ($opc_precio=="1"){
				$pro_oferta.="<div class='precio_antes'>".number_format($precio1,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div><div class='precio_new'>".number_format($precio2,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div> ";
			}
			
			if ($opc_precio=="2"){
				if (isset($_SESSION['co_nivel_usuario'])){
					$pro_oferta.="<div class='precio_antes'>".number_format($precio1,2,",",".")."".$_SESSION['moneda']['di_simbolo']."</div>";
				}
			}
			
			$pro_oferta.="
							  </div>
						  </div>
						  <div class='separator clear-left'>";
						  
			if (($opc_precio=="1")||($opc_precio=="2")){
				$pro_oferta.="
							  <p class='btn-add'>
							  	  <i class='fa fa-shopping-cart'></i><a class='hidden-sm btn-cambio' href='../fichas/carrito-total.php?id=".$ofertar['co_productos']."&modo=agregar'>Agregar</a></p>";
			}
								  
			$pro_oferta.="
							  <p class='btn-details'>
								  <i class='fa fa-list'></i><a class='hidden-sm btn-cambio' href='../fichas/detalles-pro.php?id=".$ofertar['co_productos']."' title='".$ofertar['nb_productos']."'>Ver</a>
							  </p>
						  </div>
						  <div class='clearfix'>
						  </div>
					  </div>
				  </div>
			  </div>
			</div>
			";
		}
	
$pro_oferta.="
   </div><!--aqui terminan los cuadros-->
</div>"; 
 
 echo $pro_oferta;
?>    
<!--PRODUCTOS EN OFERTA-->
<div class='clearfix'></div>
<!--PUBLICIDAD -->  
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

</script>
</body>
</html>