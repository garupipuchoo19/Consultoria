<?php
include("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $correo   = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO usuarios (nombre, correo, telefono)
            VALUES ('$nombre', '$correo', '$telefono')";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $correo   = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO usuarios (nombre, correo, telefono)
            VALUES ('$nombre', '$correo', '$telefono')";

    if ($conexion->query($sql)) {
        header("Location: login.php");
    } else {
        echo "Error al registrar: " . $conexion->error;
    }
}
?>