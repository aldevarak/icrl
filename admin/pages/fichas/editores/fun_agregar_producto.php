<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");


	if ($_POST['in_excento']=="on"){
		$in_excento=1;
	}else{
		$in_excento=0;
	}

	/*//agregar division 2 automatica
	$sql38="INSERT INTO tg011_division2 (co_division,nb_division2,in_eliminar,in_estatus) VALUES (".$_POST['co_division'].",'N/A',1,1)";
	mysqli_query($link,$sql38);

	$result_div2 = mysqli_query($link,"SELECT * FROM tg011_division2 WHERE co_division='".$_POST['co_division']."'");
	$cod_div2 = mysqli_fetch_array($result_div2);

	//agregar division 3 automatica
	$sql39="INSERT INTO tg012_division3 (co_division2,nb_division3,in_eliminar,in_estatus) VALUES (".$_POST['co_division2'].",'N/A',1,1)";
	mysqli_query($link,$sql39);

	$result_div3 = mysqli_query($link,"SELECT * FROM tg012_division3 WHERE co_division2='".$cod_div2['co_division2']."'");
	$cod_div3 = mysqli_fetch_array($result_div3);*/

	$result_div2 = mysqli_query($link,"SELECT * FROM tg011_division2 WHERE co_division='".$_POST['co_division']."'");
	$cod_div2 = mysqli_fetch_array($result_div2);

	$result_div3 = mysqli_query($link,"SELECT * FROM tg012_division3 WHERE co_division2='".$cod_div2['co_division2']."'");
	$cod_div3 = mysqli_fetch_array($result_div3);


	//insertar producto
	$sql3="INSERT INTO tg013_productos (co_categoria,co_linea,co_sublineas,co_division,co_division2,co_division3,nb_productos,tx_descripcion,tx_descripcion_web,nu_stock,nu_precio1,nu_precio2,nu_precio3,nu_precio4,nu_precio5,fe_ini_p5,fe_fin_p5,nu_hits,in_destacado,in_oferta,in_bloqueado,in_excento,in_estatus) VALUES (".$_POST['co_categoria'].",".$_POST['co_linea'].",".$_POST['co_sublineas'].",".$_POST['co_division'].",".$cod_div2['co_division2'].",".$cod_div3['co_division3'].",'".$_POST['nb_productos']."','".$_POST['tx_descripcion']."',NULL,'".$_POST['nu_stock']."','".$_POST['nu_precio1']."','".$_POST['nu_precio2']."','".$_POST['nu_precio3']."','".$_POST['nu_precio4']."','".$_POST['nu_precio5']."',NULL,NULL,0,0,0,0,".$in_excento.",1)";
	mysqli_query($link,$sql3);
	
	//echo $sql3;
	echo "<script type='text/javascript' charset='utf-8'>console.log('".$sql3."')</script>";


?>