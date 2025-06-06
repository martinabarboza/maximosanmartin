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

// Si se solicitó eliminación
if (isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    
    // Obtener la ruta de la imagen a eliminar
    $sql_get = "SELECT ruta FROM fotos WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_get);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($fila = mysqli_fetch_assoc($resultado)) {
        unlink($fila['ruta']); // borrar el archivo del servidor
    }

    // Eliminar la imagen de la base de datos
    $sql_delete = "DELETE FROM fotos WHERE id = ?";
    $stmt_delete = mysqli_prepare($conn, $sql_delete);
    mysqli_stmt_bind_param($stmt_delete, 'i', $id);
    mysqli_stmt_execute($stmt_delete);

    header("Location: galeria.php");
    exit();
}

// Si hay filtro por estilo
$filtro = isset($_GET['estilo']) ? $_GET['estilo'] : '';

$sql = "SELECT * FROM fotos";
if ($filtro && in_array($filtro, ['formal', 'casual', 'urbano'])) {
    $sql .= " WHERE estilo = '$filtro'";
}
$sql .= " ORDER BY fecha_subida DESC";

$imagenes = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Galería de Imágenes</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 2rem;
    }
    .botones {
      margin-bottom: 20px;
    }
    .botones a {
      margin-right: 10px;
      padding: 10px;
      background-color: #ccc;
      text-decoration: none;
      border-radius: 5px;
    }
    .galeria {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
    }
    .imagen {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    .imagen img {
      max-width: 100%;
      height: auto;
    }
    .eliminar {
      color: red;
      text-decoration: none;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <h1>Galería de Imágenes</h1>

  <div class="botones">
    <a href="galeria.php">Todos</a>
    <a href="galeria.php?estilo=formal">Formal</a>
    <a href="galeria.php?estilo=casual">Casual</a>
    <a href="galeria.php?estilo=urbano">Urbano</a>
  </div>

  <div class="galeria">
    <?php while ($img = mysqli_fetch_assoc($imagenes)): ?>
      <div class="imagen">
        <img src="<?php echo htmlspecialchars($img['ruta']); ?>" alt="<?php echo htmlspecialchars($img['nombre']); ?>">
        <p><strong><?php echo ucfirst($img['estilo']); ?></strong></p>
        <a class="eliminar" href="galeria.php?eliminar=<?php echo $img['id']; ?>" onclick="return confirm('¿Seguro que querés eliminar esta imagen?')">🗑️ Eliminar</a>
      </div>
    <?php endwhile; ?>
  </div>

</body>
</html>

<?php mysqli_close($conn); ?>
