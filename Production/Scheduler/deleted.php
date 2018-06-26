<?php
$name =  $_POST['name'];
$company = $_POST['company'];

$conexion = mysqli_connect("localhost","root","toor");
$db = mysqli_select_db($conexion,"dev");

$consulta = "SELECT * FROM scheduler WHERE name=".$name." AND company='".$company."';";
 

if(mysqli_query($conexion, $consulta)){
	$row = mysqli_fetch_row(mysqli_query($conexion, $consulta));
	mysqli_query($conexion,"INSERT INTO deleted (name, startDate, endDate, line, description, company) VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[5]','$company')");
	mysqli_query($conexion,"DELETE FROM scheduler WHERE name='$name' AND company='".$company."';");
} else{
    echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
}
mysqli_close($conexion);
?>