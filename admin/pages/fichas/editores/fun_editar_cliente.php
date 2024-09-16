<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

	$sql="UPDATE tg005_clientes SET nb_clientes='".$_POST['nb_clientes']."',nu_rif_cedula='".$_POST['nu_rif_cedula']."',nu_telefono='".$_POST['nu_telefono']."',tx_direccion_fiscal='".$_POST['tx_direccion_fiscal']."',tx_direccion_entrega='".$_POST['tx_direccion_entrega']."',co_tpcliente='".$_POST['co_tpcliente']."' WHERE co_clientes='".$id."'";
	mysqli_query($link,$sql);
	
	if($_POST['tx_clave']!=""){
		$tx_clave=$_POST['tx_clave'];
		$clave = md5($tx_clave);
		$sql4="UPDATE th001_usuario SET tx_clave='".$clave."' WHERE co_usuario='".$cod['co_usuario']."'";
		mysqli_query($link,$sql4);
	}
?>