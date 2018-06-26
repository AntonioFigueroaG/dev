<?php
$name =  $_POST['name'];
$sD = $_POST['sD'];
$eD = $_POST['eD'];
$selectline = $_POST['selectline'];
$description = $_POST['description'];
$color = $_POST['color'];
$company = $_POST['company'];

$conexion = mysqli_connect("localhost","root","toor");
$db = mysqli_select_db($conexion,"dev");

$consulta = "INSERT INTO scheduler (name,startDate,endDate,line,color,description,company) VALUES('$name','$sD','$eD','$selectline','$color','$description','$company')";
if(mysqli_query($conexion, $consulta)){
    echo "<p>Records added successfully.</p>";
} else{
    echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
}
mysqli_close($conexion);

?>