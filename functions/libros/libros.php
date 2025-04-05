<?php
include '../bd.php';

$sql = "SELECT id_titulo, titulo, tipo, id_pub, precio, avance, total_ventas, notas, fecha_pub, contrato FROM titulos";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center">
        <h1>Libros Disponibles</h1>
        <br><br>
        <a class="btn btn-outline-success" href="agregar.php">Crear Nuevo Libro</a>
        <br><br>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>ID Publicación</th>
                <th>Precio</th>
                <th>Avance</th>
                <th>Total Ventas</th>
                <th>Notas</th>
                <th>Fecha Publicación</th>
                <th>Contrato</th>
                <th>Editar / Eliminar</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row["id_titulo"] ?></td>
                    <td><?= $row["titulo"] ?></td>
                    <td><?= $row["tipo"] ?></td>
                    <td><?= $row["id_pub"] ?></td>
                    <td><?= $row["precio"] ?></td>
                    <td><?= $row["avance"] ?></td>
                    <td><?= $row["total_ventas"] ?></td>
                    <td><?= $row["notas"] ?></td>
                    <td><?= $row["fecha_pub"] ?></td>
                    <td><?= $row["contrato"] ?></td>
                    <td>
                        <a class="btn btn-outline-warning" href="editar.php?id_titulo=<?php echo $row["id_titulo"]; ?>">Editar</a>
                        <a class="btn btn-outline-danger" href="eliminar.php?id_titulo=<?php echo urlencode($row["id_titulo"]); ?>">Eliminar</a>
                    </td>

                </tr>
            <?php } ?>
        </table>
        <br>
        <a href="../../index.php" class="btn btn-primary">Volver</a>
    </div>
</body>
</html>
