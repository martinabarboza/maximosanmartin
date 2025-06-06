<?php
session_start();

$usuario = $_POST["usuario"] ?? "";
$contrasena = $_POST["contrasena"] ?? "";

// Usuario y contraseña fijos
$usuario_valido = "maximosanmartin";
$contrasena_valida = "maximosanmartin";

if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
    $_SESSION["usuario"] = $usuario;
    header("Location: subir.php");
} else {
    echo "Usuario o contraseña incorrectos. <a href='login.php'>Volver</a>";
}
