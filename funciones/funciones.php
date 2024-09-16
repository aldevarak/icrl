<?php 
// 14 de Octubre de 2003
// Traduce una fecha en formato mm/dd/yyyy a formato texto en castellano
// Desde la pagina llamaremos a la funcion
// echo traducefecha("11/15/2003"); Visualiza la fecha
// Donde la fecha ponemos la variable que queremos traducir en formato mm/dd/yyyy

function traducefecha($fecha) //esta funcional
    {
 if ($fecha!=""){		
    $fecha= strtotime($fecha); // convierte la fecha de formato mm/dd/yyyy a marca de tiempo
    $diasemana=date("w", $fecha);// optiene el número del dia de la semana. El 0 es domingo
       switch ($diasemana)
       {
       case "0":
          $diasemana="Domingo";
          break;
       case "1":
          $diasemana="Lunes";
          break;
       case "2":
          $diasemana="Martes";
          break;
       case "3":
          $diasemana="Mi&eacute;rcoles";
          break;
       case "4":
          $diasemana="Jueves";
          break;
       case "5":
          $diasemana="Viernes";
          break;
       case "6":
          $diasemana="S&aacute;bado";
          break;
       }
    $dia=date("d",$fecha); // día del mes en número  
    $mes=date("m",$fecha); // número del mes de 01 a 12
       switch($mes)
       {
       case "01":
          $mes="Enero";
          break;
       case "02":
          $mes="Febrero";
          break;
       case "03":
          $mes="Marzo";
          break;
       case "04":
          $mes="Abril";
          break;
       case "05":
          $mes="Mayo";
          break;
       case "06":
          $mes="Junio";
          break;
       case "07":
          $mes="Julio";
          break;
       case "08":
          $mes="Agosto";
          break;
       case "09":
          $mes="Septiembre";
          break;
       case "10":
          $mes="Octubre";
          break;
       case "11":
          $mes="Noviembre";
          break;
       case "12":
          $mes="Diciembre";
          break;  
       }
    $ano=date("Y",$fecha); // optenemos el año en formato 4 digitos
    $fecha= $diasemana.", ".$dia." de ".$mes." de ".$ano; // unimos el resultado en una unica cadena
	//fecha con hora abajo
	//$fecha= $diasemana.", ".$dia." de ".$mes." de ".$ano." a las ".date("h:i a",$fecha); // unimos el resultado en una unica cadena
 }else{
 $fecha="Sin resultados";
 }	
    return $fecha; //enviamos la fecha al programa 
    }  
	
	
//Determina la hora actual del servidor  
function actual(){   //esta funcional
$hora = date("Y-m-d H:i:s",strtotime(date("h:i:s A"))-1800);
return $hora;
} 

function Num_Registros($num){   //esta funcional
	if ($num!=0){
	$retorno="<samp class='num_ts'>".$num."</samp>";
	}
 return $retorno;	
}


function limpia_espacios($cadena){
    $cadena = ereg_replace( "([ ]+)","+", $cadena );
    return $cadena;
}

?>