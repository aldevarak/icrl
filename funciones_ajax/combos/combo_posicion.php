<?php 
@session_start();
require_once ("../../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}
	
$options="";

$sql="SELECT * FROM tg018_tp_pastilla WHERE in_estatus='1' AND co_ano='".$id."' AND in_estatus='1' ORDER BY nb_tp_pastilla";
$result = mysqli_query($link,$sql);//para lineas

$options.= '<option value=""></option>';

while ($row = mysqli_fetch_array($result)) {
	$options.= '<option value="'.$row['co_tp_pastilla'].'">'.$row['nb_tp_pastilla'].'</option>';	
}

echo $options;   
?>