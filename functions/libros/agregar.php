<?php
include '../bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $id_titulo = $_POST['id_titulo'];
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $id_pub = $_POST['id_pub'];
    $precio = $_POST['precio'];
    $avance = $_POST['avance'];
    $total_ventas = $_POST['total_ventas'];
    $notas = $_POST['notas'];
    $fecha_pub = $_POST['fecha_pub'];
    $contrato = $_POST['contrato'];

    // Preparar la consulta SQL para insertar el nuevo libro
    $sql = "INSERT INTO titulos (id_titulo, titulo, tipo, id_pub, precio, avance, total_ventas, notas, fecha_pub, contrato)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Usar prepared statements para evitar inyecciones SQL
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssiidissss", $id_titulo, $titulo, $tipo, $id_pub, $precio, $avance, $total_ventas, $notas, $fecha_pub, $contrato);
        if ($stmt->execute()) {
            echo "<script>alert('Libro agregado exitosamente'); window.location.href='libros.php';</script>";
        } else {
            echo "<script>alert('Error al agregar el libro.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error en la consulta SQL.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Agregar Nuevo Libro</h1>
        <br>
        <form action="agregar.php" method="POST">
            <div class="mb-3">
                <label for="id_titulo" class="form-label">ID del Título</label>
                <input type="text" class="form-control" id="id_titulo" name="id_titulo" maxlength="6" required>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div class="mb-3">
                <label for="id_pub" class="form-label">ID Publicación</label>
                <input type="number" class="form-control" id="id_pub" name="id_pub" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="avance" class="form-label">Avance</label>
                <input type="number" class="form-control" id="avance" name="avance" required>
            </div>
            <div class="mb-3">
                <label for="total_ventas" class="form-label">Total Ventas</label>
                <input type="number" class="form-control" id="total_ventas" name="total_ventas" required>
            </div>
            <div class="mb-3">
                <label for="notas" class="form-label">Notas</label>
                <textarea class="form-control" id="notas" name="notas" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_pub" class="form-label">Fecha de Publicación</label>
                <input type="date" class="form-control" id="fecha_pub" name="fecha_pub" required>
            </div>
            <div class="mb-3">
                <label for="contrato" class="form-label">Contrato</label>
                <input type="text" class="form-control" id="contrato" name="contrato" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Libro</button>
            <a href="libros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
