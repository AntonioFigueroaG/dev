<?php
$vin =  $_POST['nvin'];
$description = $_POST['des'];

$conexion = mysqli_connect("192.168.1.77","root","toor");
$db = mysqli_select_db($conexion,"dev");
$consultas = "SELECT `vin` FROM `pruebas` WHERE `vin`='$vin'";
$cn = mysqli_query($conexion, $consultas);
if(mysqli_num_rows($cn)!=0){
	echo "Existing vin";
}else{
	$consulta = "INSERT INTO pruebas(vin,description) VALUES('$vin','$description')";
	if(mysqli_query($conexion, $consulta)){
		echo "<p>Records added successfully.</p>";
	} else{
		echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
	}
}
?>