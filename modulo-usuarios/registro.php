<?php
include("../config/conexion.php");

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

<form method="POST">
    <h2>Registro de Usuario</h2>
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <input type="text" name="telefono" placeholder="Teléfono">
    <button type="submit">Registrarse</button>
</form>