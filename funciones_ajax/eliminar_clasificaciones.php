<?php 
require_once ("../inic/dbcon.php");

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

if (isset($_POST['opc'])){ $opc = $_POST['opc'];}
if (isset($_GET['opc'])){ $opc = $_GET['opc'];}

//CATEGORIA
if ($opc == 'cat'){
	//Productos
	$sql="UPDATE tg013_productos SET in_estatus='0' WHERE co_categoria='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	//Categorias
	$sql="UPDATE tg007_categoria SET in_eliminar='0' WHERE co_categoria='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	//Lineas
	$sql1="SELECT * FROM tg008_linea WHERE co_categoria='".$id."'";
	$res2=mysqli_query($link,$sql1);
				
	while ($row_lin = mysqli_fetch_array($res2)) {
		$sql2="UPDATE tg008_linea SET in_eliminar='0' WHERE co_linea='".$row_lin['co_linea']."'";
		mysqli_query($link,$sql2);
		//echo $sql2;
		
		//Sublineas
		
		$sql3="SELECT * FROM tg009_sublineas WHERE co_linea='".$row_lin['co_linea']."'";
		$res3=mysqli_query($link,$sql3);

		while ($row_slin = mysqli_fetch_array($res3)) {
			$sql4="UPDATE tg009_sublineas SET in_eliminar='0' WHERE co_sublineas='".$row_slin['co_sublineas']."'";
			mysqli_query($link,$sql4);
			//echo $sql;
			
			
			//division1
			$sql5="SELECT * FROM tg010_division WHERE co_sublineas='".$row_slin['co_sublineas']."'";
			$res5=mysqli_query($link,$sql5);

			while ($row_div = mysqli_fetch_array($res5)) {
				$sql6="UPDATE tg010_division SET in_eliminar='0' WHERE co_division='".$row_div['co_division']."'";
				mysqli_query($link,$sql6);
				//echo $sql;
				
				//division2
				$sql7="SELECT * FROM tg011_division2 WHERE co_division='".$row_div['co_division']."'";
				$res7=mysqli_query($link,$sql7);

				while ($row_div2 = mysqli_fetch_array($res7)) {
					$sql8="UPDATE tg011_division2 SET in_eliminar='0' WHERE co_division2='".$row_div2['co_division2']."'";
					mysqli_query($link,$sql8);
					//echo $sql;
				
					//division3
					$sql9="SELECT * FROM tg012_division3 WHERE  co_division2='".$row_div2['co_division2']."'";
					$res=mysqli_query($link,$sql9);

					while ($row_div3 = mysqli_fetch_array($res)) {
						$sql10="UPDATE tg012_division3 SET in_eliminar='0' WHERE co_division3='".$row_div3['co_division3']."'";
						mysqli_query($link,$sql10);
						//echo $sql;
					
					}
				}
			}
			
		}
	}
}

//LINEA
if ($opc == 'lin'){
	//Productos
	$sql="UPDATE tg013_productos SET in_estatus='0' WHERE co_linea='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	$sql="UPDATE tg008_linea SET in_eliminar='0' WHERE co_linea='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	//Lineas
	$sql1="SELECT * FROM tg008_linea WHERE co_linea='".$id."'";
	$res2=mysqli_query($link,$sql1);
				
	while ($row_lin = mysqli_fetch_array($res2)) {
		$sql2="UPDATE tg008_linea SET in_eliminar='0' WHERE co_linea='".$row_lin['co_linea']."'";
		mysqli_query($link,$sql2);
		//echo $sql2;
		
		//Sublineas
		
		$sql3="SELECT * FROM tg009_sublineas WHERE co_linea='".$row_lin['co_linea']."'";
		$res3=mysqli_query($link,$sql3);

		while ($row_slin = mysqli_fetch_array($res3)) {
			$sql4="UPDATE tg009_sublineas SET in_eliminar='0' WHERE co_sublineas='".$row_slin['co_sublineas']."'";
			mysqli_query($link,$sql4);
			//echo $sql;
			
			
			//division1
			$sql5="SELECT * FROM tg010_division WHERE co_sublineas='".$row_slin['co_sublineas']."'";
			$res5=mysqli_query($link,$sql5);

			while ($row_div = mysqli_fetch_array($res5)) {
				$sql6="UPDATE tg010_division SET in_eliminar='0' WHERE co_division='".$row_div['co_division']."'";
				mysqli_query($link,$sql6);
				//echo $sql;
				
				//division2
				$sql7="SELECT * FROM tg011_division2 WHERE co_division='".$row_div['co_division']."'";
				$res7=mysqli_query($link,$sql7);

				while ($row_div2 = mysqli_fetch_array($res7)) {
					$sql8="UPDATE tg011_division2 SET in_eliminar='0' WHERE co_division2='".$row_div2['co_division2']."'";
					mysqli_query($link,$sql8);
					//echo $sql;
				
					//division3
					$sql9="SELECT * FROM tg012_division3 WHERE  co_division2='".$row_div2['co_division2']."'";
					$res=mysqli_query($link,$sql9);

					while ($row_div3 = mysqli_fetch_array($res)) {
						$sql10="UPDATE tg012_division3 SET in_eliminar='0' WHERE co_division3='".$row_div3['co_division3']."'";
						mysqli_query($link,$sql10);
						//echo $sql;
					
					}
				}
			}
			
		}
	}
	
}

//SUBLINEA
if ($opc == 'slin'){
	//Productos
	$sql="UPDATE tg013_productos SET in_estatus='0' WHERE co_sublineas='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	$sql="UPDATE tg009_sublineas SET in_eliminar='0' WHERE co_sublineas='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	//division1
	$sql5="SELECT * FROM tg010_division WHERE co_sublineas='".$id."'";
	$res5=mysqli_query($link,$sql5);

	while ($row_div = mysqli_fetch_array($res5)) {
		$sql6="UPDATE tg010_division SET in_eliminar='0' WHERE co_division='".$row_div['co_division']."'";
		mysqli_query($link,$sql6);
		//echo $sql;

		//division2
		$sql7="SELECT * FROM tg011_division2 WHERE co_division='".$row_div['co_division']."'";
		$res7=mysqli_query($link,$sql7);

		while ($row_div2 = mysqli_fetch_array($res7)) {
			$sql8="UPDATE tg011_division2 SET in_eliminar='0' WHERE co_division2='".$row_div2['co_division2']."'";
			mysqli_query($link,$sql8);
			//echo $sql;

			//division3
			$sql9="SELECT * FROM tg012_division3 WHERE  co_division2='".$row_div2['co_division2']."'";
			$res=mysqli_query($link,$sql9);

			while ($row_div3 = mysqli_fetch_array($res)) {
				$sql10="UPDATE tg012_division3 SET in_eliminar='0' WHERE co_division3='".$row_div3['co_division3']."'";
				mysqli_query($link,$sql10);
				//echo $sql;

			}
		}
	}
}

//DIVISION
if ($opc == 'div'){
	//Productos
	$sql="UPDATE tg013_productos SET in_estatus='0' WHERE co_division='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	$sql="UPDATE tg010_division SET in_eliminar='0' WHERE co_division='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	//division2
	$sql7="SELECT * FROM tg011_division2 WHERE co_division='".$id."'";
	$res7=mysqli_query($link,$sql7);

	while ($row_div2 = mysqli_fetch_array($res7)) {
		$sql8="UPDATE tg011_division2 SET in_eliminar='0' WHERE co_division2='".$row_div2['co_division2']."'";
		mysqli_query($link,$sql8);
		//echo $sql;

		//division3
		$sql9="SELECT * FROM tg012_division3 WHERE  co_division2='".$row_div2['co_division2']."'";
		$res=mysqli_query($link,$sql9);

		while ($row_div3 = mysqli_fetch_array($res)) {
			$sql10="UPDATE tg012_division3 SET in_eliminar='0' WHERE co_division3='".$row_div3['co_division3']."'";
			mysqli_query($link,$sql10);
			//echo $sql;

		}
	}
}

//DIVISION2
if ($opc == 'div2'){
	//Productos
	$sql="UPDATE tg013_productos SET in_estatus='0' WHERE co_division2='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	$sql="UPDATE tg011_division2 SET in_eliminar='0' WHERE co_division2='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	//division3
	$sql9="SELECT * FROM tg012_division3 WHERE co_division2='".$id."'";
	$res=mysqli_query($link,$sql9);

	while ($row_div3 = mysqli_fetch_array($res)) {
		$sql10="UPDATE tg012_division3 SET in_eliminar='0' WHERE co_division3='".$row_div3['co_division3']."'";
		mysqli_query($link,$sql10);
		//echo $sql;

	}
}

//DIVISION3
if ($opc == 'div3'){
	//Productos
	$sql="UPDATE tg013_productos SET in_estatus='0' WHERE co_division3='".$id."'";
	mysqli_query($link,$sql);
	//echo $sql;
	
	$sql="UPDATE tg012_division3 SET in_eliminar='0' WHERE co_division3='".$id."'";
	mysqli_query($link,$sql);
}
?>

																																																																																					