<?php
error_reporting(E_ALL ^ E_NOTICE);
@session_start();
if (!isset($_SESSION['co_usuario'])){
	header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."/icrl/menu");
}else{
	if ($_SESSION['tp_usuario']=="a"){
		header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."/icrl/admin/pages");
	}else{
		header("refresh: 0; url=http://".$_SERVER['HTTP_HOST']."/icrl/menu");	
	}
}
?>