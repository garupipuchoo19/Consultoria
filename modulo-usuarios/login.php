<?php
include("../config/conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];

    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header("Location: dashboard.php");
    } else {
        echo "Usuario no encontrado";
    }
}
?>

<form method="POST">
    <h2>Iniciar Sesión</h2>
    <input type="email" name="correo" placeholder="Correo" required>
    <button type="submit">Entrar</button>
</form>
