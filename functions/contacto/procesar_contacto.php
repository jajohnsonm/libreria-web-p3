<?php
include '../bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    $sql = "INSERT INTO contactos (fecha, correo, nombre, asunto, comentario) 
            VALUES (NOW(), '$correo', '$nombre', '$asunto', '$comentario')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='../../index.php';</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje'); window.location.href='contacto.php';</script>";
    }
}
?>
