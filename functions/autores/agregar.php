<?php
include "../bd.php";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_autor = $_POST['id_autor'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $cod_postal = $_POST['cod_postal'];

    // Preparar la consulta para insertar el nuevo autor
    $query = mysqli_prepare($conexion, "INSERT INTO autores (id_autor, apellido, nombre, telefono, direccion, ciudad, estado, pais, cod_postal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Vincular los parámetros
    mysqli_stmt_bind_param($query, "issssssss", $id_autor, $apellido, $nombre, $telefono, $direccion, $ciudad, $estado, $pais, $cod_postal);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($query)) {
        header("Location: autores.php");
        exit();
    } else {
        echo "<script>alert('Error al agregar el autor.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center" >Agregar Autor</h1>
        <br>
        <form method="post">
            <div class="mb-3">
                <label for="id_autor" class="form-label">ID Autor</label>
                <input type="text" name="id_autor" id="id_autor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" name="ciudad" id="ciudad" class="form-control">
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" name="estado" id="estado" class="form-control" maxlength="2">
            </div>
            <div class="mb-3">
                <label for="pais" class="form-label">País</label>
                <input type="text" name="pais" id="pais" class="form-control" maxlength="3">
            </div>
            <div class="mb-3">
                <label for="cod_postal" class="form-label">Código Postal</label>
                <input type="text" name="cod_postal" id="cod_postal" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Agregar Autor</button>
        </form>
        <a href="autores.php" class="btn btn-secondary mt-3">Volver</a>
    </div>
</body>
</html>
