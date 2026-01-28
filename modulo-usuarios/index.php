<?php
require_once("../config/conexion.php");

/* Servicios activos */
$servicios = $conexion->query(
    "SELECT nombre, descripcion 
     FROM servicios 
     WHERE activo = 1"
);

/* Especializaciones */
$especializaciones = $conexion->query(
    "SELECT nombre, descripcion 
     FROM especializaciones"
);

/* Proyectos (Portafolio) */
$proyectos = $conexion->query(
    "SELECT nombre, empresa, descripcion 
     FROM proyectos 
     ORDER BY fecha_inicio DESC 
     LIMIT 3"
);

/* Contactos */
$contactos = $conexion->query(
    "SELECT tipo, valor 
     FROM contactos"
);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultoría Digital Estratégica</title>
    <link rel="stylesheet" href="..\css/estilos.css">
</head>
<body>

<header class="hero">
    <h1>Consultoría Digital Estratégica</h1>
    <p>Impulsamos marcas y estrategias con visión digital.</p>

    <div class="hero-buttons">
        <a href="login.php">Iniciar sesión</a>
        <a href="registro.php" class="outline">Registrarse</a>
    </div>
</header>

<section class="section">
    <h2>¿A qué nos dedicamos?</h2>
    <p>
        Somos una consultoría especializada en soluciones tecnológicas
        y estratégicas, enfocada en ayudar a empresas a optimizar
        procesos, fortalecer su infraestructura y crecer de forma sostenible.
    </p>
</section>

<section class="section light">
    <h2>Servicios</h2>

    <ul class="servicios">
        <?php if ($servicios->num_rows > 0): ?>
            <?php while ($s = $servicios->fetch_assoc()): ?>
                <li>
                    <strong><?= htmlspecialchars($s['nombre']) ?></strong><br>
                    <small><?= htmlspecialchars($s['descripcion']) ?></small>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No hay servicios disponibles</li>
        <?php endif; ?>
    </ul>
</section>

<section class="section">
    <h2>Especialización</h2>

    <div class="grid">
        <?php if ($especializaciones->num_rows > 0): ?>
            <?php while ($e = $especializaciones->fetch_assoc()): ?>
                <div>
                    <h3><?= htmlspecialchars($e['nombre']) ?></h3>
                    <p><?= htmlspecialchars($e['descripcion']) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay especializaciones registradas.</p>
        <?php endif; ?>
    </div>
</section>

<section class="section light">
    <h2>Portafolio</h2>

    <div class="grid">
        <?php if ($proyectos->num_rows > 0): ?>
            <?php while ($p = $proyectos->fetch_assoc()): ?>
                <div>
                    <h3><?= htmlspecialchars($p['nombre']) ?></h3>
                    <p><strong>Empresa:</strong> <?= htmlspecialchars($p['empresa']) ?></p>
                    <p><?= htmlspecialchars($p['descripcion']) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay proyectos para mostrar.</p>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <h2>Contacto</h2>

    <ul>
        <?php if ($contactos->num_rows > 0): ?>
            <?php while ($c = $contactos->fetch_assoc()): ?>
                <li>
                    <?= ucfirst($c['tipo']) ?>:
                    <?= htmlspecialchars($c['valor']) ?>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No hay información de contacto disponible.</li>
        <?php endif; ?>
    </ul>
</section>

<section class="section light">
    <h2>Visítanos</h2>
    <iframe 
        src="https://www.google.com/maps?q=Ciudad%20de%20México&output=embed"
        width="100%" 
        height="300" 
        style="border-radius:12px;border:0;">
    </iframe>
</section>

<footer>
    <p>© 2026 Consultoría Digital Estratégica</p>
</footer>

</body>
</html>
