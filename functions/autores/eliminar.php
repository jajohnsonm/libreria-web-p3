<?php
include "../bd.php";

if (empty($_GET['id_autor'])) {
    die("Error: ID de autor no válido.");
}

$id_autor = $_GET['id_autor'];

// Usar una consulta preparada para obtener el autor
$query = mysqli_prepare($conexion, "SELECT apellido, nombre FROM autores WHERE id_autor = ?");
mysqli_stmt_bind_param($query, "i", $id_autor);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query); // ✅ Obtener el resultado correcto

if(mysqli_num_rows($result) == 0){ // ✅ Usar $result aquí, no $query
    header("Location: autores.php");
    exit();
}

$data = mysqli_fetch_assoc($result); // ✅ Ahora sí pasamos $result
$apellido = $data['apellido'];
$nombre = $data['nombre'];

// Si el formulario se envió para eliminar el autor
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = mysqli_prepare($conexion, "DELETE FROM autores WHERE id_autor = ?");
    
    // Asegurar que el tipo coincida con la base de datos
    mysqli_stmt_bind_param($stmt, "i", $id_autor);

    // Para depuración (muestra qué ID se está eliminando)
    echo "<script>console.log('Eliminando ID: " . htmlspecialchars($id_autor) . "');</script>";

    $query_delete = mysqli_stmt_execute($stmt);

    if ($query_delete) {
        header("Location: autores.php");
        exit();
    } else {
        echo "<script>alert('Error al eliminar el autor.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <section id="container">
        <div class="data_delete">
            <h2>¿Está seguro de eliminar el siguiente autor?</h2>
            <p><strong>Nombre:</strong> <span><?= htmlspecialchars($nombre) ?></span></p>
            <p><strong>Apellido:</strong> <span><?= htmlspecialchars($apellido) ?></span></p>
            <form method="post">
                <input type="hidden" name="id_autor" value="<?= $id_autor ?>">
                <a href="autores.php" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn btn-outline-danger">
            </form>
        </div>
    </section>
</center>
</body>
</html>
