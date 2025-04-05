<?php
include '../bd.php';

$sql = "SELECT id_autor, apellido, nombre, telefono, direccion, ciudad, estado, pais, cod_postal FROM autores";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center">
        <h1>Autores</h1>
        <br><br>
        <a class="btn btn-outline-success" href="agregar.php">Crear Nuevo Libro</a>
        <br><br>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>País</th>
                <th>Código Postal</th>
                <th>Editar / Eliminar</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row["id_autor"] ?></td>
                    <td><?= $row["apellido"] ?></td>
                    <td><?= $row["nombre"] ?></td>
                    <td><?= $row["telefono"] ?></td>
                    <td><?= $row["direccion"] ?></td>
                    <td><?= $row["ciudad"] ?></td>
                    <td><?= $row["estado"] ?></td>
                    <td><?= $row["pais"] ?></td>
                    <td><?= $row["cod_postal"] ?></td>
                    <td>
                        <a class="btn btn-outline-warning" href="editar.php?id_autor=<?php echo $row["id_autor"]; ?>">Editar</a>
                        <a class="btn btn-outline-danger" href="eliminar.php?id_autor=<?php echo urlencode($row["id_autor"]); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="../../index.php" class="btn btn-primary">Volver</a>
    </div>
</body>
</html>
