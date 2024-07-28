<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_p = $_POST['nombre_p'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen']['name'];
        $target_dir = "imagenes/"; 
        $target_file = $target_dir . basename($imagen);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            
        } else {
            echo "Location: formulario.html";
            $imagen = null;
        }
    }
    $query = "INSERT INTO productos (nombre_p, descripcion, precio, stock, imagen) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($query)) {
        $stmt->bind_param("ssdis", $nombre_p, $descripcion, $precio, $stock, $imagen);
        if ($stmt->execute()) {
            header("Location: ProductosAD.php");
        } else {
            header("Location: formulario.php");
        }
        $stmt->close();
    } else {
        header("Location: formulario.php");
    }

    $conexion->close();
} else {
    header("Location: formulario.php");
}
?>
