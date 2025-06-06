<?php
// Conexión a la base de datos (igual que en index.php)
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "maximo";

$conn = mysqli_connect($host, $usuario, $contrasena, $base_datos);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Página de inicio de Máximo San Martín, descubre outfits únicos."
    />
    <meta
      name="keywords"
      content="Máximo San Martín, moda masculina, outfits hombre, estilo, trajes de hombre uruguay, salto uruguay esmoquin, ropa urbana hombre, asesoramiento de imagen"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Máximo San Martín</title>
  </head>

  <body>
    <header>
      <img
        class="logomaximocompleto"
        src="imagenes/logomaximocompleto.png"
        alt="Logo de Máximo San Martín completo"
      />
      <div id="container"><div class="toggle"></div></div>
    </header>

    <h1>Elegí tu estilo</h1>
    <p>
      Cuando sabés lo que querés, se nota. Esto empieza con una buena elección.
    </p>

    <div class="container-estilos">
      <a href="galeria.php?estilo=formal" class="estilos" id="estiloformal"
        >FORMAL</a
      >
    </div>
    <div class="container-estilo">
      <a href="galeria.php?estilo=casual" class="estilos" id="estilocasual"
        >CASUAL</a
      >
    </div>
    <div class="container-estilos">
      <a href="galeria.php?estilo=urbano" class="estilos" id="estilourbano"
        >URBANO</a
      >
    </div>

    <footer>
      <img
        class="logomaximo"
        src="imagenes/logomaximo.png"
        alt="Logo de Máximo San Martín abreviado"
      />
      <p class="copyright">© 2025 Máximo San Martín</p>
    </footer>
    <script src="toggle.js"></script>
  </body>
</html>
