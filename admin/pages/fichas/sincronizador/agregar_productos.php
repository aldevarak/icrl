<?php 
include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM articulos WHERE campo1='S'";
$resultados_des = mysqli_query($link,$sql_des);
			
while ($producto = mysqli_fetch_array($resultados_des)) {
 
	//CATEGORIAS
	echo "//CATEGORIAS//CATEGORIAS//CATEGORIAS//CATEGORIAS//CATEGORIAS//CATEGORIAS//CATEGORIAS<br>";
	$result = mysqli_query($link,"SELECT * FROM categorias WHERE co_cat='".$producto['co_cat']."'");
	$cat_vieja = mysqli_fetch_array($result);
	
	$result = mysqli_query($link,"SELECT * FROM tg007_categoria WHERE nb_categoria='".$cat_vieja['cat_des']."'");
	$cat_new = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		echo "Categoria ".$cat_vieja['cat_des']." ya existe";
		$cod_cat=$cat_new['co_categoria'];
	}else{
		$sql3="INSERT INTO tg007_categoria (nb_categoria,in_estatus) VALUES ('".$cat_vieja['cat_des']."',1)";
		mysqli_query($link,$sql3);
		echo $sql3."<br><br>";
		
		//tomar valor de categoria a colocar al producto
		$sql2="SELECT MAX(co_categoria) AS id FROM tg007_categoria";
		$result = mysqli_query($link,"SELECT MAX(co_categoria) AS id FROM tg007_categoria");
		$cod = mysqli_fetch_array($result);
		$cod_cat=$cod['id'];
	}
	echo "<br><br><br><br>";
	
	//LINEAS
	echo "//LINEAS//LINEAS//LINEAS//LINEAS//LINEAS//LINEAS//LINEAS//LINEAS//LINEAS//LINEAS<br>";
	$result = mysqli_query($link,"SELECT * FROM lineas WHERE co_lin='".$producto['co_lin']."'");
	$lin_vieja = mysqli_fetch_array($result);
	
	$result = mysqli_query($link,"SELECT * FROM tg008_linea WHERE nb_linea='".$lin_vieja['lin_des']."'");
	$lin_new = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		echo "Linea ".$lin_vieja['lin_des']." ya existe";
		$cod_lin=$lin_new['co_linea'];
	}else{
		$sql3="INSERT INTO tg008_linea (co_categoria,nb_linea,in_estatus) VALUES (".$cod_cat.",'".$lin_vieja['lin_des']."',1)";
		mysqli_query($link,$sql3);
		echo $sql3."<br><br>";
		
		//tomar valor de categoria a colocar al producto
		$sql2="SELECT MAX(co_linea) AS id FROM tg008_linea";
		$result = mysqli_query($link,"SELECT MAX(co_linea) AS id FROM tg008_linea");
		$cod = mysqli_fetch_array($result);
		$cod_lin=$cod['id'];
	}
	echo "<br><br><br><br>";
	
	//SUB-LINEAS
	echo "//SUB-LINEAS//SUB-LINEAS//SUB-LINEAS//SUB-LINEAS//SUB-LINEAS//SUB-LINEAS//SUB-LINEAS<br>";
	$result = mysqli_query($link,"SELECT * FROM sublineas WHERE co_subl='".$producto['co_subl']."'");
	$Slin_vieja = mysqli_fetch_array($result);
	
	$result = mysqli_query($link,"SELECT * FROM tg009_sublineas WHERE nb_sublineas='".$Slin_vieja['subl_des']."'");
	$Slin_new = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		echo "SUB-Linea ".$Slin_vieja['subl_des']." ya existe";
		$cod_slin=$Slin_new['co_sublineas'];
	}else{
		$sql3="INSERT INTO tg009_sublineas (co_linea,nb_sublineas,in_estatus) VALUES (".$cod_lin.",'".$Slin_vieja['subl_des']."',1)";
		mysqli_query($link,$sql3);
		echo $sql3."<br><br>";
		
		//tomar valor de categoria a colocar al producto
		$sql2="SELECT MAX(co_sublineas) AS id FROM tg009_sublineas";
		$result = mysqli_query($link,"SELECT MAX(co_sublineas) AS id FROM tg009_sublineas");
		$cod = mysqli_fetch_array($result);
		$cod_slin=$cod['id'];
	}
	echo "<br><br><br><br>";
	
	
	//COLOR DIV 1
	echo "//COLOR DIV 1//COLOR DIV 1//COLOR DIV 1//COLOR DIV 1//COLOR DIV 1//COLOR DIV 1//COLOR DIV 1<br>";
	$result = mysqli_query($link,"SELECT * FROM colores WHERE co_col='".$producto['co_color']."'");
	$color_viejo = mysqli_fetch_array($result);
	echo "SELECT * FROM colores WHERE co_col='".$producto['co_color']."'<br>";
	
	$result = mysqli_query($link,"SELECT * FROM tg010_division WHERE nb_division='".$color_viejo['des_col']."'");
	$color_new = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		echo "color ".$color_viejo['des_col']." ya existe";
		$cod_div1=$color_new['co_division'];
	}else{
		$sql3="INSERT INTO tg010_division (co_sublineas,nb_division,in_estatus) VALUES (".$cod_lin.",'".$color_viejo['des_col']."',1)";
		mysqli_query($link,$sql3);
		echo $sql3."<br><br>";
		
		//tomar valor de categoria a colocar al producto
		$sql2="SELECT MAX(co_division) AS id FROM tg010_division";
		$result = mysqli_query($link,"SELECT MAX(co_division) AS id FROM tg010_division");
		$cod = mysqli_fetch_array($result);
		$cod_div1=$cod['id'];
	}
	echo "<br><br><br><br>";
	
	
	
	//DIV 2
	echo "//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2//DIV 2<br>";
	$result = mysqli_query($link,"SELECT * FROM tg011_division2 WHERE co_division='".$cod_div1."'");
	$div2 = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		echo "division2: ".$div2['nb_division2']." ya existe";
		$cod_div2=$div2['co_division2'];
	}else{
		$sql3="INSERT INTO tg011_division2 (co_division,nb_division2,in_estatus) VALUES (".$cod_div1.",'N/A',1)";
		mysqli_query($link,$sql3);
		echo $sql3."<br><br>";

		//tomar valor de categoria a colocar al producto
		$sql2="SELECT MAX(co_division2) AS id FROM tg011_division2";
		$result = mysqli_query($link,"SELECT MAX(co_division2) AS id FROM tg011_division2");
		$cod = mysqli_fetch_array($result);
		$cod_div2=$cod['id'];
	}
	echo "<br><br><br><br>";
	
	//DIV 3
	echo "//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3//DIV 3<br>";
	$result = mysqli_query($link,"SELECT * FROM tg012_division3 WHERE co_division2='".$cod_div2."'");
	$div3 = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		echo "division3: ".$div3['nb_division3']." ya existe";
		$cod_div3=$div3['co_division3'];
	}else{
		$sql3="INSERT INTO tg012_division3 (co_division2,nb_division3,in_estatus) VALUES (".$cod_div2.",'N/A',1)";
		mysqli_query($link,$sql3);
		echo $sql3."<br><br>";

		//tomar valor de categoria a colocar al producto
		$sql2="SELECT MAX(co_division3) AS id FROM tg012_division3";
		$result = mysqli_query($link,"SELECT MAX(co_division3) AS id FROM tg012_division3");
		$cod = mysqli_fetch_array($result);
		$cod_div3=$cod['id'];
	}
	echo "<br><br><br><br>";
	
	//PRODUCTOS
	echo "//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS//PRODUCTOS<br>";
	
	$nombre_art = str_replace('(', ' ', $producto['art_des']);
	echo "La cadena resultante es: " . $nombre_art;
	
	$nombre_art = str_replace(')', ' ', $nombre_art);
	echo "La cadena resultante es: " . $nombre_art;
	
	$result = mysqli_query($link,"SELECT * FROM tg013_productos WHERE nb_productos='".$nombre_art."'");
	$pro = mysqli_fetch_array($result);
			
	if (mysqli_num_rows($result)>0) {
		$cod_pro=$pro['co_productos'];
		echo "Producto: ".$pro['nb_productos']." ya existe";
		
		$sql4="UPDATE tg013_productos SET co_categoria='".$cod_cat."',co_linea='".$cod_lin."',co_sublineas='".$cod_slin."',co_division='".$cod_div1."',co_division2='".$cod_div2."',co_division3='".$cod_div3."',nb_productos='".$nombre_art."',nu_stock='".$producto['stock_act']."',nu_precio1='".$producto['prec_vta1']."',nu_precio2='".$producto['prec_vta2']."',nu_precio3='".$producto['prec_vta3']."',nu_precio4='".$producto['prec_vta4']."',nu_precio5='".$producto['prec_vta5']."' WHERE co_productos='".$pro['co_productos']."'";
		mysqli_query($link,$sql4);
		echo $sql4."<br><br>";
	}else{
		$sql5="INSERT INTO tg013_productos (co_categoria,co_linea,co_sublineas,co_division,co_division2,co_division3,nb_productos,tx_descripcion,tx_descripcion_web,nu_stock,nu_precio1,nu_precio2,nu_precio3,nu_precio4,nu_precio5,fe_ini_p5,fe_fin_p5,nu_hits,in_destacado,in_oferta,in_bloqueado,in_excento,in_estatus) VALUES (".$cod_cat.",".$cod_lin.",".$cod_slin.",".$cod_div1.",".$cod_div2.",".$cod_div3.",'".$nombre_art."',NULL,NULL,'".$producto['stock_act']."','".$producto['prec_vta1']."','".$producto['prec_vta2']."','".$producto['prec_vta3']."','".$producto['prec_vta4']."','".$producto['prec_vta5']."',NULL,NULL,0,0,0,0,0,1)";
		mysqli_query($link,$sql5);
		echo $sql5."<br>";	
	}
	
	
	
	
}
?>