<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="dashboard">

    <!-- HEADER -->
    <header class="dashboard-header">
        <h2>Panel de Usuario</h2>
        <span class="usuario">👤 <?php echo $_SESSION['usuario']; ?></span>
        <a href="logout.php" class="btn-logout">Cerrar sesión</a>
    </header>

    <!-- CONTENIDO -->
    <main class="dashboard-content">

        <!-- SERVICIOS -->
        <section class="card">
            <h3>Servicios disponibles</h3>
            <ul class="servicios">
                <li>Consultoría Digital</li>
                <li>Estrategia de Marketing</li>
                <li>Publicidad Online</li>
                <li>Branding</li>
            </ul>
        </section>

        <!-- FORMULARIO -->
        <section class="card">
            <h3>Solicitar ayuda</h3>
            <form action="enviar_correo.php" method="POST">
                <textarea name="mensaje" placeholder="Describe tu necesidad..." required></textarea>
                <button type="submit">Enviar solicitud</button>
            </form>
        </section>

    </main>

</div>

</body>
</html>
