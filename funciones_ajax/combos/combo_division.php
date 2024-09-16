<?php 
@session_start();
require_once ("../../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
	
$options="";

$sql="SELECT * FROM tg010_division WHERE in_estatus='1' AND co_sublineas='".$id."' AND in_eliminar='1' ORDER BY nb_division";
$result = mysqli_query($link,$sql);//para lineas

$options.= '<option value=""></option>';

while ($row = mysqli_fetch_array($result)) {
	$options.= '<option value="'.$row['co_division'].'">'.$row['nb_division'].'</option>';	
}

echo $options;   
?>