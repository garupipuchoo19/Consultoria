<?php
session_start();
include("../config/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"]);

    if (!empty($correo)) {
        $stmt = $conexion->prepare("SELECT id_usuario, nombre, correo FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();

            $_SESSION["id_usuario"] = $usuario["id_usuario"];
            $_SESSION["nombre"]     = $usuario["nombre"];
            $_SESSION["correo"]     = $usuario["correo"];

            header("Location: dashboard.php");
            exit;
        } else {
            $mensaje = "El correo no está registrado.";
        }
    } else {
        $mensaje = "Por favor ingresa tu correo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión | Consultoría</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="contenedor-login">
    <h2>Iniciar Sesión</h2>
    <p>Accede para conocer nuestros servicios y solicitar asesoría</p>

    <?php if (!empty($mensaje)): ?>
        <div class="mensaje-error"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Correo electrónico</label>
        <input type="email" name="correo" required placeholder="correo@ejemplo.com">

        <button type="submit">Entrar</button>
    </form>

    <p class="registro">
        ¿No tienes cuenta?
        <a href="registro.php">Regístrate aquí</a>
    </p>
</div>

</body>
</html>
