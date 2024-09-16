<?php 
@session_start();
include ("../../../inic/dbcon.php");

$resultaaa = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$configurar = mysqli_fetch_array($resultaaa);

$mes=date('m');
//echo $mes;
$ano=date('Y');
//echo $ano;

//PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO

for ($m = 1; $m <= 6; $m++) { 
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
	  $mes_rest=1;
	  break;
	case "02":
	  $mes_rest=2;
	  break;
	case "03":
	  $mes_rest=3;
	  break;
	case "04":
	  $mes_rest=4;
	  break;
	case "05":
	  $mes_rest=5;
	  break;
	case "06":
	  $mes_rest=6;
	  break;
	case "07":
	  $mes_rest=7;
	  break;
	case "08":
	  $mes_rest=8;
	  break;
	case "09":
	  $mes_rest=9;
	  break;
	case "10":
	  $mes_rest=10;
	  break;
	case "11":
	  $mes_rest=11;
	  break;
	case "12":
	  $mes_rest=12;
	  break;  
	}

	$fecha_Inicio=$ano."-".$mes."-".$dia_inicio;
	$fecha_fin=$ano."-".$mes."-".$dia_fin;
	
	$sql_div="SELECT COUNT(co_pedidos) AS cant FROM tr001_pedidos WHERE fe_fecha BETWEEN '".$fecha_Inicio."' AND '".$fecha_fin."'";
	//echo $sql_div."<br>";
	$result_ped = mysqli_query($link,$sql_div);
	$pedidos = mysqli_fetch_array($result_ped);
	
	//echo $ano."-".$mes.": ".$nu_sub_total."<br>";
	//echo $pedidos['cant']."<br>";
	$letra='a';	
	
	if($m==1){
		//$estructura_data.="{ m: '".$ano."-".$mes."',".$letra.":".$pedidos['cant']."}";
		$arr[$m]="{ m: '".$ano."-".$mes."',".$letra.":".$pedidos['cant']."}";
	}else{
		//$estructura_data.="{ m: '".$ano."-".$mes."',".$letra.":".$pedidos['cant']."},";
		$arr[$m]="{ m: '".$ano."-".$mes."',".$letra.":".$pedidos['cant']."},";
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
	
}//fin del for inicial

for ($m = 6; $m >= 1; $m--) { 
	//echo $m."<br>";
	$estructura_data.=$arr[$m];
}
//echo $estructura_data."<br>";

$variables="
Morris.Bar({
    element: 'morris-bar-chart2',
    data: [".$estructura_data."],
    xkey: 'm',
    ykeys: ['a'],
    labels: ['Cantidad'],
    xLabelFormat: function (x) { // <-- changed
        console.log('this is the new object:' + x);
        var month = months[x.x];
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
<style>
</style>
</head>
<body>
<div class="container-fluid">
  <h2>Estadisticas Pedido realizados y tiempo (meses)</h2>
   <div id="morris-bar-chart2"></div>
</div>

<script type="text/javascript">
/*Morris.Bar({
  element: 'morris-bar-chart',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
});*/
var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
Morris.Bar({
    element: 'morris-bar-chart2',
    data: [<?php echo $estructura_data;?>],
    xkey: 'm',
    ykeys: ['a'],
    labels: ['Cantidad'],
    xLabelFormat: function (x) { // <-- changed
        console.log("this is the new object:" + x);
        var month = months[x.x];
        return month;
    },
	/*dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  	},*/
});
</script>
</body>
</html>