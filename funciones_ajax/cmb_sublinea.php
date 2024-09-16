<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

//echo $id;

/*echo "<script>alert('hola');</script>";*/

//CONSTRUIR COMBO DE SUB-LINEAS

	$sql10="SELECT * FROM tg009_sublineas WHERE co_linea='".$id."' AND in_estatus='1' AND in_eliminar='1' ORDER BY nb_sublineas";
	$result10 = mysqli_query($link,$sql10);//para categoria 1
	
	while ($row10 = mysqli_fetch_array($result10)) {
		$opcion_slin.= '<option value="'.$row10['co_sublineas'].'" ';
		if ($cod['co_sublineas']==$row10['co_sublineas']){ $opcion_slin.= 'selected';}
			$opcion_slin.= ' >'.$row10['nb_sublineas'].'</option>';	
	}
	
	$combo.="<label>Nombre de Sub-Linea</label>
				<select class='selectpicker' data-live-search='true' id='co_sublineas' name='co_sublineas' onchange=\"load3(this.value);\">
                  <option value='0'>..Seleccione..</option>
				  ".$opcion_slin."";

	$combo.="</select>";
	
	echo $combo;
?>

																																																																																					