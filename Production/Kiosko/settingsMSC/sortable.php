<?php
function conectar() {
    $server = '192.168.1.77';
    $user = 'root';
    $pass = 'toor';
    $db = 'dev';
 
    $conexion = mysqli_connect($server, $user, $pass, $db);
    return $conexion;
}
function get_elementos() {
    $conexion = conectar();
 
    $consulta = mysqli_query($conexion,
        "
        SELECT *
        FROM kioskoSettings
        ORDER BY orden ASC
        ");
    if ($consulta) {
        $res = array();
        while ($fila = mysqli_fetch_array($consulta)) {
            $res[] = $fila;
        }
        mysqli_close($conexion);
        return $res;
    }
    else {
        mysqli_close($conexion);
        return false;
    }
}
function reordenar($id, $orden) {
    $conexion = conectar();
 
    $consulta = mysqli_query($conexion, "
        UPDATE kioskoSettings
        SET orden = $orden
        WHERE id = $id");
 
    if ($consulta) return true;
    return false;
}

?>