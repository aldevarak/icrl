<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id;

/*echo "<script>alert('hola');</script>";*/

//CONSTRUIR COMBO DE SUB-LINEAS

	$sql10="SELECT * FROM tg010_division WHERE co_division='".$id."' AND in_estatus='1' AND in_eliminar='1' ORDER BY nb_division";
	$result10 = mysqli_query($link,$sql10);//para categoria 1
	
	while ($row10 = mysqli_fetch_array($result10)) {
		$opcion_div.= '<option value="'.$row10['co_division'].'" ';
		if ($cod['co_division']==$row10['co_division']){ $opcion_div.= 'selected';}
			$opcion_div.= ' >'.$row10['nb_division'].'</option>';	
	}
	
	$combo.="<label>Nombre de División</label>
				<select class='selectpicker' data-live-search='true' id='co_division' name='co_division' onchange=\"load4(this.value);\">
                  <option value='0'>..Seleccione..</option>
				  ".$opcion_div."";

	$combo.="</select>";
	
	echo $combo;
?>

																																																																																					