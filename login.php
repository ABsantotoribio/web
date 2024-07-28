<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['contrasena']) {
                header("Location: ProductosAD.php");
            } else {
                header("Location: sesionAB.html");
            }
        } else {
            header("Location: sesionAB.html");
        }

    }
}
?>