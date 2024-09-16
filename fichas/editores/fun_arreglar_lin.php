<?php 
include ("../../inic/dbcon.php");
//include ("../../inic/session.php");



$sql1="SELECT lin.*,cat.nb_categoria FROM tg008_linea AS lin INNER JOIN tg007_categoria AS cat ON lin.co_categoria=cat.co_categoria WHERE lin.in_eliminar='1'";

$sql1="SELECT * FROM tg008_linea GROUP BY nb_linea HAVING COUNT(*)>1;";
$res1=mysqli_query($link,$sql1);

echo "<h1>LINEAS DUPLICADAS</h1><br>";

while ($linea = mysqli_fetch_array($res1)) {//while de lineas repetidas
	
	$contador=0;
	
	$estructura.="
	<table>
        
			<tr>
				<th colspan='5'>".$linea['nb_linea']."</td>
			</tr>
            <tr>
                <th>co_Linea</th>
                <th>Sublinea</th>
                <th>Division1</th>
                <th>Division2</th>
                <th>Division3</th>
            </tr>
        
        ";
	
	$sql144="SELECT * FROM tg008_linea WHERE nb_linea='".$linea['nb_linea']."'";
	$res144=mysqli_query($link,$sql144);
	
	while ($linea_rep = mysqli_fetch_array($res144)) {//while de lineas
		$estructura_slin="";
		$estructura_div1="";
		$estructura_div2="";
		$estructura_div3="";
		
		//para el primer registro que pasa
		if ($contador==0){
			//tomo primer valor
			$linea_activa=$linea_rep['co_linea'];
			$contador=$contador+1;
		}else{
			//actualizo linea en el producto
			$sql="UPDATE tg013_productos SET co_linea='".$linea_activa."' WHERE co_linea='".$linea_rep['co_linea']."'";
			//mysqli_query($link,$sql);
			//desactivo linea
			$sql12="UPDATE tg008_linea SET in_estatus='0' WHERE co_linea='".$linea_rep['co_linea']."'";
			//mysqli_query($link,$sql12);
		}
		
		$estructura.="
		<tr>
			<td>".$linea_rep['co_linea']."</td>";
		
		$sql19="SELECT * FROM tg009_sublineas WHERE co_linea='".$linea_rep['co_linea']."'";
		$res13=mysqli_query($link,$sql19);

		while ($slinea = mysqli_fetch_array($res13)) {//while 
			$estructura_slin.=$slinea['co_sublineas']." - ".$slinea['nb_sublineas']."<br>";
			
			$sql191="SELECT * FROM tg010_division WHERE co_sublineas='".$slinea['co_sublineas']."'";
			$res131=mysqli_query($link,$sql191);

			while ($div1 = mysqli_fetch_array($res131)) {//while
				$estructura_div1.=$div1['co_division']." - ".$div1['nb_division']."<br>";
			
				$sql193="SELECT * FROM tg011_division2 WHERE co_division='".$div1['co_division']."'";
				$res134=mysqli_query($link,$sql193);

				while ($div2 = mysqli_fetch_array($res134)) {//while
				$estructura_div2.=$div2['co_division2']." - ".$div2['nb_division2']."<br>";
					
					$sql197="SELECT * FROM tg012_division3 WHERE co_division2='".$div2['co_division2']."'";
					$res137=mysqli_query($link,$sql197);

					while ($div3 = mysqli_fetch_array($res137)) {//while
					$estructura_div3.=$div3['co_division3']." - ".$div3['nb_division3']."<br>";

					}
					//$estructura_div3.="<br>";
				}
				//$estructura_div2.="<br>";
			}
			//$estructura_div1.="<br>";
		}
		//$estructura_slin.="<br>";
		
		$estructura.="
			<td>".$estructura_slin."</td>
			<td>".$estructura_div1."</td>
            <td>".$estructura_div2."</td>
            <td>".$estructura_div3."</td>
            </tr>";	
	}
}//fin while de lineas

echo $estructura;