<?php 
@session_start();
require_once ("../../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
	
$options="";

$sql="SELECT * FROM tg016_modelo WHERE in_estatus='1' AND co_marca='".$id."' AND in_estatus='1' ORDER BY nb_modelo";
$result = mysqli_query($link,$sql);//para lineas

$options.= '<option value=""></option>';

while ($row = mysqli_fetch_array($result)) {
	$options.= '<option value="'.$row['co_modelo'].'">'.$row['nb_modelo'].'</option>';	
}

echo $options;   
?>