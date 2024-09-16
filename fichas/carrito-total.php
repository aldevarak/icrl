<?php
include ("../inic/dbcon.php");
@session_start();

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

if (isset($_POST['modo'])){ $modo = $_POST['modo'];}
if (isset($_GET['modo'])){ $modo = $_GET['modo'];}
//echo $id."<br>";
//echo $modo."<br>";

if($modo=="agregar"){
	$opc_precio=$_SESSION['params']['nu_mostrar_precios'];
	if ($opc_precio=="0"){
		echo "<script type='text/javascript' charset='utf-8'>BootstrapDialog.alert('El Administrador tiene Bloqueados los Precios, no se pueden crear el Carrito de Compras');</script>";
	}
	
	if ($opc_precio=="1"){
		$cantidad_carrito=count($_SESSION['carrito']);
		//echo $cantidad_carrito."<br>";
		
		$agregar=1;
		
		if ($cantidad_carrito>=0){
			$nuevo_carrito=$cantidad_carrito+1;
			//for ($i=0;$i<count($_SESSION['carrito']);$i++) {
			foreach ((array)$_SESSION['carrito'] as $i => $value) {	
				//echo $i."<br>";
				if($id==$_SESSION['carrito'][$i]){
					$agregar=0;
				}
			}
		}else{
			$nuevo_carrito=1;
			$agregar=1;
		}
		
		if($agregar==1){
			$_SESSION['carrito'][$nuevo_carrito]=$id;
			$_SESSION['item'][$nuevo_carrito]=1;
		}else{
			$marco="<div>Este Producto ya existe en el carrito</div>";
			echo $marco;
		}
	}
	
	if ($opc_precio=="2"){
		if (isset($_SESSION['co_nivel_usuario'])){
			$cantidad_carrito=count($_SESSION['carrito']);
			//echo $cantidad_carrito."<br>";
			
			$agregar=1;
			
			if ($cantidad_carrito>=0){
				$nuevo_carrito=$cantidad_carrito+1;
				//for ($i=0;$i<count($_SESSION['carrito']);$i++) {
				foreach ((array)$_SESSION['carrito'] as $i => $value) {	
					//echo $i."<br>";
					if($id==$_SESSION['carrito'][$i]){
						$agregar=0;
					}
				}
			}else{
				$nuevo_carrito=1;
				$agregar=1;
			}
			
			if($agregar==1){
				$_SESSION['carrito'][$nuevo_carrito]=$id;
				$_SESSION['item'][$nuevo_carrito]=1;
			}else{
				$marco="<div>Este Producto ya existe en el carrito</div>";
				echo $marco;
			}
		}else{
			echo "<script type='text/javascript' charset='utf-8'>BootstrapDialog.alert('El Administrador tiene Bloqueados los Precios para los Usuarios no Registrados, debe registrarse para poder crear su Carrito de Compras!');</script>";
		}
	}
}

if($modo=="vaciar"){
	unset($_SESSION['carrito'],$_SESSION['item'],$_SESSION['subtotal'],$_SESSION['total']);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Carrito Total</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12">
        <h2>Su Carrito <button type='button' class='btn btn-danger btn-eliminar' onClick="vaciar();"><span class='glyphicons glyphicons-inbox-out'></span><i class='fa fa-trash'></i> Vaciar Carrito</button></h2>
        <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Producto</th>
						<th>Stock Disponible</th>
                        <th>Cantidad</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php
				//for ($i=0;$i<count($_SESSION['carrito']);$i++) {
				foreach ((array)$_SESSION['carrito'] as $i => $value) {
					$result = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$_SESSION['carrito'][$i]."'");
					$row = mysqli_fetch_array($result);
					
					//CONOCER EL PRECIO DEL PRODUCTO A USAR
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
					if($row['in_excento']=="0"){
						if($_SESSION['params']['in_iva']=="0"){
							$iva1=($precio1*$_SESSION['params']['tx_iva'])/100;
							$iva1=number_format($iva1,2);
							
							$iva2=($precio2*$_SESSION['params']['tx_iva'])/100;
							$iva2=number_format($iva2,2);
							
							$precio1=$precio1-$iva1;
							$precio2=$precio2-$iva2;
							
							if ($row['in_oferta']=="1"){
								$precio_fijo=$precio2;
								$sub_total=$_SESSION['item'][$i]*$precio2;
								$iva2=$iva2*$_SESSION['item'][$i];
								$iva_total=$iva_total+$iva2;
							}else{
								$precio_fijo=$precio1;
								$sub_total=$_SESSION['item'][$i]*$precio1;
								$iva1=$iva1*$_SESSION['item'][$i];
								$iva_total=$iva_total+$iva1;
							}
						}else{
							$iva1=($precio1*$_SESSION['params']['tx_iva'])/100;
							$iva1=number_format($iva1,2);
							
							$iva2=($precio2*$_SESSION['params']['tx_iva'])/100;
							$iva2=number_format($iva2,2);
							
							//$precio1=$precio1+$iva1;
							//$precio2=$precio2+$iva2;
							
							if ($row['in_oferta']=="1"){
								$precio_fijo=$precio2;
								$sub_total=$_SESSION['item'][$i]*$precio2;
								$iva2=$iva2*$_SESSION['item'][$i];
								$iva_total=$iva_total+$iva2;
							}else{
								$precio_fijo=$precio1;
								$sub_total=$_SESSION['item'][$i]*$precio1;
								$iva1=$iva1*$_SESSION['item'][$i];
								$iva_total=$iva_total+$iva1;
							}
						}
					}else{
						$iva1=0;
						$iva2=0;
						
						$precio1=$precio1-$iva1;
						$precio2=$precio2-$iva2;
						
						if ($row['in_oferta']=="1"){
							$precio_fijo=$precio2;
							$sub_total=$_SESSION['item'][$i]*$precio2;
							$iva2=$iva2*$_SESSION['item'][$i];
							$iva_total=$iva_total+$iva2;
						}else{
							$precio_fijo=$precio1;
							$sub_total=$_SESSION['item'][$i]*$precio1;
							$iva1=$iva1*$_SESSION['item'][$i];
							$iva_total=$iva_total+$iva1;
						}
					}
					//
					
					$nombre_fichero = '../img_productos/p'.$_SESSION['carrito'][$i].'-1.jpg';
					
					if (file_exists($nombre_fichero)) {
						$archivo='../img_productos/p'.$_SESSION['carrito'][$i].'-1.jpg';
					}else{
						$archivo='../img_productos/defpro.gif';
					}
					
					$estructura.="
					<tr>
                        <td class='col-sm-8 col-md-5'>
                        <div class='media'>";
						
					if($_SESSION['params']['in_img_productocarrito']=="1"){
						$archivo=$archivo.'?x=='.md5(time());
						
						$estructura.="<a class='thumbnail pull-left hidden-xs' href='javaScript:;' onclick=\"parent.cambio('../fichas/detalles-pro.php?id=".$row['co_productos']."','cont');\"><img class='media-object' src='".$archivo."' style='width: 72px; height: 72px;'></a>";
					}
					
					$estructura.="
                            <div class='media-body'>
                                <h5 class='media-heading'><a class='pull-left' href='javaScript:;' onclick=\"parent.cambio('../fichas/detalles-pro.php?id=".$row['co_productos']."','cont');\">".$row['nb_productos']."</a></h5>";
								
								
					if($row['in_excento']=="1"){
						$estructura.="<div>Producto Excento de Iva</div>";
					}
					
					$estructura.="
                                <!--<h5 class='media-heading'> por <a href='#'>Nombre de quien lo vende</a></h5>-->
                                <!--<span>Estado: </span><span class='text-success'><strong>Disponible</strong></span>-->
                            </div>
                        </div></td>
						<td class='col-sm-1 col-md-1' style='text-align: center'>
                        <input type='number' class='form-control' id='stock".$row['co_productos']."' name='stock".$row['co_productos']."' value='".$row['nu_stock']."' readonly>
                        </td>
                        <td class='col-sm-1 col-md-1' style='text-align: center'>
                        <input type='number' class='form-control' min='1' max='".$row['nu_stock']."' id='cant_pro' name='cant_pro' value='".$_SESSION['item'][$i]."' onChange=\"validar_valor(".$i.",this.value,".$row['co_productos'].")\">
                        </td>
                        <td class='col-sm-2 col-md-2 text-center'><strong>".number_format($precio_fijo,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</strong></td>
                        <td class='col-sm-1 col-md-1 text-center'><strong>".number_format($sub_total,2,",",".")." ".$_SESSION['moneda']['di_simbolo']."</strong></td>
                        <td class='col-sm-1 col-md-1'>
                        <button type='button' class='btn btn-sm btn-danger btn-eliminar' onClick=\"eliminar_pro(".$i.")\">
                            <i class='fa fa-trash'></i>
                        </button></td>
                    </tr>";
						
					$_SESSION['subtotal'][$i]=$sub_total;
					$suma_sub_total=$suma_sub_total+$sub_total;
					$suma_final=$suma_sub_total+$iva_total;
					$total_items=$total_items+$_SESSION['item'][$i];
				}
				echo $estructura;
				
				$_SESSION['total'][1]=$suma_final;
				$texto_carrito=$total_items." productos / ".number_format($suma_final,2,",",".")." Bsf";
				
				echo "<script type='text/javascript'>parent.$('#tx_carrito small').text('".$texto_carrito."');</script>";
				?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong><?php echo number_format($suma_sub_total,2,",",".");?> <?php echo $_SESSION['moneda']['di_simbolo'];?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Iva <?php echo $_SESSION['params']['tx_iva'];?>%</h5></td>
                        <td class="text-right"><h5><strong><?php echo number_format($iva_total,2,",",".");?> <?php echo $_SESSION['moneda']['di_simbolo'];?></strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h4><strong><?php echo number_format($suma_final,2,",",".");?> <?php echo $_SESSION['moneda']['di_simbolo'];?></strong></h4></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <button type="button" class="btn btn-default" onClick="parent.cambio('../fichas/inicio.php','cont');">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Seguir comprando
                        </button></td>
                        <td>
                        <button type="button" class="btn btn-success"  onClick="procesar();">
                            Procesar <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
</div>
<div id="funciones"></div>
<script language="javascript">
function eliminar_pro(id) {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea eliminar el producto de su carrito?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						//alert(id);
						
						var parametros = {
								"id" : id
						};

						$.ajax({
								data:  parametros,
								url:   '../funciones_ajax/fun_carrito_eliminar.php?id='+id,
								type:  'post',
								beforeSend: function () {
										$("#funciones").html("Procesando, espere por favor...");
								},
								success:  function (response) {
										$("#funciones").html(response);
										parent.cambio('../fichas/carrito-total.php?modo=ver','cont');
								}
						});
						dialogItself2.close();
					}
			}, {
					label: 'No',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });

}

function procesar() {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Seguro desea Procesar su carrito?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//alert(id);
						parent.cambio('../fichas/procesar_pedido.php','cont');
						
						dialogItself2.close();
					}
			}, {
					label: 'No',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });

}

//VALOR CANTIDAD PRODUCTOS
function cambiar_valor(id,valor) {
//alert(id);
//alert('valor:'+valor);
	
	var parametros = {
		"id" : id,
		"valor" : valor
	};

	$.ajax({
			data:  parametros,
			url:   '../funciones_ajax/fun_carrito.php?id='+id+'&valor='+valor,
			type:  'post',
			beforeSend: function () {
					$("#funciones").html("Procesando, espere por favor...");
			},
			success:  function (response) {
					$("#funciones").html(response);
					parent.cambio('../fichas/carrito-total.php?modo=ver','cont');
			}
	});
	
}
	
function validar_valor(id,valor,pro) {
//alert(id);

	var valor=parseInt(valor);
	var x = parseInt(document.getElementById("stock"+pro).value); 
	//alert('stock:'+x);
	//alert('valor:'+valor);
	
	if (x<valor){
		//alert('valor muy alto');
		
		BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_DANGER,
			title: 'Error',
            message: 'La Cantidad a Comprar no puede ser superior al inventario disponible'
    	});
		
		cambiar_valor(id,x);
	}else{
		cambiar_valor(id,valor);
	}
}

function vaciar() {
	BootstrapDialog.show({
			size: BootstrapDialog.SIZE_SMALL,
			type: BootstrapDialog.TYPE_WARNING,
			title: 'Confirmación',
            message: '¿Esta Seguro de Vaciar los Productos de su carrito?',
            buttons: [{
					icon: 'glyphicon glyphicon-ok',
					label: 'Si',
					cssClass: 'btn-primary',
					action: function(dialogItself2){
						//any custom logic here
						//borrar(id);
						//alert(id);
						
						parent.cambio('../fichas/carrito-total.php?modo=vaciar','cont');
						dialogItself2.close();
					}
			}, {
					label: 'No',
					action: function(dialogItself){
						//scheduler.deleteEvent(id);
						dialogItself.close();
				}
				}]
    });

}
</script>
</body>
</html>