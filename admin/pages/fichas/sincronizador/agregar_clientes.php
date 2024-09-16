<?php 
//include ("../../../../inic/dbcon.php");

$sql_des="SELECT * FROM prueba_clientes WHERE inactivo='0'";
$resultados_des = mysqli_query($link,$sql_des);
//echo $sql_des;
$id=0;
			
while ($cliente = mysqli_fetch_array($resultados_des)) {
 
	$id = $id+1;

	$sql="INSERT INTO th001_usuario (co_nivel_usuario,nb_usuario,tx_clave,in_mconf,in_mcliente,in_mpedido,in_mvendedor,in_mclasifica,in_mbanca,in_transporte,in_estatus) VALUES (2,'cliente".$id."','202cb962ac59075b964b07152d234b70',0,0,0,0,0,0,0,1)";
	mysqli_query($link,$sql);

	$sql2="SELECT MAX(co_usuario) AS id FROM th001_usuario";
	$result = mysqli_query($link,"SELECT MAX(co_usuario) AS id FROM th001_usuario");
	$cod = mysqli_fetch_array($result);
	
	$sql3="INSERT INTO tg005_clientes (co_tpcliente,co_usuario,nb_clientes,nu_rif_cedula,nu_telefono,fe_registro,fe_ultima_session,tx_direccion_fiscal,tx_direccion_entrega,in_activa,in_estatus) VALUES (2,".$cod['id'].",'".$cliente['cli_des']."','".$cliente['rif']."','".$cliente['telefonos']."','2019-09-18',NULL,'".$cliente['direc1']."','".$cliente['dir_ent2']."',1,1)";
	mysqli_query($link,$sql3);
}
?>