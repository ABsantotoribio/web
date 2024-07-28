<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id_producto = intval($_GET['id']);

    if ($result = $conexion->query("SELECT * FROM productos WHERE id_producto = $id_producto")) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Actualizar Producto</title>
                <link rel="stylesheet" href="ABSANTST.css">
            </head>
            <body>
                <header>
                    <div class="logo-container">
                       <a href="ABSantotoribio.html"> <img src="logo.png" alt="Logo" class="logo"></a>
                    </div>
                    <div class="title-container">
                        <h1>Actualizar Producto</h1>
                    </div>
                </header>

                <div class="form-container">
                    <form action="actualizar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                        <div class="form-group">
                            <label for="nombre_p">Nombre:</label>
                            <input type="text" name="nombre_p" value="<?php echo $row['nombre_p']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="text" name="precio" value="<?php echo $row['precio']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="text" name="stock" value="<?php echo $row['stock']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion"><?php echo $row['descripcion']; ?></textarea><br>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen Actual:</label>
                            <img src='imagenes/<?php echo $row['imagen']; ?>' alt='Imagen de <?php echo $row['nombre_p']; ?>' width='100' height='100'><br>
                            <label for="imagen">Nueva Imagen:</label>
                            <input type="file" name="imagen"><br>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update">Actualizar</button>
                        </div>
                    </form>
                </div>

                <div class="footer-container">
                    <a href="index.php">Volver a la lista de productos</a>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "No se encontró el producto.";
        }
    } else {
        echo "Error en la consulta: ". $conexion->error;
    }
}

if (isset($_POST['update'])) {
    $id_producto = intval($_POST['id_producto']);
    $nombre_p = $_POST['nombre_p'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen = $_FILES['imagen']['name'];
        $target_dir = "imagenes/";
        $target_file = $target_dir . basename($imagen);
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        } else {
            echo "Error al subir la imagen.";
            $imagen = null;
        }
    }

    if ($imagen) {
        $query = "UPDATE productos SET nombre_p=?, precio=?, stock=?, descripcion=?, imagen=? WHERE id_producto=?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sdissi", $nombre_p, $precio, $stock, $descripcion, $imagen, $id_producto);
    } else {
        $query = "UPDATE productos SET nombre_p=?, precio=?, stock=?, descripcion=? WHERE id_producto=?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sdisi", $nombre_p, $precio, $stock, $descripcion, $id_producto);
    }

    if ($stmt->execute()) {
        header("Location: ProductosAD.php");
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }
    $stmt->close();
}
?>
