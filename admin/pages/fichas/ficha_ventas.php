<?php 
@session_start();
include ("../../../inic/dbcon.php");

$resultaaa = mysqli_query($link,"SELECT * FROM tg004_configuracion");
$configurar = mysqli_fetch_array($resultaaa);
$result_monedas = mysqli_query($link,"SELECT * FROM tg0031_monedas WHERE co_monedas='".$configurar['co_monedas']."'");
$monedas = mysqli_fetch_array($result_monedas);
//echo $monedas['di_simbolo'];

$mes=date('m');
//echo $mes;
$ano=date('Y');
//echo $ano;

//PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO  //PRIMER CICLO

for ($m = 1; $m <= 6; $m++) { 
	if($mes==02){
		$dia_inicio=01;
		$dia_fin=28;
	}
	if(($mes==01)||($mes==03)||($mes==05)||($mes==07)||($mes==08)||($mes==10)||($mes==12)){
		$dia_inicio=01;
		$dia_fin=31;
	}
	if(($mes==04)||($mes==06)||($mes==09)||($mes==11)){
		$dia_inicio=01;
		$dia_fin=30;
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
	
	$nu_sub_total=0;
	$sql_div="SELECT * FROM (tr002_reng_pedidos AS rengped INNER JOIN tr001_pedidos AS ped ON rengped.co_pedidos=ped.co_pedidos) WHERE ped.fe_fecha BETWEEN '".$fecha_Inicio."' AND '".$fecha_fin."'";
	$res=mysqli_query($link,$sql_div);
	
	while ($row = mysqli_fetch_array($res)) {
			$nu_sub_total=$nu_sub_total+$row['nu_sub_total'];
	}
	
	//echo $ano."-".$mes.": ".$nu_sub_total."<br>";
	
	$letra='a';	
	
	if($m==1){
		//$estructura_data.="{ m: '".$ano."-".$mes."',".$letra.":".$nu_sub_total."}";
		$arr[$m]="{ m: '".$ano."-".$mes."',".$letra.":".$nu_sub_total."}";
	}else{
		//$estructura_data.="{ m: '".$ano."-".$mes."',".$letra.":".$nu_sub_total."},";
		$arr[$m]="{ m: '".$ano."-".$mes."',".$letra.":".$nu_sub_total."},";
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
    element: 'morris-bar-chart',
    data: [".$estructura_data."],
    xkey: 'm',
    ykeys: ['a'],
    labels: ['Monto ".$moneda['di_simbolo']."'],
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
  <h2>Estadisticas Monto de ventas en tiempo (meses) y montos de entrada</h2>
   <div id="morris-bar-chart"></div>
</div>

<script type="text/javascript">
var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
/*Morris.Bar({
    element: 'morris-bar-chart',
    data: [{
        m: '2015-01',
        a: 0,
        b: 270
    }, {
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
    xLabelFormat: function (x) { // <-- changed
        console.log("this is the new object:" + x);
        var month = months[x.x];
        return month;
    },
});*/
Morris.Bar({
    element: 'morris-bar-chart',
    data: [<?php echo $estructura_data;?>],
    xkey: 'm',
    ykeys: ['a'],
    labels: ['Monto <?php echo $monedas['di_simbolo'];?>'],
    xLabelFormat: function (x) { // <-- changed
        console.log("this is the new object:" + x);
        var month = months[x.x];
        return month;
    },
});
</script>
</body>
</html>