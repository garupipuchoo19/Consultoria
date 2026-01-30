<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="container">
    <h2>Bienvenido</h2>
    <p style="text-align:center;"><?php echo $_SESSION['usuario']; ?></p>

    <h3>Servicios disponibles</h3>
    <ul class="servicios">
        <li>Consultoría Digital</li>
        <li>Estrategia de Marketing</li>
        <li>Publicidad Online</li>
        <li>Branding</li>
    </ul>
    <h3>Solicitar ayuda</h3>
    <form action="enviar_correo.php" method="POST">
        <textarea name="mensaje" placeholder="Describe tu necesidad..." required></textarea>
        <button>Enviar solicitud</button>
    </form>

    <a href="logout.php"><button>Cerrar sesión</button></a>
</div>
</body>
</html>
