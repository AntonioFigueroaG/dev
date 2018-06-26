<?php
$nameks =  $_POST['nameks'];
$orden = $_POST['orden'];
$action = $_POST['select'];

$conexion = mysqli_connect("192.168.1.77","root","toor");
$db = mysqli_select_db($conexion,"dev");
$consultas = "SELECT `kiosko` FROM `kioskoSettings` WHERE `kiosko`='$nameks'";
$cn = mysqli_query($conexion, $consultas);
if(mysqli_num_rows($cn)!=0){
	echo "Existing kiosko";
}else{
	$consulta = "INSERT INTO kioskoSettings(kiosko,action,orden,id) VALUES('$nameks','$action','$orden','$orden')";
	if(mysqli_query($conexion, $consulta)){
		echo "<p>Records added successfully.</p>";
	} else{
		echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
	}
}
mysqli_close($conexion);

?>