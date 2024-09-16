<?php 
//session_name("usuarioActivo");
@session_start();
if (!isset($_SESSION['co_usuario'])){	
	header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."");
//	header("refresh: 0; url=https://www.cedulasalud.com/app/login");
}else{
	/*//sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["usuario"]["fe_hh_ultima_sesion"];
    $hoy = date("H:i:s"); // 17:16:18
	//ojo la hora 2 debe ser $hoy
	//divido la hora en horas, min y seg porque viene en formato hh:mm:ss
	list($h1,$m1,$s1) = split(':',$fechaGuardada);
	list($h2,$m2,$s2) = split(':',$hoy);
	
	//resto los segundos
	$st=$s2-$s1;
	
	//si me da negativo resto el resultado a 60 y quito 1 a los minutos
	if($st<0){
		$st=60+$st;
		$m2=$m2-1;
	}
	
	//resto los minutos
	$mt=$m2-$m1;
	
	//si me da negativo resto el resultado a 60 y quito 1 a las horas
	if($mt<0){
		$mt=60+$mt;
		$h2=$h2-1;
	}
	//resto las horas
	$ht=$h2-$h1;
	
    //comparamos el tiempo transcurrido
		if(($ht>0)||($mt>=15)) {
			// si pasaron 10 minutos o más
			  //session_destroy(); // destruyo la sesión
			 session_name("usuarioActivo"); 
				session_start();
				ob_start();
				session_unset();
				session_destroy();
				echo "<script type='text/javascript'>alert('Su Session A Caducado tras 15 minutos de Inactividad');window.location=\"http://".$_SERVER['HTTP_HOST']."/ISWA/index.php\";parent.window.location=\"http://".$_SERVER['HTTP_HOST']."/ISWA/index.php\";
</script>";
				//echo "<script type='text/javascript'>alert('Su Session A Caducado tras 5 minutos de Inactividad');window.location=\"http://".$_SERVER['HTTP_HOST']."/ISWA/index.php\";

				//header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."/ISWA/index.php");
				exit(); //envío al usuario a la pag. de autenticación
			 // sino, actualizo la fecha de la sesión
		}else {
			$_SESSION["usuario"]["fe_hh_ultima_sesion"]=date("H:i:s"); // 17:16:18
		}*/
}


?>