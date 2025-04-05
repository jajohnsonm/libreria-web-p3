<?php
include "../bd.php";

// Verificar si se recibe un ID válido
if (empty($_GET['id_titulo'])) {
    die("Error: ID de libro no válido.");
}

$id_titulo = $_GET['id_titulo'];

// Obtener datos del libro actual
$query = mysqli_prepare($conexion, "SELECT titulo, tipo, id_pub, precio, avance, total_ventas, notas, fecha_pub, contrato FROM titulos WHERE id_titulo = ?");
mysqli_stmt_bind_param($query, "s", $id_titulo);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if (mysqli_num_rows($result) == 0) {
    die("Error: Libro no encontrado.");
}

$data = mysqli_fetch_assoc($result);

// Si se envía el formulario, actualizar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $id_pub = $_POST['id_pub'];
    $precio = $_POST['precio'];
    $avance = $_POST['avance'];
    $total_ventas = $_POST['total_ventas'];
    $notas = $_POST['notas'];
    $fecha_pub = $_POST['fecha_pub'];
    $contrato = $_POST['contrato'];

    $stmt = mysqli_prepare($conexion, "UPDATE titulos SET titulo = ?, tipo = ?, id_pub = ?, precio = ?, avance = ?, total_ventas = ?, notas = ?, fecha_pub = ?, contrato = ? WHERE id_titulo = ?");
    mysqli_stmt_bind_param($stmt, "sssddissss", $titulo, $tipo, $id_pub, $precio, $avance, $total_ventas, $notas, $fecha_pub, $contrato, $id_titulo);
    $query_update = mysqli_stmt_execute($stmt);

    if ($query_update) {
        header("Location: libros.php");
        exit();
    } else {
        echo "<script>alert('Error al actualizar el libro.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container text-center">
    <h1>Editar Libro</h1>
    <form method="post">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($data['titulo']) ?>" required class="form-control">

        <label>Tipo:</label>
        <input type="text" name="tipo" value="<?= htmlspecialchars($data['tipo']) ?>" required class="form-control">

        <label>ID Publicación:</label>
        <input type="text" name="id_pub" value="<?= htmlspecialchars($data['id_pub']) ?>" class="form-control">

        <label>Precio:</label>
        <input type="number" name="precio" value="<?= htmlspecialchars($data['precio']) ?>" step="0.01" class="form-control">

        <label>Avance:</label>
        <input type="number" name="avance" value="<?= htmlspecialchars($data['avance']) ?>" class="form-control">

        <label>Total Ventas:</label>
        <input type="number" name="total_ventas" value="<?= htmlspecialchars($data['total_ventas']) ?>" class="form-control">

        <label>Notas:</label>
        <textarea name="notas" class="form-control"><?= htmlspecialchars($data['notas']) ?></textarea>

        <label>Fecha de Publicación:</label>
        <input type="date" name="fecha_pub" value="<?= htmlspecialchars($data['fecha_pub']) ?>" class="form-control">

        <label>Contrato:</label>
        <input type="text" name="contrato" value="<?= htmlspecialchars($data['contrato']) ?>" class="form-control">

        <br>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="libros.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
