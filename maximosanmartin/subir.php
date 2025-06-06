<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}
?>

<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "maximo";

$conn = mysqli_connect($host, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $estilo = $_POST["estilo"];
    $archivo = $_FILES["imagen"];

    if ($archivo["error"] === 0) {
        $nombreArchivo = time() . "_" . basename($archivo["name"]);
        $rutaDestino = "uploads/" . $nombreArchivo;

        if (move_uploaded_file($archivo["tmp_name"], $rutaDestino)) {
            $sql = "INSERT INTO fotos (nombre, ruta, estilo) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $nombreArchivo, $rutaDestino, $estilo);

            if (mysqli_stmt_execute($stmt)) {
                $mensaje = "✅ Imagen subida exitosamente.";
            } else {
                $mensaje = "❌ Error al guardar en la base de datos.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $mensaje = "❌ Error al mover el archivo.";
        }
    } else {
        $mensaje = "❌ Error con el archivo subido.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Subir foto</title>
</head>
<body>
  <h1>Subir una nueva imagen</h1>

  <?php if ($mensaje): ?>
    <p><?= $mensaje ?></p>
  <?php endif; ?>

  <form action="subir.php" method="POST" enctype="multipart/form-data">
    <label>Seleccionar imagen:</label>
    <input type="file" name="imagen" required><br><br>

    <label>Estilo:</label>
    <select name="estilo" required>
      <option value="formal">Formal</option>
      <option value="casual">Casual</option>
      <option value="urbano">Urbano</option>
    </select><br><br>

    <button type="submit">Subir imagen</button>
  </form>
</body>
</html>
