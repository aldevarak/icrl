<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id;

/*echo "<script>alert('hola');</script>";*/

//CONSTRUIR COMBO DE LINEAS

	$sql10="SELECT * FROM tg008_linea WHERE co_categoria='".$id."' AND in_estatus='1' AND in_eliminar='1' ORDER BY nb_linea";
	$result10 = mysqli_query($link,$sql10);//para categoria 1
	
	while ($row10 = mysqli_fetch_array($result10)) {
		$opcion_lin.= '<option value="'.$row10['co_linea'].'" ';
		if ($cod['co_linea']==$row10['co_linea']){ $opcion_lin.= 'selected';}
			$opcion_lin.= ' >'.$row10['nb_linea'].'</option>';	
	}
	
	$combo.="<label>Nombre de Linea</label>
				<select class='selectpicker' data-live-search='true' id='co_linea' name='co_linea' onchange=\"load2(this.value);\">
                  <option value='0'>..Seleccione..</option>
				  ".$opcion_lin."";

	$combo.="</select>";
	
	echo $combo;
?>

																																																																																					