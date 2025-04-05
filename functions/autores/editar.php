<?php
include '../bd.php';

// Obtener el ID del autor a editar
if (isset($_GET['id_autor'])) {
    $id_autor = $_GET['id_autor'];

    // Consultar los datos del autor
    $sql = "SELECT * FROM autores WHERE id_autor = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id_autor);
        $stmt->execute();
        $result = $stmt->get_result();
        $autor = $result->fetch_assoc();
        $stmt->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario de edición
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $cod_postal = $_POST['cod_postal'];

    // Preparar la consulta SQL para actualizar los datos
    $sql = "UPDATE autores SET apellido = ?, nombre = ?, telefono = ?, direccion = ?, ciudad = ?, estado = ?, pais = ?, cod_postal = ? WHERE id_autor = ?";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssssssssi", $apellido, $nombre, $telefono, $direccion, $ciudad, $estado, $pais, $cod_postal, $id_autor);
        if ($stmt->execute()) {
            echo "<script>alert('Autor actualizado exitosamente'); window.location.href='autores.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar el autor');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error en la consulta SQL');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Editar Autor</h1>
        <br>
        <form method="post" action="editar.php?id_autor=<?= $autor['id_autor'] ?>">
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?= $autor['apellido'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $autor['nombre'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $autor['telefono'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $autor['direccion'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= $autor['ciudad'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" value="<?= $autor['estado'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="pais" class="form-label">País</label>
                <input type="text" class="form-control" id="pais" name="pais" value="<?= $autor['pais'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="cod_postal" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="cod_postal" name="cod_postal" value="<?= $autor['cod_postal'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Autor</button>
            <a href="autores.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
