<?php 
include ("../../../inic/dbcon.php");
include ("../../../inic/session.php");


$result = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$config = mysqli_fetch_array($result);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inicio</title>
</head>

<body>
<div class="container-fluid"><!--CUERPO DE LA PAGINA-->
<ul class="nav nav-tabs" role="tablist" id="myTab"> <!--PESTAÑAS-->
  <li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
  <li role="presentation"><a href="#clientes" aria-controls="clientes" role="tab" data-toggle="tab">Clientes</a></li>
  <li role="presentation"><a href="#productos" aria-controls="productos" role="tab" data-toggle="tab">Productos</a></li>
  <li role="presentation"><a href="#divisiones" aria-controls="divisiones" role="tab" data-toggle="tab">Divisiones</a></li>
  <li role="presentation"><a href="#carrito" aria-controls="carrito" role="tab" data-toggle="tab">Carrito</a></li>
  <li role="presentation"><a href="#contacto" aria-controls="contacto" role="tab" data-toggle="tab">Contacto</a></li>
  <li role="presentation"><a href="#contenidos" aria-controls="contenidos" role="tab" data-toggle="tab">Contenidos</a></li>
</ul>

<div class="tab-content"> <!--CONTENIDOS PESTAÑAS-->
  <div role="tabpanel" class="tab-pane" id="general">
  <!--GENERAL-->
  	<form id="frm_general" name="frm_general" method="post" action="../pages/index.php">
      <div class="form-group col-md-6">
        <label for="tx_titulo_tienda">Titulo de la tienda</label>
        <input type="text" class="form-control" id="tx_titulo_tienda" name="tx_titulo_tienda" placeholder="Coloque el nombre de su tienda" value="<?php echo $config['tx_titulo_tienda']; ?>" required>
        <small>Indique el nombre o titulo de la tienda, éste aparecerá en la ventana del navegador.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_nombre_empresa">Razón Social</label>
        <input type="text" class="form-control" id="tx_nombre_empresa" name="tx_nombre_empresa" placeholder="Indique el nombre de su empresa" value="<?php echo $config['tx_nombre_empresa']; ?>" required>
        <small>Introduzca aqui el nombre/razón social de la empresa.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_rif">Rif</label>
        <input type="text" class="form-control" id="tx_rif" name="tx_rif" placeholder="Indique el rif de su empresa" value="<?php echo $config['tx_rif']; ?>" data-mask-clearifnotmatch="true" required>
        <small>Introduzca aqui el R.I.F de la empresa.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_pie">Pie de página</label>
        <input type="text" class="form-control" id="tx_pie" name="tx_pie" placeholder="Ingrese el texto que desea" value="<?php echo $config['tx_pie']; ?>" required>
        <small>Introduzca aqui el texto que aparecerá en el pie de pagina de la tienda.</small>
      </div>
      <div class="form-group col-md-6">
        <img src="../../img/<?php echo $config['tx_logo'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Logo actual"><!--COLOCAR EL ID DE tx_logo--> 
      </div>
      <div class="form-group col-md-6">
        <label for="mylogo">Logo de la tienda</label>
        <input type="file" id="mylogo" name="mylogo">
        <div id="erroralcargar" class="help-block"></div>
        <p class="help-block">Puede cargar aqui el logotipo de su empresa para que aparezca en la cabecera de la tienda; Recomendación: Usar una imagen jpg o png con una altura no mayor a 60px .</p>
      </div>
      <div class="form-group col-md-6">
        <label for="co_monedas">Moneda de la tienda</label>
        <select class="form-control" id="co_monedas" name="co_monedas">
          <?php
		  	$sql222="SELECT * FROM tg0031_monedas WHERE in_estatus='1' ORDER BY nb_monedas";
			$result222 = mysqli_query($link,$sql222);				
			
			while ($row22 = mysqli_fetch_array($result222)) {
				$condiciones22.= '<option value="'.$row22['co_monedas'].'" ';
				if ($config['co_monedas']==$row22['co_monedas']){ $condiciones22.= 'selected';}
				$condiciones22.= ' >'.$row22['nb_monedas'].' - '.$row22['di_simbolo'].'</option>';	
			}
			echo $condiciones22;
		  ?>
        </select>
        <p class="help-block">Seleccione la Moneda Comercial que utilizara su tienda.</p>
      </div>
      <div class="form-group col-md-12">
      <button type="submit" class="btn btn-default" id="btn_general" name="btn_general">Guardar</button>
      </div>
    </form>
  </div>


  <div role="tabpanel" class="tab-pane" id="clientes">
  <!--CLIENTES-->
  <form id="frm_clientes" name="frm_clientes" method="post" action="../pages/index.php#clientes">
      <div class="form-group col-md-4">
        <div class="checkbox">
            <label>
              <?php
				if ($config['in_nuevos_clientes']=="1"){
					$estructura="<input type='checkbox' id='in_nuevos_clientes' name='in_nuevos_clientes' checked> Permitir registro de nuevos clientes";  
				}else{
					$estructura="<input type='checkbox' id='in_nuevos_clientes' name='in_nuevos_clientes'> Permitir registro de nuevos clientes";
				}
			  echo $estructura;
			  ?>
            </label>
          </div>
        <small>Marque esta opción si desea que se registren usuarios nuevos.</small>
      </div>
      <div class="form-group col-md-3">
        <label for="tx_formato">Formato codigo cliente</label>
        <input type="text" class="form-control" id="tx_formato" name="tx_formato" placeholder="WEB-000" value="<?php echo $config['tx_formato']; ?>" required>
      </div>
      <div class="form-group col-md-5">
        <small>Indique el formato del codigo para los clientes que se registren; Ejemplo: WEB-000.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-4">
        <label for="co_tpcliente">Tipo de cliente predeterminado</label>
        <select class="form-control" id="co_tpcliente" name="co_tpcliente">
          <?php
		  	$sql2="SELECT * FROM tg001_tpcliente WHERE in_estatus='1' ORDER BY nb_tpcliente";
			$result2 = mysqli_query($link,$sql2);				
			
			while ($row = mysqli_fetch_array($result2)) {
				$condiciones.= '<option value="'.$row['co_tpcliente'].'" ';
				if ($config['co_tpcliente']==$row['co_tpcliente']){ $condiciones.= 'selected';}
				$condiciones.= ' >'.$row['nb_tpcliente'].'</option>
				   ';	
			}
			echo $condiciones;
		  ?>
        </select>
      </div>
      <div class="form-group col-md-8">
        <small>Seleccione el tipo de cliente predeterminado para los clientes que se registren o abran la aplicacion sin loguearse. Recuerde que cada tipo de cliente tiene un precio configurado por usted, el cual se mostrará por defecto en el catalogo. Con la opción "Automático" el catalogo mostrará siempre el Tipo de cliente con el precio más alto establecido en su sistema.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-4">
        <label for="co_vendedor">Vendedor predeterminado</label>
        <select class="form-control" id="co_vendedor" name="co_vendedor">
        <?php
		  	$sql2="SELECT * FROM tg002_vendedor WHERE in_estatus='1' ORDER BY nb_vendedor";
			$result2 = mysqli_query($link,$sql2);				
			
			while ($row = mysqli_fetch_array($result2)) {
				$condiciones2.= '<option value="'.$row['co_vendedor'].'" ';
				if ($config['co_vendedor']==$row['co_vendedor']){ $condiciones2.= 'selected';}
				$condiciones2.= ' >'.$row['nb_vendedor'].'</option>
				   ';	
			}
			echo $condiciones2;
		  ?>
        </select>
        <small>Seleccione el vendedor predeterminado para los clientes que se registren.</small>
      </div>
      <div class="form-group col-md-8">
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_generar_clave']=="1"){
					$estructura="<input type='checkbox' id='in_generar_clave' name='in_generar_clave' checked> Generar login y clave";  
				}else{
					$estructura="<input type='checkbox' id='in_generar_clave' name='in_generar_clave'> Generar login y clave";
				}
			  echo $estructura;
			  ?>
            </label>
          </div>
        <small>Marque esta opción para permitir que el usuario nuevo genere su login y contraseña, desactivela si desea que solo el administrador lo genere.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-12">
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_usuarios_anonimos']=="1"){
					$estructura="<input type='checkbox' id='in_usuarios_anonimos' name='in_usuarios_anonimos' checked> Permitir usuarios anónimose";  
				}else{
					$estructura="<input type='checkbox' id='in_usuarios_anonimos' name='in_usuarios_anonimos'> Permitir usuarios anónimos";
				}
			  echo $estructura;
			  ?>
            </label>
        </div>
        <small>Marque esta opción para habilitar el acceso público a la tienda desmarquela para restringir el acceso solo a los usuarios registrados con login y contraseña podrán accesar.</small>
      </div>
      <div class="form-group col-md-12">
      <button type="submit" class="btn btn-default" id="btn_clientes" name="btn_clientes">Guardar</button>
      </div>
  </form>
  </div>

  <div role="tabpanel" class="tab-pane" id="productos">
  <!--PRODUCTOS--><!--PRODUCTOS--><!--PRODUCTOS--><!--PRODUCTOS--><!--PRODUCTOS--><!--PRODUCTOS-->
  <form id="frm_productos" name="frm_productos" method="post" action="../pages/index.php#productos">
      <div class="form-group col-md-8">
        <label for="nu_mostrar_precios">Mostrar precios</label>
         <?php
				if ($config['nu_mostrar_precios']=="0"){
					$estructura2.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_precios' id='nu_mostrar_precios' value='0' checked> No
								</label>";  
				}else{
					$estructura2.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_precios' id='nu_mostrar_precios' value='0'> No
								</label>";
				}
				
				if ($config['nu_mostrar_precios']=="1"){
					$estructura2.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_precios' id='nu_mostrar_precios' value='1' checked> Si
								</label>";  
				}else{
					$estructura2.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_precios' id='nu_mostrar_precios' value='1'> Si
								</label>";
				}
				
				if ($config['nu_mostrar_precios']=="2"){
					$estructura2.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_precios' id='nu_mostrar_precios' value='2' checked> Solo para clientes registrados
								</label>";  
				}else{
					$estructura2.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_precios' id='nu_mostrar_precios' value='2'> Solo para clientes registrados
								</label>";
				}
				
			  echo $estructura2;
			  ?>        
        <p class="help-block">Marque esta opción para mostrar el precio del producto tanto el detalle del producto como en listados.</p>
      </div>
      <div class="form-group col-md-6">
        <label for="nu_cantidad_stock">Mostrar cantidad (stock)</label>
        <?php
				if ($config['nu_mostrar_cantidad']=="0"){
					$estructura3.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_cantidad' id='nu_mostrar_cantidad' value='0' checked> No
								</label>";  
				}else{
					$estructura3.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_cantidad' id='nu_mostrar_cantidad' value='0'> No
								</label>";
				}
				
				if ($config['nu_mostrar_cantidad']=="1"){
					$estructura3.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_cantidad' id='nu_mostrar_cantidad' value='1' checked> Si
								</label>";  
				}else{
					$estructura3.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_cantidad' id='nu_mostrar_cantidad' value='1'> Si
								</label>";
				}
				
				if ($config['nu_mostrar_cantidad']=="2"){
					$estructura3.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_cantidad' id='nu_mostrar_cantidad' value='2' checked> Usar etiquetas 
								</label>";  
				}else{
					$estructura3.="<label class='radio-inline'>
								  <input type='radio' name='nu_mostrar_cantidad' id='nu_mostrar_cantidad' value='2'> Usar etiquetas  registrados
								</label>";
				}
				
			  echo $estructura3;
			  ?> 
        <p class="help-block">Indique aquí como desea mostrar la cantidad (stock) del producto tanto el detalle del producto como en listados.</p>
      </div>
      <div class="form-group col-md-6">
        <label for="nu_cantidad_stock">Mostrar productos con Stock 0 (cero)</label>
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_stock_cero']=="1"){
					$estructura="<input type='checkbox' id='in_stock_cero' name='in_stock_cero' checked> Mostrar productos con Stock 0";  
				}else{
					$estructura="<input type='checkbox' id='in_stock_cero' name='in_stock_cero'> Mostrar productos con Stock 0";
				}
			  echo $estructura;
			  ?>
            </label>
        </div>
        <p class="help-block">Marque esta opción aquí si desea mostrar sus productos que no esten en existencia.</p>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-2">
        <label for="nu_cantidad_stock">Stock crítico</label>
        <input type="number" class="form-control" id="nu_cantidad_stock" name="nu_cantidad_stock" placeholder="Indique el numero del stock critico" value="<?php echo $config['nu_cantidad_stock']; ?>" required>
        <small>Indique aquí la cantidad a considerar como stock critico de un producto.</small>
      </div>
      <div class="form-group col-md-3">
        <label for="tx_etiqueta_cero">Cuando el stock es igual a 0 mostrar</label>
        <input type="text" class="form-control" id="tx_etiqueta_cero" name="tx_etiqueta_cero" placeholder="Indique la etiqueta" value="<?php echo $config['tx_etiqueta_cero']; ?>" required>
        <small>Introduzca aquí las etiquetas que desea mostrar en el campo cantidad (stock) del producto.</small>
      </div>
      <div class="form-group col-md-3">
        <label for="tx_etiqueta_critico">Cuando el stock es menor o igual al crítico mostrar</label>
        <input type="text" class="form-control" id="tx_etiqueta_critico" name="tx_etiqueta_critico" placeholder="Indique la etiqueta" value="<?php echo $config['tx_etiqueta_critico']; ?>" required>
        <small>Introduzca aquí las etiquetas que desea mostrar en el campo cantidad (stock) del producto.</small>
      </div>
      
      <div class="form-group col-md-3">
        <label for="tx_etiqueta_superior">Cuando el stock es mayor al crítico mostrar</label>
        <input type="text" class="form-control" id="tx_etiqueta_superior" name="tx_etiqueta_superior" placeholder="Indique la etiqueta" value="<?php echo $config['tx_etiqueta_superior']; ?>" required>
        <small>Introduzca aquí las etiquetas que desea mostrar en el campo cantidad (stock) del producto.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-6">
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_destacados']=="1"){
					$estructura="<input type='checkbox' id='in_destacados' name='in_destacados' checked> Habilitar productos destacados";  
				}else{
					$estructura="<input type='checkbox' id='in_destacados' name='in_destacados'> Habilitar productos destacados";
				}
			  echo $estructura;
			  ?>
            </label>
          </div>
        <small>Habilita la caracteristica de productos destacados en la pagina pincipal.</small>
      </div>
      <div class="form-group col-md-2" style="display:none !important">
            <label>Numero de productos destacados</label>
            <input type="number" class="form-control" id="nu_destacados" name="nu_destacados" placeholder="cantidad de productos destacados" value="<?php echo $config['nu_destacados']; ?>" required>
      
      </div>
      <div class="form-group col-md-2">
            <label>Numero de imagenes de producto</label>
            <input type="number" class="form-control" id="nu_imagenes_pro" name="nu_imagenes_pro" placeholder="5" value="<?php echo $config['nu_imagenes_pro']; ?>" required>
      
      </div>
      <div class="form-group col-md-2">
        <label for="nu_productos_pag">Número de productos por página</label>
        <select class="form-control" id="nu_productos_pag" name="nu_productos_pag">
        <?php
			if ($config['nu_productos_pag']=="4"){
				$estructura4.="<option value='4' selected>Mostrar 4</option>";  
			}else{
				$estructura4.="<option value='4'>Mostrar 4</option>";
			}
			if ($config['nu_productos_pag']=="8"){
				$estructura4.="<option value='8' selected>Mostrar 8</option>";  
			}else{
				$estructura4.="<option value='8'>Mostrar 8</option>";
			}
			if ($config['nu_productos_pag']=="12"){
				$estructura4.="<option value='12' selected>Mostrar 12</option>";  
			}else{
				$estructura4.="<option value='12'>Mostrar 12</option>";
			}
			if ($config['nu_productos_pag']=="24"){
				$estructura4.="<option value='24' selected>Mostrar 24</option>";  
			}else{
				$estructura4.="<option value='24'>Mostrar 24</option>";
			}
		echo $estructura4;
		?>
        </select>
      </div>
      <div class="form-group col-md-12">
      <button type="submit" class="btn btn-default" id="btn_productos" name="btn_productos">Guardar</button>
      </div>
    </form>
  </div>

  <div role="tabpanel" class="tab-pane" id="divisiones">
  <!--DIVISIONES--><!--DIVISIONES--><!--DIVISIONES--><!--DIVISIONES--><!--DIVISIONES--><!--DIVISIONES-->
  <form id="frm_divisiones" name="frm_divisiones" method="post" action="../pages/index.php#divisiones">
      <div class="form-group col-md-6">
       <div class="checkbox">
          <label>
          	<?php
				if ($config['in_categorias']=="1"){
					$estructura="<input type='checkbox' id='in_categorias' name='in_categorias' checked> Mostrar Categorias";  
				}else{
					$estructura="<input type='checkbox' id='in_categorias' name='in_categorias'> Mostrar Categorias";
				}
			echo $estructura;
			?>
          </label>
       </div>
        <small>Marque esta opción para mostrar el bloque de Categorias, cuando se esta visualizando el listado de productos de una categoria, en la columna derecha.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_categorias">Etiqueta para Categorias</label>
        <input type="text" class="form-control" id="tx_categorias" name="tx_categorias" placeholder="Indique el nombre de su Categoria" value="<?php echo $config['tx_categorias']; ?>" required>
        <small>Introduzca aquí una etiqueta para el bloque derecho donde aparecerán las categorias.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-6">
       <div class="checkbox">
          <label>
          	<?php
				if ($config['in_lineas']=="1"){
					$estructura="<input type='checkbox' id='in_lineas' name='in_lineas' checked> Mostrar Líneas";  
				}else{
					$estructura="<input type='checkbox' id='in_lineas' name='in_lineas'> Mostrar Líneas";
				}
			echo $estructura;
			?>
          </label>
       </div>
        <small>Marque esta opción para mostrar el bloque de líneas, cuando se esta visualizando el listado de productos de una línea, en la columna derecha.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_lineas">Etiqueta para Líneas</label>
        <input type="text" class="form-control" id="tx_lineas" name="tx_lineas" placeholder="Indique el nombre de su Linea" value="<?php echo $config['tx_lineas']; ?>" required>
        <small>Introduzca aquí una etiqueta para el bloque derecho donde aparecerán las líneas.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-6">
       <div class="checkbox">
          <label>
          	<?php
				if ($config['in_sublineas']=="1"){
					$estructura="<input type='checkbox' id='in_sublineas' name='in_sublineas' checked> Mostrar Sub-Líneas";  
				}else{
					$estructura="<input type='checkbox' id='in_sublineas' name='in_sublineas'> Mostrar Sub-Líneas";
				}
			echo $estructura;
			?>
          </label>
       </div>
        <small>Marque esta opción para mostrar el bloque de sub-líneas, cuando se esta visualizando el listado de productos de una sub-línea, en la columna derecha.</small>
      </div>
      
      <div class="form-group col-md-6">
        <label for="tx_sublineas">Etiqueta para Sub-líneas</label>
        <input type="text" class="form-control" id="tx_sublineas" name="tx_sublineas" placeholder="Indique el nombre de la sub_lineas" value="<?php echo $config['tx_sublineas']; ?>" required>
        <small>Introduzca aquí una etiqueta para el bloque derecho donde aparecerán las sub-líneas.</small>
      </div>
      <div class="form-group col-md-12">
      <button type="submit" class="btn btn-default" id="btn_division" name="btn_division">Guardar</button>
      </div>
    </form>
  </div>
  
  <div role="tabpanel" class="tab-pane" id="carrito">
  <!--CARRITO--><!--CARRITO--><!--CARRITO--><!--CARRITO--><!--CARRITO-->
  <form id="frm_carrito" name="frm_carrito" method="post" action="../pages/index.php#carrito">
      <div class="form-group col-md-4">
        <label for="tx_correo_pedidos">Correo electrónico de pedidos</label>
        <input type="email" class="form-control" id="tx_correo_pedidos" name="tx_correo_pedidos" placeholder="empresa@empresa.com" value="<?php echo $config['tx_correo_pedidos']; ?>" required>
        <small>Introduzca aquí la dirección de correo electrónico donde se recibirán los mensajes de pedidos.</small>
      </div>
      <div class="form-group col-md-4">
        <label for="tx_formato_pedido">Formato de número de Pedido</label>
        <input type="text" class="form-control" id="tx_formato_pedido" name="tx_formato_pedido" placeholder="AAAAA-00000" value="<?php echo $config['tx_formato_pedido']; ?>" data-mask-clearifnotmatch="true" required>
        <small>Indique el formato para el correlativo de los pedidos, debe incluir mínimo 5 "ceros" al final para indicar la pocision de los numeros, Ejemplo: ABCDE-00000.</small>
      </div>
      <div class="form-group col-md-4">
        <label for="tx_vencimiento">Vencimiento de pedidos</label>
        <input type="number" class="form-control" id="tx_vencimiento" name="tx_vencimiento" placeholder="0" value="<?php echo $config['tx_vencimiento']; ?>" required>
        <small>Introduzca La cantidad de días en los que venceran los pedidos.</small>
      </div>
      
      <div class="clearfix"></div>
      <div class="form-group col-md-3">
        <label for="tx_condicion_pago">Condicion de Pago</label>
        <select class="form-control" id="tx_condicion_pago" name="tx_condicion_pago">
        <?php
			if ($config['tx_condicion_pago']=="1"){
				$estructura5.="<option value='1' selected>Contado</option>";  
			}else{
				$estructura5.="<option value='1'>Contado</option>";
			}
			if ($config['tx_condicion_pago']=="15"){
				$estructura5.="<option value='15' selected>Credito a 15 Días</option>";  
			}else{
				$estructura5.="<option value='15'>Credito a 15 Días</option>";
			}
			if ($config['tx_condicion_pago']=="30"){
				$estructura5.="<option value='30' selected>Credito a 30 Días</option>";  
			}else{
				$estructura5.="<option value='30'>Credito a 30 Días</option>";
			}
			if ($config['tx_condicion_pago']=="45"){
				$estructura5.="<option value='45' selected>Credito a 45 Días</option>";  
			}else{
				$estructura5.="<option value='45'>Credito a 45 Días</option>";
			}
			if ($config['tx_condicion_pago']=="60"){
				$estructura5.="<option value='60' selected>Credito a 60 Días</option>";  
			}else{
				$estructura5.="<option value='60'>Credito a 60 Días</option>";
			}
			if ($config['tx_condicion_pago']=="90"){
				$estructura5.="<option value='90' selected>Credito a 90 Días</option>";  
			}else{
				$estructura5.="<option value='90'>Credito a 90 Días</option>";
			}
			if ($config['tx_condicion_pago']=="91"){
				$estructura5.="<option value='91' selected>Prepagado</option>";  
			}else{
				$estructura5.="<option value='91'>Prepagado</option>";
			}
		echo $estructura5;
		?>
        </select>
        <small>Seleccione la forma de pago predeterminada</small>
      </div>
      <div class="form-group col-md-5">
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_img_productocarrito']=="1"){
					$estructura="<input type='checkbox' id='in_img_productocarrito' name='in_img_productocarrito' checked> Mostrar imagen de producto en carrito de compras";  
				}else{
					$estructura="<input type='checkbox' id='in_img_productocarrito' name='in_img_productocarrito'> Mostrar imagen de producto en carrito de compras";
				}
			echo $estructura;
			?>
            </label>
          </div>
        <small>Habilite esta opción para mostrar una miniatura junto a la descripcion del producto en el carrito de compras.</small>
      </div>
      <div class="form-group col-md-4">
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_iva']=="1"){
					$estructura="<input type='checkbox' id='in_iva' name='in_iva' checked> Calcular I.V.A";  
				}else{
					$estructura="<input type='checkbox' id='in_iva' name='in_iva'> Calcular I.V.A";
				}
			echo $estructura;
			?>
            </label>
          </div>
        <small>Marque esta opción para calcular IVA sobre el precio de los productos en el carrito de compras y reflejar el monto.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-2">
            <label>Alicuota I.V.A %</label>
            <input type="number" class="form-control" id="tx_iva" name="tx_iva" placeholder="12.5" value="<?php echo $config['tx_iva']; ?>" required>
      </div>
      <div class="col-md-10">
      <label>Forma de Pago:</label>
        <div class="checkbox-inline">
            <label>
            <?php
				if ($config['in_deposito']=="1"){
					$estructura="<input type='checkbox' id='in_deposito' name='in_deposito' checked> Depósitos / Transferencias";  
				}else{
					$estructura="<input type='checkbox' id='in_deposito' name='in_deposito'> Depósitos / Transferencias";
				}
			echo $estructura;
			?>
            </label>
        </div>
        <div class="checkbox-inline">
            <label>
            <?php
				if ($config['in_credito']=="1"){
					$estructura="<input type='checkbox' id='in_credito' name='in_credito' checked disabled> Tarjeta de Crédito";  
				}else{
					$estructura="<input type='checkbox' id='in_credito' name='in_credito' disabled> Tarjeta de Crédito";
				}
			echo $estructura;
			?>
            </label>
        </div>
        <div class="clearfix"></div>
        <small>Marque esta opción para permitir que el usuario nuevo genere su login y contraseña, desactivela si desea que solo el administrador lo genere.</small>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-6">
      <label>Cuenta para depositos/transferencias</label>
        <select multiple class="form-control" id="co_cuentas[]" name="co_cuentas[]">
        <?php
		  	$sql3="SELECT * FROM tg003_cuentas WHERE in_estatus='1'";
			$result3 = mysqli_query($link,$sql3);				
			
			while ($row3 = mysqli_fetch_array($result3)) {
				$condiciones3.= '<option value="'.$row3['co_cuentas'].'" ';
				if ($row3['in_activa']=="1"){ $condiciones3.= 'selected';}
				$condiciones3.= ' >'.$row3['tx_banco'].' | '.$row3['tp_cuentas'].' | '.$row3['nu_cuenta'].'</option>
				   ';	
			}
			echo $condiciones3;
		  ?>  
        </select>
        <small>Seleccione la cuenta bancaria a usar en el modulo forma de pago depositos/transferencias</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_titular">Titular de la Cuenta:</label>
        <input type="text" class="form-control" id="tx_titular" name="tx_titular" placeholder="nombre del titular de las cuentas" value="<?php echo $config['tx_titular']; ?>" required>
        <small>Indique la razón social del titular de la cuenta del modulo de pagos.</small>
      </div>
      <div class="form-group col-md-12">
      <button type="submit" class="btn btn-default" id="btn_carrito" name="btn_carrito">Guardar</button>
      </div>
    </form>
    </div>

  <div role="tabpanel" class="tab-pane" id="contacto">
  <!--CONTACTO--><!--CONTACTO--><!--CONTACTO--><!--CONTACTO--><!--CONTACTO--><!--CONTACTO-->
  <form id="frm_contacto" name="frm_contacto" method="post" action="../pages/index.php#contacto">
      <div class="form-group col-md-12">
        <label for="tx_direccion">Dirección</label>
        <textarea class="form-control" rows="2" id="tx_direccion" name="tx_direccion"><?php echo $config['tx_direccion']; ?></textarea>
        <small>Ingrese aqui la dirección fisica de su comercio, esta aparecerá visible en el formulario de contacto así como también en el pie de los formatos de pedidos.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_telefono">Teléfono</label>
        <input type="text" class="form-control" id="tx_telefono" name="tx_telefono" placeholder="Indique el teléfono de su empresa"  value="<?php echo $config['tx_telefono']; ?>" required>
        <small>Indique uno o varios numeros de contacto telefónico.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_correo_contacto">Correo de contacto</label>
        <input type="email" class="form-control" id="tx_correo_contacto" name="tx_correo_contacto" placeholder="Indique el teléfono de su empresa" value="<?php echo $config['tx_correo_contacto']; ?>" required>
        <small>Introduzca aquí la dirección de correo electrónico donde se recibirán los mensajes de contacto, preguntas y comentarios.</small>
      </div>
      <div class="form-group col-md-6">
        <div class="checkbox">
            <label>
            <?php
				if ($config['in_mapa']=="1"){
					$estructura="<input type='checkbox' id='in_mapa' name='in_mapa' checked> Habilitar Característica Mapa de Ubicación";  
				}else{
					$estructura="<input type='checkbox' id='in_mapa' name='in_mapa'> Habilitar Característica Mapa de Ubicación";
				}
			echo $estructura;
			?>
            </label>
          </div>
        <small>Marque esta opción si desea que se muestre un mapa interactivo con información de la ubicación de su negocio en la pagina de contacto.</small>
      </div>
      <div class="form-group col-md-6">
        <label for="tx_coordenadas">Coordenadas Google Maps</label>
        <textarea class="form-control" rows="2" id="tx_coordenadas" name="tx_coordenadas"><?php echo $config['tx_coordenadas']; ?></textarea>
        <small>Indique las coordenadas que provee Google Maps (Latitud y Longitud) de la ubicacion física de su negocio a mostrar en el mapa Ejm: 10.496369, -66.881890.</small>
      </div>
      <div class="form-group col-md-12">
      <button type="submit" class="btn btn-default" id="btn_contacto" name="btn_contacto">Guardar</button>
      </div>
    </form>
  </div>
    <div role="tabpanel" class="tab-pane" id="contenidos"> <!--CONTENIDO--><!--CONTENIDO--><!--CONTENIDO-->
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#terminos">Términos y Condiciones</a></li>
		<li><a data-toggle="tab" href="#publi">Publicidad</a></li>
		<li><a data-toggle="tab" href="#sliders">Sliders</a></li>
        <li><a data-toggle="tab" href="#Categoriasresaltantes">Cat. Destacadas</a></li>
	</ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="terminos">
                <form id="frm_contenidos" name="frm_contenidos" method="post" action="../pages/index.php#terminos">
                    <h4>Terminos y Condiciones</h4>
                    <textarea name="tx_contenidos" rows="5" id="tx_contenidos" placeholder="Escriba Aqui..."><?php echo $config['tx_contenidos'];?></textarea>
                    <button type="submit" class="btn btn-default btn-block" id="btn_contenido_terminos" name="btn_contenido_terminos">Guardar Texto Escrito</button>
                </form>
            </div>
            <div class="tab-pane fade" id="publi">
                <form id="frm_contenidos" name="frm_contenidos" method="post" action="../pages/index.php#publicidad">
                    <h4>Publicidad</h4>
                            <div class="form-group col-md-12">
                              <div class="checkbox">
                                  <label>
                                    <?php
                                        if ($config['in_publicidad']=="1"){
                                            $estructura="<input type='checkbox' id='in_publicidad' name='in_publicidad' checked> Permitir que se Muestre la Publicidad";  
                                        }else{
                                            $estructura="<input type='checkbox' id='in_publicidad' name='in_publicidad'> Permitir que se Muestre la Publicidad";
                                        }
                                    echo $estructura;
                                    ?>
                                  </label>
                                </div>
                              <small>Marque esta opción si desea que se muestre la Publicidad.</small>
                            </div>
                            <div class="col-md-4">
                            	<div class="form-group col-md-12 espacio_publicidad">
                                    <img src="../../img/<?php echo $config['tx_imgpublicidad'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Publicidad actual"><!--COLOCAR EL ID DE tx_imgpublicidad--> 
                                </div>
                                <div class="form-group col-md-12 espacio_publicidad">
                                <label for="razon">Imagen de la publicidad Inferior</label>
                                    <input id="imgpublicidad" name="imgpublicidad" type="file" data-preview-file-type="img">
                                    <input name="action" type="hidden" value="upload" />
                                    <div id="erroralcargar" class="help-block"></div>
                                    <div id="status" class="help-block"></div>
                                    <small>Debe poseer el tamaño 1397px X 150px.</small>
                                </div>
                                <div class="form-group col-md-12 espacio_publicidad">
                                    <label for="tx_linkpublicidad">Link de la publicidad Inferior</label>
                                    <input type="text" class="form-control" id="tx_linkpublicidad" name="tx_linkpublicidad" placeholder="Indique la URL a donde enviara al hacer click" value="<?php echo $config['tx_linkpublicidad']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                            	<div class="form-group col-md-12 espacio_publicidad">
                                    <img src="../../img/<?php echo $config['tx_imgpublicidad2'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Publicidad actual"><!--COLOCAR EL ID DE tx_imgpublicidad--> 
                                </div>
                                <div class="form-group col-md-12 espacio_publicidad">
                                <label for="razon">Imagen de la publicidad Superior #1</label>
                                    <input id="imgpublicidad2" name="imgpublicidad2" type="file" data-preview-file-type="img">
                                    <input name="action" type="hidden" value="upload" />
                                    <div id="erroralcargar" class="help-block"></div>
                                    <div id="status" class="help-block"></div>
                                    <small>Debe poseer el tamaño 780px X 100px.</small>
                                </div>
                                <div class="form-group col-md-12 espacio_publicidad">
                                    <label for="tx_linkpublicidad2">Link de la publicidad Superior #1</label>
                                    <input type="text" class="form-control" id="tx_linkpublicidad2" name="tx_linkpublicidad2" placeholder="Indique la URL a donde enviara al hacer click" value="<?php echo $config['tx_linkpublicidad2']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                            	<div class="form-group col-md-12 espacio_publicidad">
                                    <img src="../../img/<?php echo $config['tx_imgpublicidad3'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Publicidad actual"><!--COLOCAR EL ID DE tx_imgpublicidad--> 
                                </div>
                                <div class="form-group col-md-12 espacio_publicidad">
                                <label for="razon">Imagen de la publicidad  Superior #2</label>
                                    <input id="imgpublicidad3" name="imgpublicidad3" type="file" accept="image/*" class="file-loading">
                                    <input name="action" type="hidden" value="upload" />
                                    <div id="erroralcargar"></div>
                                    <small>Debe poseer el tamaño 780px X 100px.</small>
                                </div>
                                <div class="form-group col-md-12 espacio_publicidad">
                                    <label for="tx_linkpublicidad3">Link de la publicidad Superior #2</label>
                                    <input type="text" class="form-control" id="tx_linkpublicidad3" name="tx_linkpublicidad3" placeholder="Indique la URL a donde enviara al hacer click" value="<?php echo $config['tx_linkpublicidad3']; ?>">
                                </div>
                            </div>
                    <button type="submit" class="btn btn-default btn-block" id="btn_publicidad" name="btn_publicidad">Guardar</button>
                </form>
            </div>
            <div class="tab-pane fade" id="sliders">
                    <form id="frm_contenidos" name="frm_contenidos" method="post" action="../pages/index.php#sliders">
                        <h4>Sliders</h4>
                          <!--Banner 1-->
                            <div class="form-group col-md-6">
                                <img src="../../img/<?php echo $config['tx_img1'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Imagen Banner 1"><!--COLOCAR EL ID DE tx_img1--> 
                            </div>
                            <div class="form-group col-md-6">
                            <label for="razon">Imagen Banner 1</label>
                                <input class="banner1" id="banner1" name="banner1" type="file" data-preview-file-type="any">
                                <div id="erroralcargar" class="help-block"></div>
                                <div id="status" class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tx_link1">Link 1</label>
                                <input type="text" class="form-control" id="tx_link1" name="tx_link1" placeholder="Indique la URL a donde enviara al hacer click" value="<?php echo $config['tx_link1']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="tx_tbanner1">Texto banner 1</label>
                                <input type="text" class="form-control" id="tx_tbanner1" name="tx_tbanner1" value="<?php echo $config['tx_tbanner1']; ?>">
                            </div>
                            <!--Banner 2-->
                            <div class="form-group col-md-6">
                                <img src="../../img/<?php echo $config['tx_img2'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Imagen Banner 1"><!--COLOCAR EL ID DE tx_img1--> 
                            </div>
                            <div class="form-group col-md-6">
                                <label for="razon">Imagen Banner 2</label>
                                <input class="banner2" id="banner2" name="banner2" type="file" data-preview-file-type="any">
                                <div id="erroralcargar" class="help-block"></div>
                                <div id="status" class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tx_link2">Link 2</label>
                                <input type="text" class="form-control" id="tx_link2" name="tx_link2" placeholder="Indique la URL a donde enviara al hacer click" value="<?php echo $config['tx_link2']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="tx_tbanner2">Texto banner 2</label>
                                <input type="text" class="form-control" id="tx_tbanner2" name="tx_tbanner2" value="<?php echo $config['tx_tbanner2']; ?>">
                            </div>
                            <!--Banner 3-->
                            <div class="form-group col-md-6">
                                <img src="../../img/<?php echo $config['tx_img3'].'?x=='.md5(time()); ?>" class="img-responsive" alt="Imagen Banner 1"><!--COLOCAR EL ID DE tx_img1--> 
                            </div>
                            <div class="form-group col-md-6">
                            <label for="razon">Imagen Banner 3</label>
                                <input class="banner3" id="banner3" name="banner3" type="file" data-preview-file-type="any">
                                <div id="erroralcargar" class="help-block"></div>
                                <div id="status" class="help-block"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tx_link3">Link 3</label>
                                <input type="text" class="form-control" id="tx_link3" name="tx_link3" placeholder="Indique la URL a donde enviara al hacer click" value="<?php echo $config['tx_link3']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="tx_tbanner3">Texto banner 3</label>
                                <input type="text" class="form-control" id="tx_tbanner3" name="tx_tbanner3" value="<?php echo $config['tx_tbanner3']; ?>">
                            </div>
                    <button type="submit" class="btn btn-default btn-block" id="btn_sliders" name="btn_sliders">Guardar</button>
                </form>
            </div>
            <div class="tab-pane fade" id="Categoriasresaltantes">
                    <form id="frm_contenidos" name="frm_contenidos" method="post" action="../pages/index.php#Categoriasresaltantes">
                    <h4>Categorias Resaltantes</h4>
                            <div class="form-group col-md-6">
                            <?php
                                if ($config['nu_categorias']=="0"){
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='0' checked> Ninguna Categoría
                                                    </label>";  
                                }else{
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='0'> Ninguna Categoría
                                                    </label>"; 
                                }
                                if ($config['nu_categorias']=="2"){
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='2' checked> 2 Categorías
                                                    </label>";  
                                }else{
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='2'> 2 Categorías
                                                    </label>"; 
                                }
                                if ($config['nu_categorias']=="4"){
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='4' checked> 4 Categorías
                                                    </label>"; 
                                }else{
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='4'> 4 Categorías
                                                    </label>"; 
                                }
                                if ($config['nu_categorias']=="6"){
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='6' checked> 6 Categorías
                                                    </label>"; 
                                }else{
                                    $estructura6.="<label class='radio-inline'>
                                                      <input type='radio' name='nu_categorias' id='nu_categorias' value='6'> 6 Categorías
                                                    </label>"; 
                                }
                            echo $estructura6;
                            ?>
                            </div>
                            <small>Indique la cantidad de Categorias Destacadas que desea mostrar en su pagina Inicio.</small>
                            
                            <?php
                                $sql10="SELECT * FROM tg007_categoria WHERE in_estatus='1' ORDER BY nb_categoria";
                                $result10 = mysqli_query($link,$sql10);//para categoria 1
                                $result11 = mysqli_query($link,$sql10);//para categoria 2
                                $result12 = mysqli_query($link,$sql10);//para categoria 3
                                $result13 = mysqli_query($link,$sql10);//para categoria 4
                                $result14 = mysqli_query($link,$sql10);//para categoria 5
                                $result15 = mysqli_query($link,$sql10);//para categoria 6					
                                
                                //PARA CATEGORIA 1
                                while ($row10 = mysqli_fetch_array($result10)) {
                                    $opcion_1.= '<option value="'.$row10['co_categoria'].'" ';
                                    if ($config['co_cat1']==$row10['co_categoria']){ $opcion_1.= 'selected';}
                                    $opcion_1.= ' >'.$row10['nb_categoria'].'</option>
                                       ';	
                                }
                                //PARA CATEGORIA 2
                                while ($row11 = mysqli_fetch_array($result11)) {
                                    $opcion_2.= '<option value="'.$row11['co_categoria'].'" ';
                                    if ($config['co_cat2']==$row11['co_categoria']){ $opcion_2.= 'selected';}
                                    $opcion_2.= ' >'.$row11['nb_categoria'].'</option>
                                       ';	
                                }
                                //PARA CATEGORIA 3
                                while ($row12 = mysqli_fetch_array($result12)) {
                                    $opcion_3.= '<option value="'.$row12['co_categoria'].'" ';
                                    if ($config['co_cat3']==$row12['co_categoria']){ $opcion_3.= 'selected';}
                                    $opcion_3.= ' >'.$row12['nb_categoria'].'</option>
                                       ';	
                                }
                                //PARA CATEGORIA 4
                                while ($row13 = mysqli_fetch_array($result13)) {
                                    $opcion_4.= '<option value="'.$row13['co_categoria'].'" ';
                                    if ($config['co_cat4']==$row13['co_categoria']){ $opcion_4.= 'selected';}
                                    $opcion_4.= ' >'.$row13['nb_categoria'].'</option>
                                       ';	
                                }
                                //PARA CATEGORIA 5
                                while ($row14 = mysqli_fetch_array($result14)) {
                                    $opcion_5.= '<option value="'.$row14['co_categoria'].'" ';
                                    if ($config['co_cat5']==$row14['co_categoria']){ $opcion_5.= 'selected';}
                                    $opcion_5.= ' >'.$row14['nb_categoria'].'</option>
                                       ';	
                                }
                                //PARA CATEGORIA 6
                                while ($row15 = mysqli_fetch_array($result15)) {
                                    $opcion_6.= '<option value="'.$row15['co_categoria'].'" ';
                                    if ($config['co_cat6']==$row15['co_categoria']){ $opcion_6.= 'selected';}
                                    $opcion_6.= ' >'.$row15['nb_categoria'].'</option>
                                       ';	
                                }
                            ?>
                            
                            <!--2 Categorias-->
                            <div class='form-group col-md-12 permitir_2_cat' style="display: none;">
                                <div class='form-group col-md-6'>
                                    <div class='form-group col-md-12'>
                                        <label>Categoría a resaltar</label>
                                        <select id="co_cat1" name="co_cat1" class="selectpicker" data-live-search="true" title="Seleccione Categoria">
                                            <?php
                                                echo $opcion_1;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="razon">Imagen de la categoría</label>
                                        <input class="tx_imgcat1" id="tx_imgcat1" name="tx_imgcat1" type="file" data-preview-file-type="any">
                                        <div id="erroralcargar" class="help-block"></div>
                                        <div id="status" class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div id="img_prev" style="background-image: url('../../img/<?php echo $config['tx_imgcat1'].'?x=='.md5(time()); ?>');" alt="Imagen Banner 1"></div>
                                </div>
                                <div class='form-group col-md-6'>
                                        <label for="tx_descat1">Descripción Breve</label>
                                        <textarea class="form-control" rows="4" id="tx_descat1" name="tx_descat1"><?php echo $config['tx_descat1']; ?></textarea>
                                </div>
                            </div>
                            <div class='form-group col-md-12 permitir_2_cat' style="display: none;">
                                <div class='form-group col-md-6'>
                                    <div class='form-group col-md-12'>
                                        <label>Categoría a resaltar</label>
                                        <select id="co_cat2" name="co_cat2" class="selectpicker" data-live-search="true" title="Seleccione Categoria">
                                            <?php
                                                echo $opcion_2;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="razon">Imagen de la categoría</label>
                                        <input class="tx_imgcat2" id="tx_imgcat2" name="tx_imgcat2" type="file" data-preview-file-type="any">
                                        <div id="erroralcargar" class="help-block"></div>
                                        <div id="status" class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div id="img_prev" style="background-image: url('../../img/<?php echo $config['tx_imgcat2'].'?x=='.md5(time()); ?>');" alt="Imagen Banner 2"></div>
                                </div>
                                <div class='form-group col-md-6'>
                                        <label for="tx_descat2">Descripción Breve</label>
                                        <textarea class="form-control" rows="4" id="tx_descat2" name="tx_descat2"><?php echo $config['tx_descat2']; ?></textarea>
                                </div>
                            </div>
                            
                            <!--4 Categorias-->
                            <div class='form-group col-md-12 permitir_4_cat' style="display: none;">
                                <div class='form-group col-md-6'>
                                    <div class='form-group col-md-12'>
                                        <label>Categoría a resaltar</label>
                                        <select id="co_cat3" name="co_cat3" class="selectpicker" data-live-search="true" title="Seleccione Categoria">
                                            <?php
                                                echo $opcion_3;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="razon">Imagen de la categoría</label>
                                        <input class="tx_imgcat3" id="tx_imgcat3" name="tx_imgcat3" type="file" data-preview-file-type="any">
                                        <div id="erroralcargar" class="help-block"></div>
                                        <div id="status" class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div id="img_prev" style="background-image: url('../../img/<?php echo $config['tx_imgcat3'].'?x=='.md5(time()); ?>');" alt="Imagen Banner 3"></div>
                                </div>
                                <div class='form-group col-md-6'>
                                        <label for="tx_descat3">Descripción Breve</label>
                                        <textarea class="form-control" rows="4" id="tx_descat3" name="tx_descat3"><?php echo $config['tx_descat3']; ?></textarea>
                                </div>
                            </div>
                            <div class='form-group col-md-12 permitir_4_cat' style="display: none;">
                                <div class='form-group col-md-6'>
                                    <div class='form-group col-md-12'>
                                        <label>Categoría a resaltar</label>
                                        <select id="co_cat4" name="co_cat4" class="selectpicker" data-live-search="true" title="Seleccione Categoria">
                                            <?php
                                                echo $opcion_4;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="razon">Imagen de la categoría</label>
                                        <input class="tx_imgcat4" id="tx_imgcat4" name="tx_imgcat4" type="file" data-preview-file-type="any">
                                        <div id="erroralcargar" class="help-block"></div>
                                        <div id="status" class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div id="img_prev" style="background-image: url('../../img/<?php echo $config['tx_imgcat4'].'?x=='.md5(time()); ?>');" alt="Imagen Banner 4"></div>
                                </div>
                                <div class='form-group col-md-6'>
                                        <label for="tx_descat4">Descripción Breve</label>
                                        <textarea class="form-control" rows="4" id="tx_descat4" name="tx_descat4"><?php echo $config['tx_descat4']; ?></textarea>
                                </div>
                            </div>
                            <!--6 Categorias-->
                            <div class='form-group col-md-12 permitir_6_cat' style="display: none;">
                                <div class='form-group col-md-6'>
                                    <div class='form-group col-md-12'>
                                        <label>Categoría a resaltar</label>
                                        <select id="co_cat5" name="co_cat5" class="selectpicker" data-live-search="true" title="Seleccione Categoria">
                                            <?php
                                                echo $opcion_5;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="razon">Imagen de la categoría</label>
                                        <input class="tx_imgcat5" id="tx_imgcat5" name="tx_imgcat5" type="file" data-preview-file-type="any">
                                        <div id="erroralcargar" class="help-block"></div>
                                        <div id="status" class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div id="img_prev" style="background-image: url('../../img/<?php echo $config['tx_imgcat5'].'?x=='.md5(time()); ?>');" alt="Imagen Banner 5"></div>
                                </div>
                                <div class='form-group col-md-6'>
                                        <label for="razon">Descripción Breve</label>
                                        <textarea class="form-control" rows="4" id="tx_descat5" name="tx_descat5"><?php echo $config['tx_descat5']; ?></textarea>
                                </div>
                            </div>
                            <div class='form-group col-md-12 permitir_6_cat' style="display: none;">
                                <div class='form-group col-md-6'>
                                    <div class='form-group col-md-12'>
                                        <label>Categoría a resaltar</label>
                                        <select id="co_cat6" name="co_cat6" class="selectpicker" data-live-search="true" title="Seleccione Categoria">
                                            <?php
                                                echo $opcion_6;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                    <label for="razon">Imagen de la categoría</label>
                                        <input class="tx_imgcat6" id="tx_imgcat6" name="tx_imgcat6" type="file" data-preview-file-type="any">
                                        <div id="erroralcargar" class="help-block"></div>
                                        <div id="status" class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                        <div id="img_prev" style="background-image: url('../../img/<?php echo $config['tx_imgcat6'].'?x=='.md5(time()); ?>');" alt="Imagen Banner 6"></div>
                                </div>
                                <div class='form-group col-md-6'>
                                        <label for="razon">Descripción Breve</label>
                                        <textarea class="form-control" rows="4" id="tx_descat6" name="tx_descat6"><?php echo $config['tx_descat6']; ?></textarea>
                                </div>
                            </div>
                            <!--FIN DE CONTENIDO DE CATEGORIAS RESALTANTES-->
                          <button type="submit" class="btn btn-default btn-block" id="btn_resalta_cat" name="btn_resalta_cat">Guardar</button>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$('#myTab a[href="#general"]').tab('show') // Select tab by name

  // store the currently selected tab in the hash value
  $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
	  var id = $(e.target).attr("href").substr(1);
	  window.location.hash = id;
	  window.scroll(0,0);
  });

  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  $('#myTab a[href="' + hash + '"]').tab('show');
  // Para recargar la pagina regrese al tope
	function Scrolldown() {
		 window.scroll(0,0); 
	}
	window.onload = Scrolldown;
	
$('.selectpicker').selectpicker({});
	
//imagen del logo de la tienda
$("#mylogo").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_logo.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$('#mylogo').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});

//Imagen de publicidad Superior
$("#imgpublicidad").fileinput({
language: "es",
	allowedFileExtensions: ["jpg", "png", "gif"],
    maxImageWidth: 1397,
    maxImageHeight: 150,
	showPreview: true,
	elErrorContainer: "#erroralcargar",
	uploadUrl: '../../funciones_ajax/subir_publicidad.php',
	allowedFileExtensions: ["jpg","png","gif","bmp"],
});
$('#imgpublicidad').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});

//Imagen de publicidad Superior 1
$("#imgpublicidad2").fileinput({
language: "es",
	allowedFileExtensions: ["jpg", "png", "gif"],
    maxImageWidth: 780,
    maxImageHeight: 100,
	showPreview: true,
	elErrorContainer: "#erroralcargar",
	uploadUrl: '../../funciones_ajax/subir_publicidad_superior.php?id=1',
	allowedFileExtensions: ["jpg","png","gif","bmp"],
});
$('#imgpublicidad2').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});

//Imagen de publicidad Superior 1
$("#imgpublicidad3").fileinput({
	language: "es",
	allowedFileExtensions: ["jpg", "png", "gif"],
    maxImageWidth: 780,
    maxImageHeight: 100,
	showPreview: true,
	elErrorContainer: "#erroralcargar",
	uploadUrl: '../../funciones_ajax/subir_publicidad_superior.php?id=2',
	allowedFileExtensions: ["jpg","png","gif","bmp"],
});
$('#tx_linkpublicidad3').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});

//Imagenes del baner 1
$(".banner1").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_banner1.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".banner2").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_banner2.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".banner3").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_banner3.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$('#banner1').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#banner2').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#banner3').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
//Imagenes de categorias resaltantes 1
$(".tx_imgcat1").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria1.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".tx_imgcat2").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria2.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".tx_imgcat3").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria3.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".tx_imgcat4").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria4.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".tx_imgcat5").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria5.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$(".tx_imgcat6").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria6.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$('#tx_imgcat1').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#tx_imgcat2').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#tx_imgcat3').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#tx_imgcat4').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#tx_imgcat5').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
$('#tx_imgcat6').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});
//Imagenes de categorias resaltantes 6
$("").fileinput({
maxFileSize: 2000,
layoutTemplates: {
					main1: "{preview}\n" +
					"<div class=\'input-group {class}\'>\n" +
					" <div class=\'input-group-btn\'>\n" +
					" {browse}\n" +
					" {upload}\n" +
					" {remove}\n" +
					" </div>\n" +
					" {caption}\n" +
					"</div>"
				},
showPreview: false,
uploadUrl: '../../funciones_ajax/subir_categoria6.php',
allowedFileExtensions: ["jpg","png","gif","bmp"],
elErrorContainer: "#erroralcargar",
uploadLabel: "Cargar",
browseLabel: "Buscar",
removeLabel: "Quitar",
msgInvalidFileExtension: 'Extencion invalida del archivo "{name}". Solo extenciones "{extensions}" son aceptados.',
mainClass: "input-group-md",
msgSizeTooLarge:'El archivo "{name}" ({size} KB) excede el límite permitido de carga de {maxSize} KB por archivo. Por favor reduzca el tamaño y vuelva a intentarlo',
msgLoading:'Cargando el archivo {index}',
msgFileNotFound: 'Archivo "{name}" no encontrado en la ubicación seleccionada',
elPreviewStatus:'#status'
// you can configure `msgErrorClass` and `msgInvalidFileExtension` as well
});
$('#tx_imgcat6').on('filebatchuploadcomplete', function(event, files, extra) {
    	//alert('hola');
		parent.window.location='../pages/index.php';
		console.log('File batch upload complete');
});

// MOSTRAR OPCIONES DEL CHECKBOX
$('input[name="in_publicidad"]').change(function(){
	if ( $(this).is(':checked') ) {
        $(".espacio_publicidad").show();
    } 
    else {
        $(".espacio_publicidad").hide();
    }
})

$('input[type="radio"]').click(function(){
	if($(this).attr("value")=="0"){
		$(".permitir_2_cat").hide();
		$(".permitir_4_cat").hide();
		$(".permitir_6_cat").hide();
	}
	if($(this).attr("value")=="2"){
		$(".permitir_2_cat").show();
		$(".permitir_4_cat").hide();
		$(".permitir_6_cat").hide();
	}
	if($(this).attr("value")=="4"){
		$(".permitir_2_cat").show();
		$(".permitir_4_cat").show();
		$(".permitir_6_cat").hide();
	}
	if($(this).attr("value")=="6"){
		$(".permitir_2_cat").show();
		$(".permitir_4_cat").show();
		$(".permitir_6_cat").show();
	}
});
// Full featured editor
$('#tx_contenidos').summernote({
codemirror: {
  theme: 'monokai'
},
  toolbar: [
	// [groupName, [list of button]]
	['style', ['bold', 'italic', 'underline', 'clear']],
	['fontsize', ['fontsize']],
	['color', ['color']],
	['para', ['ul', 'ol', 'paragraph']],
	['height', ['height']]
  ],
  height: 300,                 // set editor height

  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor

  focus: true,  
  lang: 'es-ES',               // set focus to editable area after initializing summernote
  onkeydown:function(e){
		var num = $('.summernote').code().replace(/(<([^>]+)>)/ig,"").length;
		var key = e.keyCode;
		allowed_keys = [8, 37, 38, 39, 40, 46]
		if($.inArray(key, allowed_keys) != -1)
			return true
		else if(num > 10){
			e.preventDefault();
			e.stopPropagation()
			}
		}
})
</script>
</body>
</html>