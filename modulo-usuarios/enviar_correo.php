<?php
session_start();
include("../config/conexion.php");

$correo = $_SESSION['usuario'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO solicitudes (correo_usuario, mensaje)
        VALUES ('$correo','$mensaje')";
$conexion->query($sql);

$asunto = "Solicitud recibida – Consultoría Digital";
$respuesta = "
Estimado/a cliente:

Hemos recibido su solicitud correctamente.
Nuestro equipo se pondrá en contacto con usted a la brevedad.

Agradecemos su confianza.

Atentamente,
Consultoría Digital Estratégica
";

mail($correo, $asunto, $respuesta);

header("Location: dashboard.php");
exit();