<?php
$newname =  $_POST['unameks'];
$newaction = $_POST['nactions'];
$viejoname = $_POST['viejonamek'];

$conexion = mysqli_connect("192.168.1.77","root","toor");
$db = mysqli_select_db($conexion,"dev");

if($newname==$viejoname){
	$consultas = "SELECT * FROM `kioskoSettings` WHERE `kiosko`='$newname' && `action` = '$newaction'";
}else{
	$query =  "SELECT * FROM `kioskoSettings` WHERE `kiosko`='$newname'";
}

$cn = mysqli_query($conexion, $consultas);
$cnd = mysqli_query($conexion, $query);

if(mysqli_num_rows($cnd)!=0){
	echo "Existing kiosko";
}else{
if(mysqli_num_rows($cn)!=0){
	echo "Existing kiosko";
}else{
$consulta = "UPDATE kioskoSettings SET `kiosko`='$newname',`action`='$newaction' WHERE `kiosko`= '$viejoname'";
$consultasa = "UPDATE kioskoLog SET `station`='$newname' WHERE `station` ='$viejoname'";
if(mysqli_query($conexion, $consultasa)){
    echo "Records added successfully.";
} else{
    echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
}	
if(mysqli_query($conexion, $consulta)){
    echo "Records added successfully.";
} else{
    echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
}
}
}
mysqli_close($conexion);

?>
