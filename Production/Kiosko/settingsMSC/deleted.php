<?php
$id = json_decode($_POST['b']);
$conexion = mysqli_connect("192.168.1.77","root","toor");
$db = mysqli_select_db($conexion,"dev");
$x = 1;
for($i=0;$i<count($id);$i++){
	$consulta = "DELETE FROM `kioskoSettings` WHERE `id` = '$id[$i]'";
	if(mysqli_query($conexion, $consulta)){
		echo "<p>Records added successfully.</p>";
	} else{
		echo "<p>ERROR: Could not able to execute</p> $consulta." . mysqli_error($conexion);
	}
}

		$query ="SELECT `kiosko` FROM `kioskoSettings`";
		$result = mysqli_query($conexion, $query);
		while ($columna = mysqli_fetch_array( $result )){
			echo("UPDATE `kioskoSettings` SET `id`= $x, `orden` = $x WHERE `kiosko` = '$columna[0]'");
				$consultas = "UPDATE `kioskoSettings` SET `id`= $x, `orden` = $x WHERE `kiosko` = '$columna[0]'";
				++$x;
				mysqli_query($conexion, $consultas);
			echo($x);
		}


mysqli_close($conexion);

?>