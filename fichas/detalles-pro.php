<?php 
include ("../inic/dbcon.php");
@session_start();
//echo $_SESSION['params']['nu_categorias'];

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo "valor de producto=".$id;

if ($id==""){
	echo "<script language='javascript'>
	parent.no_busqueda();
	</script>";
}else{
	$result = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$id."'");
	$row = mysqli_fetch_array($result);
	
	$cantidad_img=$_SESSION['params']['nu_imagenes_pro'];
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Detalles del producto</title>
<link rel="stylesheet" type="text/css" href="../css/zoom/easyzoom.css">
<style>	 
#carousel-custom {
    width: 100%;
}
#carousel-custom .carousel-inner {
	overflow:hidden;
}
#carousel-custom .carousel-indicators {
    margin: 10px 0 0;
    overflow: auto;
    position: static;
    text-align: left;
    white-space: nowrap;
    width: 100%;
}
#carousel-custom .carousel-indicators li {
    background-color: transparent;
    -webkit-border-radius: 0;
    border-radius: 0;
    display: inline-block;
    height: auto;
    margin: 0 !important;
    width: auto;
}
#carousel-custom .carousel-indicators li img {
    display: block;
    opacity: 0.5;
	max-width:100px;
	max-height:50px;
}
#carousel-custom .carousel-indicators li.active img {
    opacity: 1;
}
#carousel-custom .carousel-indicators li:hover img {
    opacity: 0.75;
}
#carousel-custom .carousel-outer {
    position: relative;
	min-height: 300px;
}
.carousel-indicators2 {
    padding:0px;
}
#img_produc{
	min-height: 400px;
	background:url(../img_productos/defpro.jpg);
	background-repeat: no-repeat;
	background-position: center;
	background-size:contain;
}
.cont_img_produc{
	height:400px;
	width:auto;
	margin:0 auto;
	background-color:#fff;
	text-align: center;
}
.cont_img_produc img{
	width:auto;
	height:100%;
	vertical-align:middle;
}

</style>
</head>
<body>
    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
    <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
    <div class='carousel-outer'>
        <!-- Wrapper for slides -->
        <div class='carousel-inner'>
        
        <?php
			$contador=0;
			for ($i = 1; $i <= $cantidad_img; $i++){
				$nombre_fichero = '../img_productos/p'.$id.'-'.$i.'.jpg';
				$nombre_fichero_min = '../img_productos/pmin'.$id.'-'.$i.'.jpg';
				
				$nombre_fichero_new = '../img_productos/p'.$id.'-'.$i.'.jpg?x=='.md5(time());
				$nombre_fichero_min_new = '../img_productos/pmin'.$id.'-'.$i.'.jpg?x=='.md5(time());
					
				if ($contador=="0"){	
					  $contador=1;
					  if (file_exists($nombre_fichero)) {
						  
						  //echo "El fichero ".$nombre_fichero." existe";
						  $suma=$suma+1;
						  $imagenes.="
							<div class='item active' data-image=".$nombre_fichero_new.">
								<div class='cont_img_produc'>
									<img class='zoom_mw' src='".$nombre_fichero_min_new."' data-zoom-image='".$nombre_fichero_new."' onmouseover=\"reload_zoom();\"/>
								</div>
							</div>";
					  }else{
						  //echo "El fichero ".$nombre_fichero." no existe";
						  $imagenes.="
						  <img id='img_produc' class='photo img-responsive'/>";
					  }
				}else{
					if (file_exists($nombre_fichero)) {
						  //echo "El fichero ".$nombre_fichero." existe";
						  $suma=$suma+1;
						  $imagenes.="
						<div class='item' data-image=".$nombre_fichero_new.">
							<div class='cont_img_produc'>
								<img class='zoom_mw' src='".$nombre_fichero_min_new."' data-zoom-image='".$nombre_fichero_new."' onmouseover=\"reload_zoom();\"/>
							</div>
						</div>";
					}
				}
			}
			echo $imagenes;
		  ?>
          </div>
            
        <?php
		if ($suma>=1){
			$controles= "<!-- Controls -->
        <a class='left carousel-control' href='#carousel-custom' data-slide='prev' onclick=\"reload_zoom();\">
            <span class='glyphicon glyphicon-chevron-left'></span>
        </a>
        <a class='right carousel-control' href='#carousel-custom' data-slide='next' onclick=\"reload_zoom();\">
            <span class='glyphicon glyphicon-chevron-right'></span>
        </a>";
		
		echo $controles;	
		}
		?>
       
    </div>
    
    <!-- Indicators -->
    <ul class='thumbnails carousel-indicators carousel-indicators2'>
    	<?php
    	$contador=0;
			for ($i = 1; $i <= $cantidad_img; $i++){
				$nombre_fichero_min = '../img_productos/pmin'.$id.'-'.$i.'.jpg';
				$nombre_fichero_min_new = '../img_productos/pmin'.$id.'-'.$i.'.jpg?x=='.md5(time());
				
				
				$slide=$i-1;	
				if ($contador=="0"){	
					  $contador=1;
					  if (file_exists($nombre_fichero_min)) {
						  //echo "El fichero ".$nombre_fichero." existe";
						  $imagenes2.="<li data-target='#carousel-custom' data-slide-to='".$slide."' class='active'><img src='".$nombre_fichero_min_new."' alt='' class='img-responsive'/></li> <!--DATA data-slide-to DETERMINA QUE FOTO VA A MOSTRAR ARRIBA-->";
					  }
					  
				}else{
					if (file_exists($nombre_fichero_min)) {
						  //echo "El fichero ".$nombre_fichero." existe";
						  $imagenes2.="<li data-target='#carousel-custom' data-slide-to='".$slide."' onclick=\"reload_zoom();\"><img src='".$nombre_fichero_min_new."' alt='' class='img-responsive'/></li> <!--DATA data-slide-to DETERMINA QUE FOTO VA A MOSTRAR ARRIBA-->";
					}
				}
			}
			echo $imagenes2;
    	?>
    </ul>
</div>
    </div>
    
    <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
        <div class="product-title"><?php echo $row['nb_productos'];?></div>
        <div class="product-desc"><?php echo $row['tx_descripcion'];?></div>
        <hr>
      <!--SECCION DE PRECIO-->
        <?php
		$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
		
		//determinar precio
		if (isset($_SESSION['co_nivel_usuario'])){
			if ($_SESSION['co_nivel_usuario']=="1"){
				$precio1=$row['nu_precio1'];
			}
			
			if ($_SESSION['co_nivel_usuario']=="2"){
				if ($_SESSION['cliente']['co_tpcliente']=='1'){
					$precio1=$row['nu_precio1'];
				}
				if ($_SESSION['cliente']['co_tpcliente']=='2'){
					$precio1=$row['nu_precio2'];
				}
				if ($_SESSION['cliente']['co_tpcliente']=='3'){
					$precio1=$row['nu_precio3'];
				}
				if ($_SESSION['cliente']['co_tpcliente']=='4'){
					$precio1=$row['nu_precio4'];
				}
			}
			
			if ($_SESSION['co_nivel_usuario']=="3"){
				$precio1=$row['nu_precio1'];
			}
		}else{
			$precio1=$row['nu_precio1'];	
		}
		$precio2=$row['nu_precio5'];
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
		
		if ($opc_precio=="1"){
			if ($row['in_oferta']=="1"){
				$pre.="<div class='product-price'><h5 class='text-success'><small class='text-info'>Antes ".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</small> ".number_format($precio2,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</h5></div>";
			}else{
				$pre.="<div class='product-price'>".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</div>";
			}
		}
		
		if ($opc_precio=="2"){
			if (isset($_SESSION['co_nivel_usuario'])){
				if ($row['in_oferta']=="1"){
					$pre.="<div class='product-price'><h5 class='text-success'><small class='text-info'>Antes ".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</small> ".number_format($precio2,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</h5></div>";
				}else{
					$pre.="<div class='product-price'>".number_format($precio1,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</div>";
				}
			}
		}
		
		if ($row['in_destacado']=="1"){
			$pre.="<div class='product-stock'>Destacado</div>";
		}
		
		echo $pre;
		
		if ($row['in_excento']=="1"){
			$imp.="<div class='text-primary'>Exento de Iva</div>";
		}
		
		echo $imp;
		
		$opc_cantidad=$_SESSION['params']['nu_mostrar_cantidad'];
		
		if ($opc_cantidad=="1"){
			$stock.="<div class='product-stock'>".$row['nu_stock']."</div>";
		}
		if ($opc_cantidad=="2"){
			if($row['nu_stock']>=$_SESSION['params']['nu_cantidad_stock']){
				$stock.="<p class='text-primary'>".$_SESSION['params']['tx_etiqueta_superior']."</p>";	
			}
			if(($row['nu_stock']<=$_SESSION['params']['nu_cantidad_stock'])&&($row['nu_stock']>=0)){
				$stock.="<p class='text-warning'>".$_SESSION['params']['tx_etiqueta_critico']."</p>";	
			}
			if($row['nu_stock']<=0){
				$stock.="<p class='text-danger'>".$_SESSION['params']['tx_etiqueta_cero']."</p>";	
			}
		}
		echo $stock;
		
		?>
        <!--<div class="product-price">1234.00 ".$_SESSION['moneda']['di_simbolo']."</div>-->
        <!--<div class="product-stock">Disponible</div>-->

        <hr>
        <?php
			//if($row['nu_stock']>0){
				//if (($opc_precio=="1")||($opc_precio=="2")){
				if (isset($_SESSION['co_usuario'])){
					$btn_agregar="<div class='btn-group cart'>
								<button type='button' class='btn btn-success' id='agregarproducto' name='agregarproducto'>
									Agregar al carrito 
								</button>
							</div>";
							
					echo $btn_agregar;	
				}
				//}
			//}
		?>
        
        
    </div>
    </div>	
    </div>
	<?php
	if($row['tx_descripcion_web']!=""){
		$descripcion="
		<div class='container-fluid'>		
			<div class='col-md-12 product-info'>
					<ul id='myTab' class='nav nav-tabs nav_tabs'>
						<li class='active'><a href='#service-one' data-toggle='tab'>DESCRIPCIÓN</a></li>
						<!--<li><a href='#service-two' data-toggle='tab'>PESTAÑA 2</a></li>
						<li><a href='#service-three' data-toggle='tab'>PESTAÑA 3</a></li>-->
					</ul>
				<div id='myTabContent' class='tab-content'>
						<div class='tab-pane fade in active' id='service-one'>
							<section class='product-info'>
							".$row['tx_descripcion_web']."
							</section>
						</div>
				</div>
				<hr>
			</div>
		</div>
		";
	echo $descripcion;
	}
	?>
<script src="../js/zoom/jquery.elevateZoom-3.0.8.min.js"></script>
<script language="javascript">
$(".zoom_mw").elevateZoom({scrollZoom : true, responsive: false, zoomLevel : 0.5});
function reload_zoom(){
	$(".zoom_mw").elevateZoom({scrollZoom : true, responsive: false, zoomLevel : 0.5});
}
$(document).ready(function() {
	$("#agregarproducto").click(function(){
		BootstrapDialog.show({
            title: 'Confirmacion',
            message: '¿Seguro desea agregar este producto al carrito?',
			type: BootstrapDialog.TYPE_WARNING,
			size: BootstrapDialog.SIZE_SMALL,
			buttons: [{
                label: 'Si',
                action: function(dialog) {
                    //dialog.setTitle('Title 1');
					parent.cambio('../fichas/carrito-total.php?id=<?php echo $id;?>&modo=agregar','cont');
					dialog.close();
                }
			}, {
                label: 'Cancelar',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
	});
});
</script>
</body>
</html>