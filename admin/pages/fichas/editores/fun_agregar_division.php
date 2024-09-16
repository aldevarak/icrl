<?php 
include ("../../../../inic/dbcon.php");
include ("../../../../inic/session.php");

$sql3="INSERT INTO tg010_division (co_sublineas,nb_division,in_eliminar,in_estatus) VALUES (".$_POST['co_sublineas'].",'".$_POST['nb_division']."',1,1)";
mysqli_query($link,$sql3);

$result34 = mysqli_query($link,"SELECT co_division AS id FROM tg010_division WHERE in_estatus='1' ORDER BY co_division DESC LIMIT 1");
$code = mysqli_fetch_array($result34);

//agregar division 2 automatica
$sql39="INSERT INTO tg011_division2 (co_division,nb_division2,in_eliminar,in_estatus) VALUES (".$code['id'].",'N/A',1,1)";
mysqli_query($link,$sql39);

//echo "<script type='text/javascript' charset='utf-8'>console.log('".$sql39."')</script>";

$result45 = mysqli_query($link,"SELECT co_division2 AS id FROM tg011_division2 WHERE in_estatus='1' ORDER BY co_division2 DESC LIMIT 1");
$code2 = mysqli_fetch_array($result45);

//agregar division 3 automatica
$sql391="INSERT INTO tg012_division3 (co_division2,nb_division3,in_eliminar,in_estatus) VALUES (".$code2['id'].",'N/A',1,1)";
mysqli_query($link,$sql391);

//echo "<script type='text/javascript' charset='utf-8'>console.log('".$sql391."')</script>";
?>