<?php
include('conexion.php');
if (isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);

    $query = "DELETE FROM productos WHERE id_producto = ?";
    $stmt = $conexion->prepare($query);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        header("Location: ProductosAD.php");
    } else {
        echo "Error al eliminar el producto: " . $stmt->error;
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    echo "ID del producto no proporcionado.";
}

// Cerrar la conexión
$conexion->close();
?>
