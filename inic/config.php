<?php
@session_start();
$hoy = date("Y-m-d H:i:s");

include "dbcon.php";

   /*$respar = mysql_query("SELECT * FROM tg001_parametros",$link);
   $params = mysql_fetch_array($respar);*/
   
   if ($_GET['logout']) {
	   unset($_GET['logout']);
	   session_unset();
	   session_destroy();
	   
	   //header("Refresh: 2; URL=../admin/index.php");
		echo '<div style="width:400px; height:140px; position:fixed; top:50%; left:50%; margin-left: -200px; margin-top: -70px;"><img src="../img/cerrarsesion.gif" width="400px" height="139px"></div>';
		echo "<script type='text/javascript'> window.location='../index.php'; </script>";
		exit();	   
   }   
   
   if (isset($_POST['login'])) {
	   		$result = mysqli_query($link,"SELECT usu.*,nvl.nb_nivel FROM (th001_usuario AS usu INNER JOIN th002_nivel_usuario AS nvl ON usu.co_nivel_usuario=nvl.co_nivel_usuario) WHERE usu.nb_usuario='".$_POST['nb_usuario']."' AND usu.tx_clave='".md5($_POST['tx_clave'])."'");
			$admin = mysqli_fetch_array($result);
			
			if (mysqli_num_rows($result)>0) {
				$_SESSION['login'] = 1;
				$_SESSION['co_usuario']=$admin['co_usuario'];
				$_SESSION['co_nivel_usuario']=$admin['co_nivel_usuario'];
				$_SESSION['nb_usuario']=$admin['nb_usuario'];
				$_SESSION['nb_nivel']=$admin['nb_nivel'];
				
				if ($_SESSION['co_nivel_usuario']=="2"){
					$respar2 = mysqli_query($link,"SELECT cli.*,tp.tp_precio FROM (tg005_clientes AS cli INNER JOIN tg001_tpcliente AS tp ON cli.co_tpcliente=tp.co_tpcliente) WHERE co_usuario='".$admin['co_usuario']."'");
					$_SESSION['cliente'] = mysqli_fetch_array($respar2);
					
					mysqli_query($link,"UPDATE tg005_clientes SET fe_ultima_session='".$hoy."' WHERE co_usuario ='".$admin['co_usuario']."'");
				}
				
				if ($_SESSION['co_nivel_usuario']=="3"){
					$respar2 = mysqli_query($link,"SELECT * FROM tg002_vendedor WHERE co_usuario='".$admin['co_usuario']."'");
					$_SESSION['vendedor'] = mysqli_fetch_array($respar2);
					
					mysqli_query($link,"UPDATE tg002_vendedor SET fe_ultima_session='".$hoy."' WHERE co_usuario ='".$admin['co_usuario']."'");
				}
				
				echo "<script type='text/javascript'> parent.window.location='../menu/index.php'; </script>";
				exit();	
			}else{
				$error=1;
			}			
	}

?>