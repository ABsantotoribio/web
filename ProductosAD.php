<?php
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="ABSANTST.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <a href="ABSantotoribio.html"><img src="logo.png" alt="Logo" class="logo"></a>
        </div>
        <div class="title-container">
            <h1>Lista de Productos</h1>
        </div>
    </header>

    <div class="productos-section">
        <?php
        echo "<a href='formulario.html' class='button'>Agregar Nuevo Producto</a><br><br>";

        if ($result = $conexion->query("SELECT * FROM productos ORDER BY id_producto")) {
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Descripción</th><th>Imagen</th><th>Acciones</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row['id_producto']. "</td>";
                    echo "<td>". $row['nombre_p']. "</td>";
                    echo "<td>". $row['precio']. "</td>";
                    echo "<td>". $row['stock']. "</td>";
                    echo "<td>". $row['descripcion']. "</td>";
                    echo "<td><img src='imagenes/". $row['imagen']. "' alt='Imagen de ". $row['nombre_p']. "' width='100' height='100'></td>";
                    echo "<td><a href='actualizar.php?id=". $row['id_producto']. "'>Modificar</a> | <a href='eliminar.php?id=". $row['id_producto']. "'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No hay productos en la base de datos.";
            }
        } else {
            echo "Error en la consulta: ". $conexion->error;
        }
        ?>
    </div>
</body>
</html>
