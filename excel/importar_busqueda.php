<!DOCTYPE html>
<html>
<head>
	<title>Leer Archivo Excel usando PHP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h2>Ejemplo: Leer Archivos Excel con PHP</h2>	
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Resultados de archivo de Excel.</h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-12">
            
<?php
include "../inic/dbcon.php";
require_once 'Classes/PHPExcel.php';
$archivo = "a_importar_busqueda.xlsx";
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();?>

<table class="table table-bordered">
      <thead>
        <tr>
		  <th>#</th>
          <th>marca</th>
          <th>modelo</th>
          <th>años</th>
		  <th>posicion</th>
          <th>Observacion</th>

        </tr>
      </thead>
      <tbody>
<?php
$num=0;
for ($row = 2; $row <= $highestRow; $row++){ $num++;?>
       <tr>
          <th scope='row'><?php echo $num;?></th>
          <td><?php echo $a=$sheet->getCell("A".$row)->getValue();echo $a;?></td>
          <td><?php echo $b=$sheet->getCell("B".$row)->getValue();echo $b;?></td>
          <td><?php echo $c=$sheet->getCell("C".$row)->getValue();echo $c;?></td>
          <td><?php echo $d=$sheet->getCell("D".$row)->getValue();echo $d;?></td>
		  <td><?php echo $e=$sheet->getCell("E".$row)->getValue();echo $e;?></td>
          <td><?php echo $f=$sheet->getCell("F".$row)->getValue();echo $f;?></td>
        </tr>
    	
	<?php
	/*MARCA*//*MARCA*//*MARCA*//*MARCA*//*MARCA*//*MARCA*//*MARCA*//*MARCA*//*MARCA*//*MARCA*/
	$result_marca = mysqli_query($link,"SELECT * FROM tg015_marca WHERE nb_marca='".$a."'");
	$marca = mysqli_fetch_array($result_marca);
	
	if (mysqli_num_rows($result_marca)>0) {
		$cod_marca=$marca['co_marca'];
		
	}else{
		
		$sql1="INSERT INTO tg015_marca (nb_marca,in_estatus) VALUES ('".$a."',1)";
		//echo $sql1."<br>";
		mysqli_query($link,$sql1);
		
		$result_marca = mysqli_query($link,"SELECT * FROM tg015_marca WHERE nb_marca='".$a."'");
		$a_marca = mysqli_fetch_array($result_marca);
		$cod_marca =$a_marca['co_marca'];
	}
	
	/*MODELO*//*MODELO*//*MODELO*//*MODELO*//*MODELO*//*MODELO*//*MODELO*//*MODELO*//*MODELO*/
	$result_modelo = mysqli_query($link,"SELECT * FROM tg016_modelo WHERE nb_modelo='".$b."'");
	$modelo = mysqli_fetch_array($result_modelo);
	
	if (mysqli_num_rows($result_modelo)>0) {
		$cod_modelo=$modelo['co_modelo'];
	}else{
		
		$sql12="INSERT INTO tg016_modelo (co_marca,nb_modelo,in_estatus) VALUES ('".$cod_marca."','".$b."',1)";
		//echo $sql12."<br>";
		mysqli_query($link,$sql12);
		
		$result_modelo = mysqli_query($link,"SELECT * FROM tg016_modelo WHERE nb_modelo='".$b."' AND co_marca='".$cod_marca."'");
		$a_modelo = mysqli_fetch_array($result_modelo);
		$cod_modelo =$a_modelo['co_modelo'];
	}
	
	/*AÑO*//*AÑO*//*AÑO*//*AÑO*//*AÑO*//*AÑO*//*AÑO*//*AÑO*//*AÑO*//*AÑO*/
	$sql121="INSERT INTO tg017_ano (co_modelo,nu_ano,in_estatus) VALUES ('".$cod_modelo."','".$c."',1)";
	//echo $sql121."<br>";
	mysqli_query($link,$sql121);
	
	$result_ano = mysqli_query($link,"SELECT * FROM tg017_ano WHERE nu_ano='".$c."' AND co_modelo='".$cod_modelo."'");
	$a_ano = mysqli_fetch_array($result_ano);
	$cod_ano =$a_ano['co_ano'];
	
	/*POSICION*//*POSICION*//*POSICION*//*POSICION*//*POSICION*//*POSICION*//*POSICION*/
	$sql1212="INSERT INTO tg018_tp_pastilla (co_ano,nb_tp_pastilla,in_estatus) VALUES ('".$cod_ano."','".$d."',1)";
	//echo $sql1212."<br>";
	mysqli_query($link,$sql1212);
	
	$result_pos = mysqli_query($link,"SELECT * FROM tg018_tp_pastilla WHERE nb_tp_pastilla='".$d."' AND co_ano='".$cod_ano."'");
	$a_pos = mysqli_fetch_array($result_pos);
	$cod_pos =$a_pos['co_tp_pastilla'];
	
	/*PRODUCTO*//*PRODUCTO*//*PRODUCTO*//*PRODUCTO*//*PRODUCTO*/ 
	$porcion = explode("=", $e);
	
	foreach ($porcion as &$valor) {
		
		$result_val = mysqli_query($link,"SELECT * FROM tg008_linea WHERE nb_linea='".$valor."'");
		$r_val = mysqli_fetch_array($result_val);
			
		if (mysqli_num_rows($result_val)>0) {
				$result_linea = mysqli_query($link,"SELECT * FROM tg008_linea WHERE nb_linea='".$valor."'");
				$a_linea = mysqli_fetch_array($result_linea);
				$cod_linea =$a_linea['co_linea'];
				
				$result_producto = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_linea='".$cod_linea."'");
				$a_producto = mysqli_fetch_array($result_producto);
				$cod_producto =$a_producto['co_productos'];
				
				$sql14="INSERT INTO tr004_busqueda (co_marca,co_modelo,co_ano,co_tp_pastilla,co_productos,tx_observacion,in_estatus) VALUES ('".$cod_marca."','".$cod_modelo."','".$cod_ano."','".$cod_pos."','".$cod_producto."','".$f."',1)";
				mysqli_query($link,$sql14);
				echo $sql14."<br>";
		}else{
			echo "<br>No existe la linea: ".$valor."<br><br>";
		}
	}

}
?>
          </tbody>
    </table>
  </div>	
 </div>	
</div>
</body>
</html>
