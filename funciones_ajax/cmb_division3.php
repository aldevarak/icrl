<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id;

/*echo "<script>alert('hola');</script>";*/

//CONSTRUIR COMBO DE SUB-LINEAS

	$sql10="SELECT * FROM tg012_division3 WHERE co_division3='".$id."' AND in_estatus='1' AND in_eliminar='1' ORDER BY nb_division3";
	$result10 = mysqli_query($link,$sql10);//para categoria 1
	
	while ($row10 = mysqli_fetch_array($result10)) {
		$opcion_div.= '<option value="'.$row10['co_division3'].'" ';
		if ($cod['co_division3']==$row10['co_division3']){ $opcion_div.= 'selected';}
			$opcion_div.= ' >'.$row10['nb_division3'].'</option>';	
	}
	
	$combo.="<label>Nombre de División</label>
				<select class='selectpicker' data-live-search='true' id='co_division3' name='co_division3'>
                  <option value='0'>..Seleccione..</option>
				  ".$opcion_div."";

	$combo.="</select>";
	
	echo $combo;
?>

																																																																																					