<?php
$vin = $_POST['vin'];
$vinD = $_POST['description'];
$st = $_POST['station'];
$act = $_POST['action'];
$date = $_POST['stamp'];
$conexion = mysqli_connect("192.168.1.77","root","toor");
$db = mysqli_select_db($conexion,"dev");
$consulta = "INSERT INTO kioskoLog (station,action,stamp,vin) VALUES('$st','$act','$date','$vin')";
if(mysqli_query($conexion, $consulta)){
    echo "<p>Records added successfully.</p>";
} else{
    echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
}
mysqli_close($conexion);
?>