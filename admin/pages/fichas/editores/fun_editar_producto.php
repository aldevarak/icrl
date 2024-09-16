<?php 
include ("../../../../inic/dbcon.php");
//include ("../../../../inic/session.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

if ($_POST['in_excento']=="on"){
	$in_excento=1;
}else{
	$in_excento=0;
}
	
	$sql="UPDATE tg013_productos SET co_categoria='".$_POST['co_categoria']."',co_linea='".$_POST['co_linea']."',co_sublineas='".$_POST['co_sublineas']."',co_division='".$_POST['co_division']."',co_division2='".$_POST['co_division2']."',co_division3='".$_POST['co_division3']."',nb_productos='".$_POST['nb_productos']."',tx_descripcion='".$_POST['tx_descripcion']."',nu_stock='".$_POST['nu_stock']."',nu_precio1='".$_POST['nu_precio1']."',nu_precio2='".$_POST['nu_precio2']."',nu_precio3='".$_POST['nu_precio3']."',nu_precio4='".$_POST['nu_precio4']."',nu_precio5='".$_POST['nu_precio5']."',in_excento='".$in_excento."' WHERE co_productos='".$id."'";
	mysqli_query($link,$sql);
?>