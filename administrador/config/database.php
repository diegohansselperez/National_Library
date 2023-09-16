<?php
$localhost = "localhost";
$bd = "national_library";
$usuario = "root";
$contraseña = "";

try {
    $conexion = new PDO("mysql:host=$localhost;dbname=$bd", $usuario, $contraseña);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>