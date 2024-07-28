<?php
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Abarrotes Santo Toribio</title>
    <link rel="stylesheet" href="ABSANTST.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="logo-container">
            <a href="index.php"><img src="logo.png" class="logo" alt="Logo"></a>
        </div>
        <div class="title-container">
            <h1>ABARROTES</h1>
            <h1>SANTO TORIBIO</h1>
        </div>
        <div class="user-container">
            <a href="sesionAB.html"><img src="user.png" class="user-icon" alt="User"></a>
        </div>
        <div> <img src="lista.png" class="user-icon" alt="Lista"></div>
    </header>

    <nav>
        <ul>
            <li><a href="ABSantotoribio.html"><button>Inicio</button></a></li>
            <li><a href="SOBRENOSOTROS.html"><button>Sobre Nosotros</button></a></li>
            <li><a href="PROMO.html"><button>Ofertas</button></a></li>
        </ul>
    </nav>

    <section class="productos-section">
        <h2>Todos los Productos</h2>
        <div class="productos-container">
            <?php
            $query = "SELECT * FROM productos";
            if ($result = $conexion->query($query)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='producto'>";
                        echo "<img src='imagenes/" . htmlspecialchars($row['imagen']) . "' alt='Imagen de " . htmlspecialchars($row['nombre_p']) . "' width='auto' height='auto'>";
                        echo "<h3>" . htmlspecialchars($row['nombre_p']) . "</h3>";
                        echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
                        echo "<p>Precio: $" . htmlspecialchars($row['precio']) . "</p>";
                        echo "<p>Stock: " . htmlspecialchars($row['stock']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay productos en la base de datos.</p>";
                }
            } else {
                echo "Error en la consulta: " . $conexion->error;
            }
            $conexion->close();
            ?>
        </div>
    </section>

    <footer class="footer-container">
        <p>Redes Sociales</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
        </div>
        <p>Contacto: 44949494</p>
        <p>@TiendaProductos</p>
    </footer>
</body>
</html>
