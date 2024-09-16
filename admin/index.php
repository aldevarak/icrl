<?php 
	include ("../../inic/dbcon.php");
	//include ("../../inic/session.php");
	@session_start();
	
	if ($_SESSION['co_nivel_usuario']!='1'){	
		header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."");
	}
?>