<?php
include("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre   = $_POST['nombre'];
    $correo   = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO usuarios (nombre, correo, telefono)
            VALUES ('$nombre', '$correo', '$telefono')";
