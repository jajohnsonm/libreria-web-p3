<?php
include "../bd.php";

if (empty($_GET['id_titulo'])) {
    die("Error: ID de título no válido.");
}

$id_titulo = $_GET['id_titulo'];

// Usar una consulta preparada
$query = mysqli_prepare($conexion, "SELECT titulo, tipo FROM titulos WHERE id_titulo = ?");
mysqli_stmt_bind_param($query, "s", $id_titulo);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query); // ✅ Obtener el resultado correcto

if(mysqli_num_rows($result) == 0){ // ✅ Usar $result aquí, no $query
    header("Location: libros.php");
    exit();
}

$data = mysqli_fetch_assoc($result); // ✅ Ahora sí pasamos $result
$titulo = $data['titulo'];
$tipo = $data['tipo'];



// Si el formulario se envió para eliminar el libro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare($conexion, "DELETE FROM titulos WHERE id_titulo = ?");
    
    // Asegurar que el tipo coincida con la base de datos
    mysqli_stmt_bind_param($stmt, "s", $id_titulo); // Cambia "i" por "s" si id_titulo es VARCHAR

    // Para depuración (muestra qué ID se está eliminando)
    echo "<script>console.log('Eliminando ID: " . htmlspecialchars($id_titulo) . "');</script>";

    $query_delete = mysqli_stmt_execute($stmt);

    if ($query_delete) {
        header("Location: libros.php");
        exit();
    } else {
        echo "<script>alert('Error al eliminar el libro.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <section id="container">
        <div class="data_delete">
            <h2>¿Está seguro de eliminar el siguiente libro?</h2>
            <p><strong>Título:</strong> <span><?= htmlspecialchars($titulo) ?></span></p>
            <p><strong>Tipo:</strong> <span><?= htmlspecialchars($tipo) ?></span></p>
            <form method="post">
                <input type="hidden" name="id_titulo" value="<?= $id_titulo ?>">
                <a href="libros.php" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn btn-outline-danger">
            </form>
        </div>
    </section>
</center>
</body>
</html>
