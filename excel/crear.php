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
?>

<table class="table table-bordered">
      <thead>
        <tr>
		  <th>#</th>
          <th>SQL</th>
        </tr>
      </thead>
      <tbody>
<?php
/* $num=0;
	for ($i = 1; $i <= 270; $i++) {
	
		
		$sql="INSERT INTO tg011_division2 (co_division,nb_division2,in_eliminar,in_estatus) VALUES ('".$i."','32',0,1),('".$i."','34',0,1),('".$i."','36',0,1),('".$i."','38',0,1),('".$i."','40',0,1),('".$i."','42',0,1),('".$i."','44',0,1);";
		//echo $sql1212."<br>";
		mysqli_query($link,$sql);
		$estructura.="<tr><th>".$i."</th><th>".$sql."</th></tr>";
	}
	echo $estructura; */
?>

<?php
$num=0;
	for ($i = 1; $i <= 1890; $i++) {

		$sql="INSERT INTO tg012_division3 (co_division2,nb_division3,in_eliminar,in_estatus) VALUES ('".$i."','N/A',0,1);";
		//echo $sql1212."<br>";
		mysqli_query($link,$sql);
		$estructura.="<tr><th>".$i."</th><th>".$sql."</th></tr>";
	}
	echo $estructura;
?>


          </tbody>
    </table>
  </div>	
 </div>	
</div>
</body>
</html>
