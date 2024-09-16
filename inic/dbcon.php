<?php 
error_reporting(E_ALL ^ E_NOTICE);
//conexion a la base de datos
function Conectarse() {
   if (!($link=mysqli_connect("localhost","rooticrl","123456","bydigitalv3"))) {
      echo "Error conectando a la base de datos.";
      exit();
   }
/*   if (mysql_error())
	echo ("<script language='javascript'> 
	alert('Error al conectarse al servidor de base de datos..!')
	location.href = 'index.php'; 
	</script>");*/
   return $link;
}
$dbname = "bydigitalv3";
$link=Conectarse();

?>