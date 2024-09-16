<?php 
@session_start();
include ("../../../inic/dbcon.php");

$mes=date('m');
//echo $mes;
$ano=date('Y');
//echo $ano;

//PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO
if($mes==02){
	$dia_inicio="01";
	$dia_fin="28";
}
if(($mes==01)||($mes==03)||($mes==05)||($mes==07)||($mes==08)||($mes==10)||($mes==12)){
	$dia_inicio="01";
	$dia_fin="31";
}
if(($mes==04)||($mes==06)||($mes==09)||($mes==11)){
	$dia_inicio="01";
	$dia_fin="30";
}

switch($mes){
case "01":
  $mes_letra="Enero";
  $mes_rest=1;
  break;
case "02":
  $mes_letra="Febrero";
  $mes_rest=2;
  break;
case "03":
  $mes_letra="Marzo";
  $mes_rest=3;
  break;
case "04":
  $mes_letra="Abril";
  $mes_rest=4;
  break;
case "05":
  $mes_letra="Mayo";
  $mes_rest=5;
  break;
case "06":
  $mes_letra="Junio";
  $mes_rest=6;
  break;
case "07":
  $mes_letra="Julio";
  $mes_rest=7;
  break;
case "08":
  $mes_letra="Agosto";
  $mes_rest=8;
  break;
case "09":
  $mes_letra="Septiembre";
  $mes_rest=9;
  break;
case "10":
  $mes_letra="Octubre";
  $mes_rest=10;
  break;
case "11":
  $mes_letra="Noviembre";
  $mes_rest=11;
  break;
case "12":
  $mes_letra="Diciembre";
  $mes_rest=12;
  break;  
}

$fecha_Inicio=$ano."-".$mes."-".$dia_inicio;
$fecha_fin=$ano."-".$mes."-".$dia_fin;

$pro=0;
$num=0;
$sql_div="SELECT * FROM (tr002_reng_pedidos AS rengped INNER JOIN tr001_pedidos AS ped ON rengped.co_pedidos=ped.co_pedidos) WHERE ped.fe_fecha BETWEEN '".$fecha_Inicio."' AND '".$fecha_fin."' ORDER BY rengped.co_productos";
$res=mysqli_query($link,$sql_div);
//echo $sql_div."<br>";

while ($row = mysqli_fetch_array($res)) {
	
	if($pro==$row['co_productos']){
		//echo "igual"."<br>";
		
		$cantidad=$cantidad+$row['nu_cantidad'];
		
		$arr[$registros]['numero'] = $registros;
		$arr[$registros]['cantidad'] = $cantidad;
		$arr[$registros]['co_productos'] = $row['co_productos'];
	}else{
		//echo "diferente"."<br>";
		$cantidad=0;
		$registros=$registros+1;
		
		$cantidad=$cantidad+$row['nu_cantidad'];
		$arr[$registros]['numero'] = $registros;
		$arr[$registros]['cantidad'] = $cantidad;
		$arr[$registros]['co_productos'] = $row['co_productos'];
			
	}
	$pro=$row['co_productos'];
	
	/*echo "numero: ".$arr[$registros]['numero']."<br>";
	echo "codigo: ".$arr[$registros]['co_productos']."<br>";
	echo "cantidad: ".$arr[$registros]['cantidad']."<br><br>";*/
}

//echo "longitud: ".$registros."<br>";

for ($i = 1; $i <= $registros; $i++) { 
	for ($j = $i+1; $j <= $registros; $j++) { 
		if($arr[$i]['cantidad']<$arr[$j]['cantidad']){
			
			$aux[1]['cantidad']=$arr[$j]['cantidad'];
			$aux[1]['co_productos']=$arr[$j]['co_productos'];
			
			$aux[$j]['cantidad']=$aux[$i]['cantidad'];
			$aux[$j]['co_productos']=$aux[$i]['co_productos'];
			
			$aux[$i]['cantidad']=$aux[1]['cantidad'];
			$aux[$i]['co_productos']=$aux[1]['co_productos'];
		}
	}
}

if ($registros<=10){
	$cantidad_reg=$registros;
}else{
	$cantidad_reg=10;
}

//solo los 10 primeros registros o los QUE HAYAN
for ($i = 1; $i <= $cantidad_reg; $i++) { 
	/*echo "numero: ".$arr[$i]['numero']."<br>";
	echo "codigo: ".$arr[$i]['co_productos']."<br>";
	echo "cantidad: ".$arr[$i]['cantidad']."<br><br>";*/
	if($i==1){
		$letra='a';	
	}
	if($i==2){
		$letra='b';	
	}
	if($i==3){
		$letra='c';	
	}
	if($i==4){
		$letra='d';	
	}
	if($i==5){
		$letra='e';	
	}
	if($i==6){
		$letra='f';	
	}
	if($i==7){
		$letra='g';	
	}
	if($i==8){
		$letra='h';	
	}
	if($i==9){
		$letra='i';	
	}
	if($i==10){
		$letra='j';	
	}
	
	$resulta_pro = mysqli_query($link,"SELECT * FROM tg013_productos WHERE co_productos='".$arr[$i]['co_productos']."'");
	$producto = mysqli_fetch_array($resulta_pro);	
	
	if($i==$cantidad_reg){
		$labels.="'".$producto['nb_productos']."'";
		$ykeys.="'".$letra."'";
		$data.="".$letra.":".$arr[$i]['cantidad']."";
		
	}else{
		$labels.="'".$producto['nb_productos']."',";
		$ykeys.="'".$letra."',";
		$data.="".$letra.":".$arr[$i]['cantidad'].",";
	}
} 

$estructura_data.="{ m: '".$ano."-".$mes."',".$data."},";
		
$mes_rest=$mes_rest-1;

if($mes_rest<1){
	$mes='12';
	$ano=$ano-1;	
}else{
	switch($mes_rest){
	case "01":
	  $mes='01';
	  break;
	case "02":
	   $mes='02';
	  break;
	case "03":
	   $mes='03';
	  break;
	case "04":
	   $mes='04';
	  break;
	case "05":
	   $mes='05';
	  break;
	case "06":
	   $mes='06';
	  break;
	case "07":
	   $mes='07';
	  break;
	case "08":
	   $mes='08';
	  break;
	case "09":
	   $mes='09';
	  break;
	case "10":
	   $mes='10';
	  break;
	case "11":
	   $mes='11';
	  break;
	case "12":
	   $mes='12';
	  break;  
	}
}
//HASTA AQUI PRIMER CICLO //HASTA AQUI PRIMER CICLO  //HASTA AQUI PRIMER CICLO  //HASTA AQUI PRIMER CICLO

//PARA EL SEGUNDO CICLO DE BUSCAR LOS PRODUCTOS VENDIDOS EN LOS 5 MESES ATRAS
for ($m = 1; $m <= 5; $m++) { 
	$data="";

	if($mes==02){
		$dia_inicio="01";
		$dia_fin="28";
	}
	if(($mes==01)||($mes==03)||($mes==05)||($mes==07)||($mes==08)||($mes==10)||($mes==12)){
		$dia_inicio="01";
		$dia_fin="31";
	}
	if(($mes==04)||($mes==06)||($mes==09)||($mes==11)){
		$dia_inicio="01";
		$dia_fin="30";
	}
	
	switch($mes){
	case "01":
	  $mes_letra="Enero";
	  $mes_rest=1;
	  break;
	case "02":
	  $mes_letra="Febrero";
	  $mes_rest=2;
	  break;
	case "03":
	  $mes_letra="Marzo";
	  $mes_rest=3;
	  break;
	case "04":
	  $mes_letra="Abril";
	  $mes_rest=4;
	  break;
	case "05":
	  $mes_letra="Mayo";
	  $mes_rest=5;
	  break;
	case "06":
	  $mes_letra="Junio";
	  $mes_rest=6;
	  break;
	case "07":
	  $mes_letra="Julio";
	  $mes_rest=7;
	  break;
	case "08":
	  $mes_letra="Agosto";
	  $mes_rest=8;
	  break;
	case "09":
	  $mes_letra="Septiembre";
	  $mes_rest=9;
	  break;
	case "10":
	  $mes_letra="Octubre";
	  $mes_rest=10;
	  break;
	case "11":
	  $mes_letra="Noviembre";
	  $mes_rest=11;
	  break;
	case "12":
	  $mes_letra="Diciembre";
	  $mes_rest=12;
	  break;  
	}
	
	$fecha_Inicio=$ano."-".$mes."-".$dia_inicio;
	$fecha_fin=$ano."-".$mes."-".$dia_fin;
	
	$pro=0;
	$num=0;
	
	for ($i = 1; $i <= $cantidad_reg; $i++) { 
		$sql_div1="SELECT * FROM (tr002_reng_pedidos AS rengped INNER JOIN tr001_pedidos AS ped ON rengped.co_pedidos=ped.co_pedidos) WHERE ped.fe_fecha BETWEEN '".$fecha_Inicio."' AND '".$fecha_fin."' AND rengped.co_productos='".$arr[$i]['co_productos']."' ORDER BY rengped.co_productos";
		$res22=mysqli_query($link,$sql_div1);
		//echo $sql_div1."<br>";
		
		$cantidad=0;
		while ($row_prod = mysqli_fetch_array($res22)) {
			$cantidad=$cantidad+$row_prod['nu_cantidad'];
			/*echo "numero: ".$arr[$i]['numero']."<br>";
			echo "codigo: ".$arr[$i]['co_productos']."<br>";
			echo "cantidad: ".$arr[$i]['cantidad']."<br><br>";*/
		}
		$arr[$i]['cantidad'] = $cantidad;
	}//for para buscar la venta del producto
	
	//solo los 10 primeros registros o los QUE HAYAN
	for ($i = 1; $i <= $cantidad_reg; $i++) { 
		/*echo "numero: ".$arr[$i]['numero']."<br>";
		echo "codigo: ".$arr[$i]['co_productos']."<br>";
		echo "cantidad: ".$arr[$i]['cantidad']."<br><br>";*/
		if($i==1){
			$letra='a';	
		}
		if($i==2){
			$letra='b';	
		}
		if($i==3){
			$letra='c';	
		}
		if($i==4){
			$letra='d';	
		}
		if($i==5){
			$letra='e';	
		}
		if($i==6){
			$letra='f';	
		}
		if($i==7){
			$letra='g';	
		}
		if($i==8){
			$letra='h';	
		}
		if($i==9){
			$letra='i';	
		}
		if($i==10){
			$letra='j';	
		}
		
		if($i==$cantidad_reg){
			$data.="".$letra.":".$arr[$i]['cantidad']."";
			
		}else{
			$data.="".$letra.":".$arr[$i]['cantidad'].",";
		}
	} 
	
	if($m==5){
		$estructura_data.="{ m: '".$ano."-".$mes."',".$data."}";
	}else{
		$estructura_data.="{ m: '".$ano."-".$mes."',".$data."},";
	}
			
	$mes_rest=$mes;
	$mes_rest=$mes_rest-1;
	
	if($mes_rest<1){
		$mes='12';
		$ano=$ano-1;	
	}else{
		switch($mes_rest){
		case "01":
		  $mes='01';
		  break;
		case "02":
		   $mes='02';
		  break;
		case "03":
		   $mes='03';
		  break;
		case "04":
		   $mes='04';
		  break;
		case "05":
		   $mes='05';
		  break;
		case "06":
		   $mes='06';
		  break;
		case "07":
		   $mes='07';
		  break;
		case "08":
		   $mes='08';
		  break;
		case "09":
		   $mes='09';
		  break;
		case "10":
		   $mes='10';
		  break;
		case "11":
		   $mes='11';
		  break;
		case "12":
		   $mes='12';
		  break;  
		}
	}
}//fin del for inicio a 5 meses atras a partir del mes nuevo

$variables="
Morris.Line({
  element: 'morris-line-chart',
  data: ".$estructura_data."],
  xkey: 'm',
  ykeys: [".$ykeys."],
  labels: [".$labels."],
  xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
    var month = months[x.getMonth()];
    return month;
  },
  dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  },
});";

//echo $variables;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Estadisticas</title>
</head>
<body>
<div class="container-fluid">
  <h2>Estadisticas de los 10 Productos mas Vendidos</h2>
  <div id="morris-line-chart"></div>
</div>

<script type="text/javascript">
var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
/*Morris.Line({
  element: 'morris-line-chart',
  data: [
    { m: '2015-01', a: 0, b: 270 }, {
    m: '2015-02',
    a: 54,
    b: 256
  }, {
    m: '2015-03',
    a: 243,
    b: 334
  }, {
    m: '2015-04',
    a: 206,
    b: 282
  }, {
    m: '2015-05',
    a: 161,
    b: 58
  }, {
    m: '2015-06',
    a: 187,
    b: 0
  }, {
    m: '2015-07',
    a: 210,
    b: 0
  }, {
    m: '2015-08',
    a: 204,
    b: 0
  }, {
    m: '2015-09',
    a: 224,
    b: 0
  }, {
    m: '2015-10',
    a: 301,
    b: 0
  }, {
    m: '2015-11',
    a: 262,
    b: 0
  }, {
    m: '2015-12',
    a: 199,
    b: 0
  }, ],
  xkey: 'm',
  ykeys: ['a', 'b'],
  labels: ['2014', '2015'],
  xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
    var month = months[x.getMonth()];
    return month;
  },
  dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  },
});*/

Morris.Line({
  element: 'morris-line-chart',
  data: [<?php echo $estructura_data;?>],
  xkey: 'm',
  ykeys: [<?php  echo $ykeys;?>],
  labels: [<?php  echo $labels;?>],
  xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
    var month = months[x.getMonth()];
    return month;
  },
  dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  },
});

</script>
</body>
</html>