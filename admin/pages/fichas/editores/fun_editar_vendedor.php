<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$result = mysqli_query($link,"SELECT ven.* FROM tg002_vendedor AS ven INNER JOIN th001_usuario AS usu ON ven.co_usuario=usu.co_usuario WHERE co_vendedor='".$id."'");
$cod = mysqli_fetch_array($result);	

if (isset($_POST['btn_enviar'])){
	$sql="UPDATE tg002_vendedor SET nb_vendedor='".$_POST['nb_vendedor']."',nu_cedula='".$_POST['nu_cedula']."',nu_telefono='".$_POST['nu_telefono']."',nu_comision='".$_POST['nu_comision']."' WHERE co_vendedor='".$id."'";
	mysqli_query($link,$sql);
	
	if($_POST['tx_clave']!=""){
		$tx_clave=$_POST['tx_clave'];
		$clave = md5($tx_clave);
		$sql4="UPDATE th001_usuario SET tx_clave='".$clave."' WHERE co_usuario='".$cod['co_usuario']."'";
		mysqli_query($link,$sql4);
	}
			
	//echo $sql;
	echo "<script type='text/javascript' charset='utf-8'>parent.$('#modal_editar_iframe').modal('hide');parent.parent.parent.cambio('fichas/vendedores.php','cont');</script>";	
}

?>