<?php
include ("../../../inic/session.php");

if (isset($_POST['opc'])){ $opc = $_POST['opc'];}
if (isset($_GET['opc'])){ $opc = $_GET['opc'];}

if (isset($_POST['id'])){ $id = $_POST['id'];}
if (isset($_GET['id'])){ $id = $_GET['id'];}

$output_dir = "../../../img_productos/";
$ret = array();

$cantidad_img=$_SESSION['params']['nu_imagenes_pro'];
$suma=0;
for ($i = 2; $i <= $cantidad_img; $i++){
  $nombre_fichero = '../../../img_productos/p'.$id.'-'.$i.'.jpg';
  if (file_exists($nombre_fichero)) {
	  $suma=$suma+1;
  }
}
$suma=$suma+1;//por la imagen numero 1 la principal


if($opc=="varios"){
		$fileCount = count($_FILES["images"]['name']);
		$cod=$suma;
		  for($i=0; $i < $fileCount; $i++)
		  {
			$cod=$cod+1;
			//$fileName = $_SESSION['usuario']['co_paciente']."-".$_FILES["images"]["name"][$i];
			$fileName = "p".$id."-".$cod.".jpg";
			
			$ret[$fileName]= $output_dir.$fileName;
			move_uploaded_file($_FILES["images"]["tmp_name"][$i],$output_dir.$fileName);
			
			//para el ThumbnailImage
			$fileName2 = "pmin".$id."-".$cod.".jpg";
			
			//Especificamos cual sera el ancho y alto maximo permitido
			//para la imagen redimensionada
			$anchomaximo = 400;
			$altomaximo = 400;
			//Extraigo los atributos ancho y alto de la imagen original
			$dimensiones=getimagesize($output_dir.$fileName);
			$ancho=$dimensiones[0];
			$alto=$dimensiones[1];
			 
			//Calculamos el ancho y alto propocional de
			//la imagen redimensionada
			$anchoproporcional = $anchomaximo / $ancho;
			$altoproporcional = $altomaximo / $alto;
			//En caso de que el ancho y el alto estan dentro,
			//de los maximos permitidos, los mantenemos
			if( ($ancho <= $anchomaximo) && ($alto <= $altomaximo) ){
			  $anchonuevo = $ancho;
			  $altonuevo = $alto;
			}
			//Si el alto es mayor que el ancho
			//calculamos un alto proporcional al maximo permitido
			elseif (($anchoproporcional * $alto) < $altomaximo){
			  $altonuevo = ceil($anchoproporcional * $alto);
			  $anchonuevo = $anchomaximo;
			}
			//Si el ancho es mayor que el alto
			//calculamos un ancho proporcional al maximo permitido
			else{
			  $anchonuevo = ceil($altoproporcional * $ancho);
			  $altonuevo = $altomaximo;
			}
			
			$rsr_org = imagecreatefromjpeg($output_dir.$fileName);
			$rsr_scl = imagescale($rsr_org, $anchonuevo, $altonuevo,  IMG_BICUBIC_FIXED);
			imagejpeg($rsr_scl,$output_dir.$fileName2);
			imagedestroy($rsr_org);
			imagedestroy($rsr_scl);
			//hasta aqui thumbnailImage

			$imagen = file_get_contents($output_dir.$fileName);
			$save = file_put_contents($output_dir.$fileName2,$imagen);
		  }
}

if($opc=="unico"){
			$fileName = "p".$id."-1".".jpg";
			move_uploaded_file($_FILES["img_principal"]["tmp_name"],$output_dir.$fileName);
			
			//para el ThumbnailImage
			$fileName2 = "pmin".$id."-1".".jpg";
			
			//Especificamos cual sera el ancho y alto maximo permitido
			//para la imagen redimensionada
			$anchomaximo = 400;
			$altomaximo = 400;
			//Extraigo los atributos ancho y alto de la imagen original
			$dimensiones=getimagesize($output_dir.$fileName);
			$ancho=$dimensiones[0];
			$alto=$dimensiones[1];
			 
			//Calculamos el ancho y alto propocional de
			//la imagen redimensionada
			$anchoproporcional = $anchomaximo / $ancho;
			$altoproporcional = $altomaximo / $alto;
			//En caso de que el ancho y el alto estan dentro,
			//de los maximos permitidos, los mantenemos
			if( ($ancho <= $anchomaximo) && ($alto <= $altomaximo) ){
			  $anchonuevo = $ancho;
			  $altonuevo = $alto;
			}
			//Si el alto es mayor que el ancho
			//calculamos un alto proporcional al maximo permitido
			elseif (($anchoproporcional * $alto) < $altomaximo){
			  $altonuevo = ceil($anchoproporcional * $alto);
			  $anchonuevo = $anchomaximo;
			}
			//Si el ancho es mayor que el alto
			//calculamos un ancho proporcional al maximo permitido
			else{
			  $anchonuevo = ceil($altoproporcional * $ancho);
			  $altonuevo = $altomaximo;
			}
			
			$rsr_org = imagecreatefromjpeg($output_dir.$fileName);
			$rsr_scl = imagescale($rsr_org, $anchonuevo, $altonuevo,  IMG_BICUBIC_FIXED);
			imagejpeg($rsr_scl,$output_dir.$fileName2);
			imagedestroy($rsr_org);
			imagedestroy($rsr_scl);
			//hasta aqui thumbnailImage


			$imagen = file_get_contents($output_dir.$fileName);
			$save = file_put_contents($output_dir.$fileName2,$imagen);

}

echo json_encode($ret);
?>
