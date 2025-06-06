<?php
session_start();
if (isset($_SESSION["usuario"])) {
    header("Location: subir.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
</head>
<body>
  <h2>Login</h2>
  <form action="verificar.php" method="POST">
    <label>Usuario:</label>
    <input type="text" name="usuario" required><br><br>

    <label>Contraseña:</label>
    <input type="password" name="contrasena" required><br><br>

    <button type="submit">Ingresar</button>
  </form>
</body>
</html>
